<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

$modelsPath = app_path('Models');
$files = File::files($modelsPath);

$issuesCount = 0;

foreach ($files as $file) {
    if ($file->getExtension() !== 'php') continue;

    $class = 'App\\Models\\' . $file->getFilenameWithoutExtension();
    if (!class_exists($class)) continue;

    try {
        $reflection = new ReflectionClass($class);
        if ($reflection->isAbstract()) continue;

        $model = new $class;
        $table = $model->getTable();

        foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            // Only consider methods defined in the child class itself, and without required parameters
            if ($method->class !== $class || $method->getNumberOfRequiredParameters() > 0) continue;

            try {
                // Execute method to see if it returns a Relation
                $relation = reset((function() use ($method, $model) {
                    ob_start();
                    $ret = $method->invoke($model);
                    ob_end_clean();
                    return [$ret];
                })());

                if ($relation instanceof \Illuminate\Database\Eloquent\Relations\Relation) {
                    if ($relation instanceof \Illuminate\Database\Eloquent\Relations\BelongsTo) {
                        $fk = $relation->getForeignKeyName();
                        if (!Schema::hasColumn($table, $fk)) {
                            echo "- [BelongsTo] `{$class}::{$method->getName()}()` expects FK `{$fk}` on table `{$table}`, but it doesn't exist.\n";
                            $issuesCount++;
                        }
                    } elseif ($relation instanceof \Illuminate\Database\Eloquent\Relations\HasOneOrMany) {
                        $fk = $relation->getForeignKeyName();
                        $fkParts = explode('.', $fk);
                        $fkCol = end($fkParts);
                        $relatedModel = $relation->getRelated();
                        $relatedTable = $relatedModel->getTable();
                        if (!Schema::hasColumn($relatedTable, $fkCol)) {
                            echo "- [HasMany/One] `{$class}::{$method->getName()}()` expects FK `{$fkCol}` on related table `{$relatedTable}`, but it doesn't exist.\n";
                            $issuesCount++;
                        }
                    } elseif ($relation instanceof \Illuminate\Database\Eloquent\Relations\BelongsToMany) {
                        $pivotTable = $relation->getTable();
                        $foreignPivotKey = $relation->getForeignPivotKeyName();
                        $relatedPivotKey = $relation->getRelatedPivotKeyName();

                        if (!Schema::hasTable($pivotTable)) {
                            echo "- [BelongsToMany] `{$class}::{$method->getName()}()` expects pivot table `{$pivotTable}`, but it doesn't exist.\n";
                            $issuesCount++;
                        } else {
                            if (!Schema::hasColumn($pivotTable, $foreignPivotKey)) {
                                echo "- [BelongsToMany] `{$class}::{$method->getName()}()` expects column `{$foreignPivotKey}` on pivot table `{$pivotTable}`.\n";
                                $issuesCount++;
                            }
                            if (!Schema::hasColumn($pivotTable, $relatedPivotKey)) {
                                echo "- [BelongsToMany] `{$class}::{$method->getName()}()` expects column `{$relatedPivotKey}` on pivot table `{$pivotTable}`.\n";
                                $issuesCount++;
                            }
                        }
                    }
                }
            } catch (\Throwable $e) {
                // Not a relation or throws an error
            }
        }
    } catch (\Throwable $e) {
        echo "- Error processing `{$class}`: " . $e->getMessage() . "\n";
    }
}

if ($issuesCount === 0) {
    echo "All relations look good!\n";
} else {
    echo "\nFound {$issuesCount} issues with relations.\n";
}

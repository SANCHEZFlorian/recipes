<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

$modelsPath = app_path('Models');
$files = File::files($modelsPath);

$issues = [];

foreach ($files as $file) {
    if ($file->getExtension() !== 'php') continue;

    $class = 'App\\Models\\' . $file->getFilenameWithoutExtension();
    if (!class_exists($class)) continue;

    try {
        $reflection = new ReflectionClass($class);
        if ($reflection->isAbstract()) continue;

        $model = new $class;
        $table = $model->getTable();

        if (!Schema::hasTable($table)) {
            $issues[] = "- Model `{$class}` refers to table `{$table}` which DOES NOT EXIST.";
            continue;
        }

        $columns = Schema::getColumnListing($table);
        $fillable = $model->getFillable();

        $missingFillable = array_diff($columns, $fillable, ['id', 'created_at', 'updated_at', 'deleted_at', 'email_verified_at', 'password', 'remember_token']);
        $invalidFillable = array_diff($fillable, $columns);

        if (!empty($missingFillable) || !empty($invalidFillable)) {
            $issues[] = "Model `{$class}` (table: {$table}):";
            if (!empty($missingFillable)) {
                $issues[] = "  - Might be missing in \$fillable: " . implode(', ', $missingFillable);
            }
            if (!empty($invalidFillable)) {
                $issues[] = "  - Invalid fields in \$fillable (not in DB): " . implode(', ', $invalidFillable);
            }
        }

    } catch (\Throwable $e) {
        $issues[] = "- Error checking `{$class}`: " . $e->getMessage();
    }
}

if (empty($issues)) {
    echo "All models seem to have correct \$fillable properties compared to DB schema!\n";
} else {
    echo "Found some potential Model mass assignment/schema mismatches:\n\n";
    echo implode("\n", $issues) . "\n";
}

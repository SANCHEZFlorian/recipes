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

// Create mapping from class name to expected singular table name
// Laravel usually singularizes snake_case of class names
function getExpectedTableName($class) {
    if ($class === 'App\Models\User') return 'users';
    $baseName = class_basename($class);
    return Str::snake($baseName); // Singular table name as per user's migrations
}

foreach ($files as $file) {
    if ($file->getExtension() !== 'php') continue;

    $class = 'App\\Models\\' . $file->getFilenameWithoutExtension();
    if (!class_exists($class)) continue;

    try {
        $reflection = new ReflectionClass($class);
        if ($reflection->isAbstract()) continue;

        $model = new $class;
        $currentTable = $model->getTable();

        $expectedTable = getExpectedTableName($class);

        $fileContent = file_get_contents($file->getPathname());
        $changed = false;

        // 1. Fix Table Name if it doesn't match the actual table in DB
        // If currentTable doesn't exist, but expectedTable does, we need to add/update protected $table
        if (!Schema::hasTable($currentTable)) {
            if (Schema::hasTable($expectedTable)) {
                echo "Fixing table name for {$class} to {$expectedTable}\n";
                // Inject `protected $table = '...';` into class
                if (!preg_match('/protected\s+\$table\s*=/', $fileContent)) {
                    $insertPos = strpos($fileContent, '{') + 1;
                    $fileContent = substr_replace($fileContent, "\n    protected \$table = '{$expectedTable}';", $insertPos, 0);
                    $changed = true;
                }
            } else {
                echo "Warning: Expected table {$expectedTable} not found for {$class}\n";
                continue; // Skip altering fillable if table doesn't exist
            }
        }

        // Reload model to get newly updated table name if we changed it in memory?
        // We can just use $expectedTable since we know it exists.
        $actualTable = Schema::hasTable($currentTable) ? $currentTable : $expectedTable;

        // 2. Fix Fillable
        $columns = Schema::getColumnListing($actualTable);
        // Exclude some internal columns
        $exclude = ['id', 'created_at', 'updated_at', 'deleted_at', 'email_verified_at', 'password', 'remember_token'];
        $desiredFillable = array_diff($columns, $exclude);
        $desiredFillableArrayString = "[\n        '" . implode("',\n        '", $desiredFillable) . "'\n    ]";

        // Replace existing fillable or add it
        if (preg_match('/protected\s+\$fillable\s*=\s*\[.*?\];/s', $fileContent, $matches)) {
            $currentFillableStr = $matches[0];
            $newFillableStr = "protected \$fillable = {$desiredFillableArrayString};";
            if ($currentFillableStr !== $newFillableStr) {
                $fileContent = str_replace($currentFillableStr, $newFillableStr, $fileContent);
                $changed = true;
                echo "Updated \$fillable for {$class}\n";
            }
        } else {
            // Add fillable
             $insertPos = strpos($fileContent, '{') + 1;
             $fileContent = substr_replace($fileContent, "\n    protected \$fillable = {$desiredFillableArrayString};\n", $insertPos, 0);
             $changed = true;
             echo "Added \$fillable for {$class}\n";
        }

        if ($changed) {
            file_put_contents($file->getPathname(), $fileContent);
        }

    } catch (\Throwable $e) {
        echo "- Error processing `{$class}`: " . $e->getMessage() . "\n";
    }
}

echo "Done fixing models.\n";

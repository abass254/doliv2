<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;

class DirectoryScanJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //

        $directory = storage_path('app/public/FILE_SERVER'); // Directory in storage
        $scanResults = $this->scanDirectory($directory);

        $outputPath = storage_path('app/directory_scan.json');
        file_put_contents($outputPath, json_encode($scanResults, JSON_PRETTY_PRINT));
    }

    private function scanDirectory(string $path, string $parent = 'NUL'): array
    {
        $results = [];

        if (is_dir($path)) {
            $metaType = 'folder';
            $extension = 'N/A';
            $name = basename($path);

            // Add folder metadata
            $results[] = [
                'name' => $name,
                'meta_primary' => $parent,
                'meta_path' => $path,
                'meta_type' => $metaType,
                'extension' => $extension,
            ];

            // Scan directory contents
            $items = scandir($path);
            foreach ($items as $item) {
                if ($item === '.' || $item === '..') continue;

                $itemPath = $path . DIRECTORY_SEPARATOR . $item;
                $results = array_merge($results, $this->scanDirectory($itemPath, $name));
            }
        } else {
            $metaType = 'file';
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $name = basename($path);

            // Add file metadata
            $results[] = [
                'name' => $name,
                'meta_primary' => $parent,
                'meta_path' => $path,
                'meta_type' => $metaType,
                'extension' => ".$extension",
            ];
        }

        return $results;
    }
}

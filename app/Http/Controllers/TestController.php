<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Folder;
use App\Models\File;
use ZipArchive;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Writer\Html;
//use PhpOffice\PhpSpreadsheet\IOFactory;

class TestController extends Controller
{
    //

    public function uploadForm()
    {
        return view('folder-upload');
    }


    public function processZip(Request $request)
    {
        $request->validate([
            'folders' => 'required|file|mimes:zip',
        ]);

        $zipFile = $request->file('folders');
        $tempFolder = uniqid('temp_');
        $extractPath = storage_path("app/public/temp/{$tempFolder}");

        // Extract ZIP file
        if (!$this->extractZip($zipFile, $extractPath)) {
            return back()->withErrors(['folders' => 'Failed to extract ZIP file.']);
        }

        $result = $this->processDirectories($extractPath);

        // Clean up temporary folder
        Storage::deleteDirectory("public/temp/{$tempFolder}");

        // Return the resulting data
        return response()->json($result);
    }

    private function extractZip($zipFile, $extractPath)
    {
        $zip = new \ZipArchive;
        if ($zip->open($zipFile->path()) === true) {
            $zip->extractTo($extractPath);
            $zip->close();
            return true;
        }
        return false;
    }

    private function processDirectories($extractPath)
    {
        $result = [];
        $directories = array_filter(glob($extractPath . '/*'), 'is_dir');
        foreach ($directories as $directory) {
            $result = array_merge($result, $this->processDirectory($directory, null));
        }
        return $result;
    }

    private function processDirectory($directory, $primaryFolder = null)
    {
        $result = [];
        $normalizedName = strtolower(str_replace([' ', '-'], '_', basename($directory)));
        $normalizedPath = $primaryFolder
            ? "{$primaryFolder}/{$normalizedName}"
            : $normalizedName;

        $storagePath = "cases/{$normalizedPath}";

        // Create the directory in the storage
        Storage::makeDirectory($storagePath);

        // Add folder data to result
        $result[] = [
            'name' => $normalizedName,
            'path' => $storagePath,
            'type' => 'folder',
            'primary_folder' => $primaryFolder ?: 'N/A',
        ];

        // Process contents (files and subfolders)
        $contents = glob("{$directory}/*");
        foreach ($contents as $item) {
            if (is_dir($item)) {
                // Recursive call for subdirectories
                $result = array_merge($result, $this->processDirectory($item, $normalizedName));
            } elseif (is_file($item)) {
                $result[] = $this->processFile($item, $normalizedName, $storagePath);
            }
        }

        return $result;
    }

    // private function processFile($file, $primaryFolder, $parentFolder)
    // {
    //     $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

    //     // Only process .docx and .pdf files
    //     if (!in_array($fileExtension, ['docx', 'pdf'])) {
    //         return [];
    //     }

    //     $normalizedName = strtolower(str_replace([' ', '-'], '_', basename($file)));
    //     $targetPath = storage_path("app/public/{$parentFolder}/{$normalizedName}");

    //     // Ensure destination directory exists
    //     $destinationDir = dirname($targetPath);
    //     if (!is_dir($destinationDir)) {
    //         mkdir($destinationDir, 0755, true);
    //     }



    //     // Verify if the source file exists
    //     if (!file_exists($file)) {
    //         throw new \Exception("Source file not found: {$file}");
    //     }

    //     // Move the file to its correct location
    //     if (!rename($file, $targetPath)) {
    //         throw new \Exception("Failed to move file from {$file} to {$targetPath}");
    //     }

    //     // Return file details
    //     return [
    //         'name' => $normalizedName,
    //         'path' => str_replace(storage_path('app/public/'), '', $targetPath),
    //         'type' => 'file',
    //         'primary_folder' => $primaryFolder,
    //     ];
    // }

    private function processFile($file, $primaryFolder, $parentFolder)
    {
        // Extract file details
        $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $normalizedName = strtolower(str_replace([' ', '-'], '_', pathinfo($file, PATHINFO_FILENAME)));
        $destinationDir = storage_path("app/public/{$parentFolder}");
        $targetPath = "{$destinationDir}/{$normalizedName}";
    
        // Ensure destination directory exists
        if (!is_dir($destinationDir)) {
            mkdir($destinationDir, 0755, true);
        }
    
        try {
            if ($fileExtension === 'docx') {
                // Convert DOCX to PDF
                $pdfPath = $this->convertDocxToPdf($file, $destinationDir, $normalizedName);
                $normalizedName = basename($pdfPath); // Update name to .pdf
                $targetPath = $pdfPath; // Update target path
            } elseif ($fileExtension === 'pdf') {
                // Move PDF files directly
                $normalizedName .= '.pdf';
                $targetPath .= '.pdf';
                if (!rename($file, $targetPath)) {
                    throw new \Exception("Failed to move file from {$file} to {$targetPath}");
                }
            } else {
                // Skip unsupported files
                \Log::info("Skipping unsupported file: {$file}");
                return [];
            }
    
            // Return processed file details
            return [
                'name' => $normalizedName,
                'path' => str_replace(storage_path('app/public/'), '', $targetPath),
                'type' => 'file',
                'primary_folder' => $primaryFolder,
            ];
        } catch (\Exception $e) {
            // Log the error and skip the file
            \Log::error("Error processing file {$file}: {$e->getMessage()}");
            return [];
        }
    }
    


    private function convertDocxToPdf($docxPath, $destinationDir, $baseName)
    {
        try {
            $phpWord = \PhpOffice\PhpWord\IOFactory::load($docxPath, 'Word2007');
            $htmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
            
            ob_start();
            $htmlWriter->save('php://output');
            $htmlContent = ob_get_clean();

            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($htmlContent);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $pdfPath = "{$destinationDir}/{$baseName}.pdf";
            file_put_contents($pdfPath, $dompdf->output());

            return $pdfPath;
        } catch (\Exception $e) {
            throw new \Exception("Failed to convert DOCX to PDF: {$e->getMessage()}");
        }
    }



    // public function renderXlsxAsPdf($fileName)
    
    // {
    //     $inputFile = storage_path("app/public/trial/{$fileName}");
    //     $pdfFileName = pathinfo($fileName, PATHINFO_FILENAME) . '.pdf';
    //     $outputFile = storage_path("app/public/trial/{$pdfFileName}");

    //     // Convert XLSX to PDF using unoconv (same method as DOCX)
    //     shell_exec("unoconv -f pdf {$inputFile}");

    //     return response()->file($outputFile);
    // }









    // public function processZip(Request $request)
    // {
    //     $request->validate([
    //         'folders' => 'required|file|mimes:zip',
    //     ]);

    //     $zipFile = $request->file('folders');
    //     $tempFolder = uniqid('temp_');
    //     $extractPath = storage_path("app/public/temp/{$tempFolder}");

    //     if ($this->extractZip($zipFile, $extractPath)) {
    //         return $this->processDirectories($extractPath);
    //     }

    //     return back()->withErrors(['folders' => 'Failed to extract ZIP file.']);
    // }

    // private function extractZip($zipFile, $extractPath)
    // {
    //     $zip = new \ZipArchive;
    //     if ($zip->open($zipFile->path()) === true) {
    //         $zip->extractTo($extractPath);
    //         $zip->close();
    //         return true;
    //     }
    //     return false;
    // }

    // private function processDirectories($extractPath)
    // {
    //     $directories = array_filter(glob($extractPath . '/*'), 'is_dir');
    //     foreach ($directories as $directory) {
    //         $this->processDirectory($directory);
    //     }
    //     Storage::deleteDirectory("temp/{$extractPath}"); // Clean up temp folder
    //     return redirect()->back()->with('success', 'Folders processed successfully.');
    // }

    // private function processDirectory($directory)
    // {
    //     $caseNo = strtolower(str_replace([' ', '-'], '_', basename($directory))); // Normalize case number
    //     $storagePath = "cases/{$caseNo}";

    //     // Fetch the corresponding File record
    //     $fileRecord = File::where('file_no', $caseNo)->first();
    //     $fileId = $fileRecord ? $fileRecord->id : 0;

    //     Storage::makeDirectory($storagePath);
    //     $this->moveFolder($directory, storage_path("app/public/{$storagePath}"));

    //     // Process files and subfolders
    //     $filesAndFolders = glob("{$directory}/*");
    //     foreach ($filesAndFolders as $item) {
    //         if (is_dir($item)) {
    //             $this->saveFolder($item, $storagePath, $fileId); // Save subfolder
    //         } elseif (is_file($item)) {
    //             $this->processFile($item, $storagePath, $fileId); // Process file
    //         }
    //     }

    //     // Save the parent folder (main folder)
    //     $this->saveFolder($directory, $storagePath, $fileId, true);
    // }


    // private function processFile($file, $parentFolder, $fileId)
    // {
    //     $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
    //     if (in_array($fileExtension, ['docx', 'pdf'])) {
    //         $normalizedName = strtolower(str_replace([' ', '-', ''], '_', basename($file)));
    //         $targetPath = "{$parentFolder}/{$normalizedName}";

    //         // Move the file to its correct location
    //         rename($file, storage_path("app/public/{$targetPath}"));

    //         // Save file data to the Folder table
    //         Folder::create([
    //             'file' => $fileId, // Link to File record
    //             'folder_type' => 'file',
    //             'folder_name' => $normalizedName,
    //             'folder_path' => $targetPath,
    //             'folder_status' => '1',
    //         ]);
    //     }
    // }


    // private function saveFolder($directory, $parentFolder, $fileId, $isPrimary = false)
    // {
    //     $normalizedName = strtolower(str_replace([' ', '-', ''], '_', basename($directory)));
    //     $folderPath = "{$parentFolder}/{$normalizedName}";

    //     Folder::create([
    //         'file' => $isPrimary ? $fileId : 0, // Link to primary folder if applicable
    //         'folder_type' => 'folder',
    //         'folder_name' => $normalizedName,
    //         'folder_path' => $folderPath,
    //         'folder_status' => '1',
    //     ]);
    // }


    // private function moveFolder($source, $destination)
    // {
    //     // Normalize the folder name: Replace spaces and dashes with underscores and convert to lowercase
    //     $normalizedDestination = strtolower(str_replace([' ', '-'], '_', basename($destination)));

    //     // Define the relative path for storage
    //     $destinationPath = "cases/{$normalizedDestination}"; // Relative path for storage

    //     // Ensure the parent directory exists before creating subdirectories
    //     $storagePath = storage_path("app/public/{$destinationPath}");  // Full storage path
    //     if (!is_dir($storagePath)) {
    //         mkdir($storagePath, 0755, true);  // Create the directory structure if it doesn't exist
    //     }

    //     // Get all files and subfolders in the source folder
    //     $files = glob("{$source}/*");
    //     foreach ($files as $file) {
    //         $normalizedName = strtolower(str_replace([' ', '-'], '_', basename($file))); // Normalize the file/folder name
    //         $targetPath = "{$storagePath}/{$normalizedName}"; // Target path in storage

    //         // If it's a directory, recursively call moveFolder for subdirectories
    //         if (is_dir($file)) {
    //             $this->moveFolder($file, $targetPath); // Recursive call for subdirectories
    //         } else {
    //             // If it's a file, move it using Laravel's Storage facade
    //             // Ensure the destination directory exists before moving the file
    //             if (!is_dir(dirname($targetPath))) {
    //                 mkdir(dirname($targetPath), 0755, true);
    //             }

    //             // Move the file
    //             rename($file, $targetPath);
    //         }
    //     }
    // }



    public function renderDocxAsPdf()
    {
        $inputFile = storage_path("app/public/trial/{$fileName}");
        $pdfFileName = pathinfo($fileName, PATHINFO_FILENAME) . '.pdf';
        $outputFile = storage_path("app/public/trial/{$pdfFileName}");

        // Convert DOCX to PDF on-the-fly using unoconv
        shell_exec("unoconv -f pdf {$inputFile}");

        return response()->file($outputFile);
    }



    public function show($fileName = "trial.docx")
    {
        // Determine file path
        $filePath = storage_path("app/public/trial/{$fileName}");
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

    //    return $extension;

        // Handle different file types
        switch ($extension) {
            case 'pdf':
                // Serve the PDF directly
                return response()->file($filePath);

            case 'docx':
                // Convert DOCX to PDF on-the-fly using unoconv
                $pdfFileName = pathinfo($fileName, PATHINFO_FILENAME) . '.pdf';
                $pdfFilePath = storage_path("app/public/trial/{$pdfFileName}");
                
                // Convert DOCX to PDF using unoconv
                shell_exec("unoconv -f pdf {$filePath}");
                
                // Serve the converted PDF
                return response()->file($pdfFilePath);

            case 'xlsx':
                // Convert XLSX to HTML using PhpSpreadsheet
                $spreadsheet = IOFactory::load($filePath);
                $writer = new Html($spreadsheet);
                
                // Save the HTML output to a string instead of a file
                $htmlOutput = '';
                ob_start(); // Start output buffering
                $writer->save('php://output');
                $htmlOutput = ob_get_clean(); // Get HTML content from the buffer
    
                // Return the HTML output as the response
                return response($htmlOutput)->header('Content-Type', 'text/html');

            case 'jpeg':
            case 'jpg':
            case 'png':
                // Serve the image directly
                return response()->file($filePath);

            default:
                return abort(415, 'Unsupported file type');
        }
    }










}

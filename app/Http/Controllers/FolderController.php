<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\File;
use Response;
// use Barryvdh\DomPDF\Facade\PDF;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\URL;
use Dompdf\Dompdf;
//use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF;



//use PhpOffice\PhpWord\IOFactory as WordIOFactory;
//use PhpOffice\PhpSpreadsheet\IOFactory as SpreadsheetIOFactory;

class FolderController extends Controller
{
    //


    public function uploadFolder(Request $request)
{
    // Validate uploaded files
    $request->validate([
        'files.*' => 'required|file|max:2048', // Ensure files are uploaded
    ]);

    // Initialize variables for folder mapping
    $rootFolderName = null;
    $folderMap = [];
    $uploadPath = 'uploads'; // Storage location

    foreach ($request->file('files') as $file) {
        $relativePath = $file->getClientOriginalName(); // Includes folder structure
        $pathParts = explode('/', $relativePath); // Split path into parts

        // Check the file extension (skip if not .pdf or .docx)
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, ['pdf', 'docx'])) {
            continue; // Skip the file and continue with the next one
        }

        // Process each part of the path (subfolder structure)
        foreach ($pathParts as $index => $part) {
            // Check if this is the root folder
            if ($index === 0 && !$rootFolderName) {
                $rootFolderName = $part;

                // Check if the root folder exists, otherwise create it
                $rootFolder = Folder::firstOrCreate([
                    'folder_name' => $rootFolderName,
                    'primary_folder' => 0, // Root folder
                    'file' => 1, // Constant value for folder
                    'folder_status' => 1, // Active
                    'folder_type' => 'folder',
                ]);

                $folderMap[$part] = $rootFolder->id; // Store root folder id
            } elseif ($index === count($pathParts) - 1) {
                // Handling the file (last part of the path)
                $parentFolderId = $folderMap[$pathParts[$index - 1]] ?? null;

                // Ensure parent folder exists for the file
                if ($parentFolderId !== null) {
                    Folder::create([
                        'folder_name' => $part,
                        'primary_folder' => $parentFolderId,
                        'file' => 1, // Constant value for file
                        'folder_status' => 1, // Active
                        'folder_type' => 'file',
                    ]);

                    // Store the file in the appropriate folder
                    $file->storeAs("$uploadPath/$rootFolderName", $relativePath);
                }
            } else {
                // Handle folders
                if (!isset($folderMap[$part])) {
                    // Save the folder if it does not exist
                    $parentFolderId = $folderMap[$pathParts[$index - 1]] ?? null;

                    // Check if parent folder exists
                    if ($parentFolderId !== null) {
                        $folder = Folder::firstOrCreate([
                            'folder_name' => $part,
                            'primary_folder' => $parentFolderId,
                            'file' => 1, // Constant value for folder
                            'folder_status' => 1, // Active
                            'folder_type' => 'folder',
                        ]);
                        $folderMap[$part] = $folder->id; // Store folder id
                    }
                }
            }
        }
    }

    return response()->json(['message' => 'Folder and files uploaded successfully.']);
}


    

    public function justTrial(Request $request, $id, $sub_id = null){
         // Check the route to determine the behavior
        // return Folder::all();
        $linkFolders = Folder::with('parentFolder')->get();

        $breadcrumbs = [];

        if ($sub_id) {
            $folder = Folder::findOrFail($sub_id);
        
        // Initialize an array to store parent folders without duplicates
            $parentFolders = [];
            
            // Traverse up to the parent folders and add them to the array
            $parentFolder = $folder;
            while ($parentFolder) {
                // Check if this folder has already been added
                if (!in_array($parentFolder->id, array_column($parentFolders, 'id'))) {
                    $parentFolders[] = $parentFolder;
                }
                $parentFolder = $parentFolder->parentFolder; // Go up to the parent folder
            }

            // Reverse the parent folders array to maintain the correct order (root to current folder)
            $parentFolders = array_reverse($parentFolders);
            
            // Add the parent folders to the breadcrumbs
            $breadcrumbs = array_merge($breadcrumbs, $parentFolders);

            // Add the current folder to the breadcrumb (last item)
            $breadcrumbs[] = $folder;
        }

        if ($sub_id === null) {
            // Handle the '/files_grid/{id}/main' route
            $data = Folder::where('file', $id)
                             ->where('primary_folder', 0)
                             ->get();
        } elseif ($sub_id !== null) {
            // Handle the '/files_grid/{id}/folder/{sub_id}' route
            $data = Folder::where('file', $id)
                             ->where('primary_folder', $sub_id)
                             ->get();
        } else {
            // Fallback in case of an unexpected route
            abort(404, 'Invalid route');
        }

        return view('folders.grid', compact('data', 'id', 'linkFolders', 'breadcrumbs', 'sub_id'));

        // Return data or process it as needed
        return response()->json($data);
    }

    public function viewFileAsPdf($id)
    {

        $document = Folder::where('id', $id)->first();

        $filePath = storage_path('app/public/uploads/'.$document->folder_name);

        $fileName = $fileName = basename($filePath);


      //  return $filePath;

        // return view('folders.view_file', compact('path'));

        $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

       // return $fileExtension;
        if (file_exists($filePath)) {
            $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    
            return view('folders.view_file', compact('filePath', 'fileExtension', 'fileName', 'document'));
        } else {
            
            abort(404, "File not found.");
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'folder_name' => 'required',
            'file' => 'nullable|string',
        ]);

        $fl = new Folder();

        $fl = $request->all();
        $fl['folder_status'] = '1';

       // return $fl;

        $data = Folder::createFolder($fl);
       // return $data;
        return redirect()->back()->with('message', 'Data successfully saved!', compact('data'));

    }


    // public function uploadFiles(Request $request){
    //     $data = $request->validate([
    //         'folder_name' => 'required',
    //         'file' => 'nullable|string',
    //     ]);


    //     if($request->folder_type == '2'){

            
    //         $request->validate([
    //             'folder_name.*' => 'required|mimes:pdf|max:2048', // Example validation rules
    //         ]);
    //         $files = $request->file('folder_name');

    //         foreach($requa as $file){
    //             $fileName = time() . '_' . $file->getClientOriginalName();
    //          //   $filePath = $file->storeAs('uploads', $fileName);
    //             $folder = new Folder();
    //             $folder->folder_name = $fileName;
    //         }   
    //     }

    //     return $folder;


    //     //return $request->all();

    //     Folder::createFolder($request->all());
    // }

    public function uploadFiles(Request $request){
       
        $savedFiles = [];
        $validatedData = $request->validate([
            'file' => 'required|string', // Ensure 'file' is a valid string
            'folder_status' => 'required|integer', // Ensure it's an integer
            'primary_folder' => 'required|string', // Ensure it's a string
            'folder_name' => 'required|array', // Ensure 'folder_name' is an array
            'folder_name.*' => 'file|max:2048', // Validate each uploaded file (max 2MB here)
        ]);

        foreach ($request->file('folder_name') as $file) {
            // Get the original file name
            

            $originalName = $file->getClientOriginalName();

            $file_name = strtolower((preg_match('/[- ]/', $originalName)) ? str_replace(['-', ' '], '_', $originalName)  : $originalName);
            $save_name = $file_name;

            $ext = pathinfo($originalName, PATHINFO_EXTENSION);
                if($ext == "docx"){

                    $docxPath = $file->getPathname();
                    $pdfName = pathinfo($save_name, PATHINFO_FILENAME) . '.pdf';
                    $phpWord = IOFactory::load($docxPath, 'Word2007');

                    $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
                    ob_start();
                    $htmlWriter->save('php://output'); // Output HTML directly to a buffer
                    $htmlContent = ob_get_clean(); // Capture the buffer contents

                    // Use Dompdf to convert HTML to PDF
                    $dompdf = new Dompdf();
                    $dompdf->loadHtml($htmlContent); // Load HTML string
                    $dompdf->setPaper('A4', 'portrait');
                    $dompdf->render();

                    // Save the PDF to a file
                    $pdfPath = storage_path("app/public/uploads/{$pdfName}");
                    if (!file_exists(dirname($pdfPath))) {
                        mkdir(dirname($pdfPath), 0775, true);
                    }
                    file_put_contents($pdfPath, $dompdf->output());

                    $save_name = $pdfName;
                }

                else {

                    $file->storeAs('uploads', $save_name, 'public');
                }
            
           


                // die();



                // //Save the file to the public storage
                // $filePath = $file->storeAs('uploads/' . $validatedData['primary_folder'], $originalName, 'public');

                // Save the details in the database
                $savedFile = Folder::create([
                    'file' => $validatedData['file'],
                    'folder_name' => $save_name,
                    'primary_folder' => $validatedData['primary_folder'],
                    'folder_status' => $validatedData['folder_status'],
                    'folder_type' => 'uploaded', // Set a default folder type
                ]);
                
                $savedFiles[] = $savedFile;

            
        }

     //   return $savedFiles;

        return redirect()->back()->with('message', 'File successfully uploaded!');
    }

    private function convertFileToPDF($file)
{
    // Check if the file is an image
    if (str_starts_with($file->getMimeType(), 'image/')) {
        // Create a PDF from an image
        $html = '<img src="data:image/png;base64,' . base64_encode(file_get_contents($file)) . '" style="max-width: 100%;">';
        $pdf = PDF::loadHTML($html);
        return $pdf->output();
    }

    // Check for other file types (like text files)
    if ($file->getClientOriginalExtension() === 'txt') {
        // Convert plain text to HTML and generate a PDF
        $content = nl2br(e(file_get_contents($file)));
        $html = '<pre>' . $content . '</pre>';
        $pdf = PDF::loadHTML($html);
        return $pdf->output();
    }

    // Handle unsupported file types
    throw new \Exception('Unsupported file type for conversion.');
}



    // public function uploadFiles(Request $request)
    // {
    //     // Validate the incoming request
    //     $data = $request->validate([
    //         'folder_type' => 'required|integer', // Validate folder type
    //         'file' => 'nullable|array', // Files as an array
    //         'file.*' => 'required_if:folder_type,2|mimes:pdf|max:2048', // Validate individual files when folder_type is 2
    //     ]);

    //     // Initialize an array to store folder records
    //     $folders = [];

    //     // Check if folder_type is 2 for file uploads
    //     if ($request->folder_type == 2) {
    //         $files = $request->file('file'); // Get uploaded files

    //         if ($files) {
    //             foreach ($files as $file) {
    //                 // Generate a unique file name
    //                 $fileName = time() . '_' . $file->getClientOriginalName();
    //                 // Save the file to the 'uploads' directory and get the path
    //                 $filePath = $file->storeAs('uploads', $fileName);

    //                 // Save the folder details to the database
    //                 $folder = Folder::create([
    //                     'file' => $filePath, // Store file path as a string
    //                     'folder_name' => $fileName, // Set folder_name to the file's name
    //                     'primary_folder' => $request->input('primary_folder', null), // Default null if not provided
    //                     'folder_status' => $request->input('folder_status', 'active'), // Default status
    //                     'folder_type' => 2, // Set folder_type to 2
    //                 ]);

    //                 $folders[] = $folder;
    //             }
    //         }
    //     } else {
    //         // Handle other folder types (without files)
    //         $folder = Folder::create([
    //             'folder_name' => $request->input('folder_name'),
    //             'primary_folder' => $request->input('primary_folder', null), // Default null if not provided
    //             'folder_status' => $request->input('folder_status', 'active'), // Default status
    //             'folder_type' => $request->folder_type,
    //         ]);

    //         $folders[] = $folder;
    //     }

    //     return response()->json([
    //         'message' => 'Folder(s) created successfully',
    //         'folders' => $folders,
    //     ]);
    // }

    public function getAllFiles(){

        $data = File::getAllFiles();
        return view('cases.folders', compact('data'));
    }

    public function index()
    { 
        $data = Folder::getAllFolders();


        foreach($data as $dt){

           $dt->theme = $dt->status = 1 ? 'success' : 'danger';
           $dt->file_status = $dt->status = 1 ? 'Open' : 'Closed';

        }

        //return $data;
        return view('folders.list', compact('data'));


        
       // return response()->json(['items' => $data]);
    }


    public function create()
    {
        return view('cases.create');
    }

    public function getFileDocuments($id) {

        $data = Folder::where('file', $id)->where('primary_folder', '0')->get();

        if (!$data) {
            abort(404, 'File not found');
        }

        return $data;

        return view('folders.grid', compact('data', 'id'));
    }


    public function getFileDocumentsData($id){

        $data = Folder::where('file', $id)->where('primary_folder', '0')->get();


        if (!$data) {
            abort(404, 'File not found');
        }

        return $data;


    }

    public function getSubFolders($id){
        $data = Folder::where('primary_folder', $id)->get();

        return view('folders.grid', compact('data', 'id'));
        return $data;
    }

    public function createNewDocument(){
        return view('documents.create');
    }

    

    public function viewFileAPdf(string $id)
    {


        $document = Folder::where('id', $id)->first();
        
        return $document;
        

        $path = storage_path('app/public/uploads/0/ABASS AHMED RESUME.docx');

    // Use TemplateProcessor instead of PhpWord to load the template
    $templateProcessor = new TemplateProcessor($path);

    // Now, you can populate the template, for example, with values
    // $templateProcessor->setValue('some_placeholder', 'value');

    $pdf = PDF::loadView('view', compact('templateProcessor'));

        //return $path;

        // if (!file_exists($path)) {
        //     abort(404, 'File not found');
        // }
    
        // // Convert .docx content to HTML
        // $phpWord = IOFactory::load($path); // Load .docx file
        // $htmlWriter = IOFactory::createWriter($phpWord, 'HTML'); // Convert to HTML
    
        // // Capture HTML output
        // ob_start();
        // $htmlWriter->save('php://output');
        // $htmlContent = ob_get_clean();
    
        // // Generate PDF from HTML
        // $pdf = Pdf::loadHTML($htmlContent)->setPaper('A4', 'portrait');

        // return $phpWord;
    
        // // Render the PDF directly in the view
        // return view('folders.view_file', [
        //     'pdfContent' => $pdf->output() // Pass raw PDF output
        // ]);
    }
    
    // private function readDocxFile($path)
    // {
    //     // Use PhpWord to read DOCX files
    //     $phpWord = WordIOFactory::load($path);
    //     $content = '';

    //     // Iterate through sections
    //     foreach ($phpWord->getSections() as $section) {
    //         // Iterate through elements in the section
    //         foreach ($section->getElements() as $element) {
    //             // Check if the element is a TextRun (contains text)
    //             if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
    //                 // Get all text parts from the TextRun and append to content
    //                 foreach ($element->getElements() as $textElement) {
    //                     if (method_exists($textElement, 'getText')) {
    //                         $content .= $textElement->getText() . " ";
    //                     }
    //                 }
    //             } elseif ($element instanceof \PhpOffice\PhpWord\Element\Text) {
    //                 // If it's a simple text element, just get the text
    //                 $content .= $element->getText() . " ";
    //             }
    //         }
    //     }

    //     return $content;
    // }

    
    private function readExcelFile($path)
    {
        // Use PhpSpreadsheet to read Excel files
        $spreadsheet = SpreadsheetIOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $content = '';
    
        foreach ($sheet->toArray() as $row) {
            $content .= implode("\t", $row) . "\n";
        }
    
        return $content;
    }


}

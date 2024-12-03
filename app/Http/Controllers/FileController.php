<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Folder;
use App\Models\FileContact;
use App\Models\FileFinance;
use App\Models\Document;
use App\Imports\FileImport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use DateTime;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller
{
    //



    public function saveFileContact(Request $request){
        //return $request->all();

        $request->validate([
            'fl_title' => 'required|string|max:255',
            'fl_contact' => 'required|string|max:255',
        ]);


        
        $user = FileContact::create([ 
            'fl_title' => $request->input('fl_title'),
            'fl_contact' => $request->input('fl_contact'),
            'fl_file'=> $request->input('fl_file'),
        ]);
        

        return redirect()->back()->with('message', 'User successfully saved!');

    }


    public function saveFileFinance(Request $request){
        $request->validate([
            'fn_title' => 'required',
            'fn_amount' => 'required',
            'fn_filename' => 'required',
            'fn_file' => 'required'
        ]);


        //return $request->all();

        $file = $request->file('fn_filename');
       
        if (!$file) {
            return response()->json([
                'success' => false,
                'message' => 'No file was uploaded.',
            ], 400);
        }

        $fileName = $file->getClientOriginalName();


        $file_name = strtolower((preg_match('/[- ]/', $fileName)) ? str_replace(['-', ' '], '_', $fileName)  : $fileName);
        $save_name = 'fin_'.$file_name;

        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
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
            $pdfPath = storage_path("app/public/finance/{$pdfName}");
            if (!file_exists(dirname($pdfPath))) {
                mkdir(dirname($pdfPath), 0775, true);
            }
            file_put_contents($pdfPath, $dompdf->output());

            $save_name = $pdfName;

        }

        else {
            $file->storeAs('finance', $save_name, 'public');

        
            
        }   $user = FileFinance::create([ 
                'fn_title' => $request->input('fn_title'),
                'fn_filename' => $save_name,
                'fn_file' => $request->input('fn_file'),
                'fn_amount' => $request->input('fn_amount'),
                'fn_type'=> $request->input('fn_type'),
                'fn_amount'=> $request->input('fn_type') == '0' ? '-'.$request->input('fn_amount') : $request->input('fn_amount'),
            ]);
        
        return redirect()->back()->with('message', 'User successfully saved!');

    }


    public function importExcel(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $data = array_map('str_getcsv', file($request->file('file')));


     //   return $data;

        // Import the Excel file
        Excel::import(new FileImport, $request->file('file'));

        return response()->json(['message' => 'Excel data imported successfully!'], 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'file_no' => 'required',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'date_of_loss' => 'required',
        ]);


        //return $request->all();

        File::createFile($request->all());

        return redirect()->back()->with('message', 'Data successfully saved!');

    }

    public function edit($id)
    {
        $data = File::findOrFail($id);
        return view('cases.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $resource = File::findOrFail($id);

        // Validate input
        $validated = $request->validate([
            'file_no' => 'required',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'date_of_loss' => 'required',
            // Add other fields and validation rules
        ]);


       // return $request->all();


        $resource->update([
            'file_no' => $request['file_no'],
            'file_type' => $request['file_type'],
            'file_city' => $request['file_city'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'tort' => $request['tort'],
            'date_of_loss' => $request['date_of_loss'],
            'opened' => $request['opened'],
            'claim_no' => $request['claim_no'],
            'policy_no' => $request['policy_no'],
            'client_address' => $request['client_address'],
            'client_phone_no' => $request['client_phone_no'],
            'date_of_birth' => $request['date_of_birth'],
            'drivers_license' => $request['drivers_license'],
            'ins_company' => $request['ins_company'],
            'ins_address' => $request['ins_address'],
            'adj_name' => $request['adj_name'],
            'adj_phone_no' => $request['adj_phone_no'],
            'adj_fax_no' => $request['adj_fax_no'],
            'family_doctor' => $request['family_doctor'],
            'doctor_address' => $request['doctor_address'],
            'doctor_phone_no' => $request['doctor_phone_no'],
            'doc_fax_no' => $request['doc_fax_no'],
            'rehab' => $request['rehab'],
            'rehab_phone_no' => $request['rehab_phone_no'],
            'rehab_fax_no' => $request['rehab_fax_no'],
            'assessment_center' => $request['assessment_center'],
            'assessment_fax_no' => $request['assessment_fax_no'],
            'ohip_no' => $request['ohip_no'],
            'sin_no' => $request['sin_no']
        ]);

        // Update the resource
      //  $resource->update($resource);
        return redirect()->back()->with('message', 'Data successfully updated!');

    }


    public function index()
    { 

        $data = File::all()->map(function($dt) {
            $dt->file_no =  str_replace(' ', '', $dt->file_no);
            $dt->theme = $dt->status = 1 ? 'success' : 'danger';
            $dt->file_status = $dt->status = 1 ? 'Open' : 'Closed';
            $later = new DateTime(date("Y-m-d"));
            $earlier = new DateTime($dt->date_of_loss);
            $dt->dol_days = $later->diff($earlier)->format("%a") + 100;
            $dt->alert = $dt->dol_days < 1000 ? '' : 'hidden';
            $dt->dol_theme = $dt->dol_days < 1000 ? 'danger' : 'light';
            return $dt;
        });

        //return $data;
    
        return view('cases.list', compact('data'));
    }


    public function create()
    {
        return view('cases.create');
    }



    public function getNextFileNo(Request $request)
    {
        $file_type = $request->query('file_type');
        if (!$file_type || strlen($file_type) < 2) {
            return response()->json(['error' => 'Invalid file type'], 400);
        }

        $nextFileNo = File::generateFileNo($file_type);

        return response()->json(['NextFileNo' => $nextFileNo]);
    }

    public function show($id)
    {
        $data = File::find($id);

        $contacts = FileContact::where('fl_file', $id)->get();
        $finances = FileFinance::where('fn_file', $id)->get()->map(function($f){
            $f->date = $f->created_at->format('d/m/Y');
            return $f;
        });

        $files = Folder::where('file', $data->id)->where('folder_type', 'uploaded')->get();
        $documents = Document::where('file_no', $data->id)->orderBy('updated_at', 'DESC')->get();

       // return $documents;

        $fn = json_decode($finances, true);

        $amount = 0;

        foreach($fn as $fn){
            $amount += (float)$fn['fn_amount'];
        }


      //  return $amount;

      //  return $finances;
       

        if (!$data) {
            abort(404, 'File not found');
        }

        // return $data;
        return view('cases.view', compact('data', 'contacts', 'finances', 'amount', 'files', 'documents'));

    }

    public function getFileDocuments($id) {

        $data = Folder::where('folder', $id)->get();

        if (!$data) {
            abort(404, 'File not found');
        }

        return $data;
    }

    


}
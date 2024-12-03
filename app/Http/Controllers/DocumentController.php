<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $comments = DocumentComments::where('status', '1')->latest()->get();
        return response()->json($comments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'file_no' => 'required',
            'title' => 'required',
            'creater' => 'required',
            'content' => 'required|string',
        ]);

        // Save the content to the database
        // Assuming you have a Content model and table
        \App\Models\Document::create([
            'file_no' => $request->input('file_no'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'creater' => $request->input('creater')
        ]);

        return redirect()->back()->with('success', 'Document saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $document = Document::find($id);

        return view('documents.view', compact('document'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $document = Document::find($id);

        return view('documents.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        $document = Document::findOrFail($id);
        $document->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);
    
        return redirect()->route('documents.show', $id)
                         ->with('success', 'Document updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentComment;
use App\Models\User;

class DocumentCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'comment' => 'required|string',
            'doc' => 'required'
        ]);

        $comment = DocumentComment::create([
            'doc' => $validated['doc'],
            'comment' => $validated['comment'],
            'creator' => auth()->user()->id, // or $request->creator if provided
            'status' => 'active',
        ]);

        return response()->json($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $comments = DocumentComment::where('status', 'active')->where('doc', $id)->latest()->get()->map(function($cm){
            $cm->time = $cm->created_at->format('D, d M Y, h:i A');
            $user = User::where('id', $cm->creator)->first();
            $cm->creator_name = $user->name;

            return $cm;
        });
        return response()->json($comments);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

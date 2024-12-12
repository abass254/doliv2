<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\FileFinance;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        

        $finances = FileFinance::all()->map(function($f){
            $f->date = $f->created_at->format('d/m/Y');
            $file = File::where('id', $f->fn_file)->first();
            $f->file_no = $file->file_no;
            return $f;
        });;

        $fn = json_decode($finances, true);

        $amount = 0;

        foreach($fn as $fn){
            $amount += (float)$fn['fn_amount'];
        }


        return view('transactions.list', compact('finances', 'amount'));

       // return $finances;

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = File::all()->map(function($dt){
            $finance = FileFinance::where('fn_file', $dt->id)->get();
            $dt->tt = count($finance);
            return $dt;
        });


        // $finance = count(FileFinance::where('fn_file', '1')->get());

        // return $finance;




      //  return $data;
        return view('transactions.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

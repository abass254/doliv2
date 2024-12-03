<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Auth;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $data = Task::where('ts_status', '1')->get();
        

        foreach($data as $dt){

           $dt->theme = $dt->ts_status = 1 ? 'warning' : 'primary';
           $dt->status = $dt->ts_status = 1 ? 'Pending' : 'Approved';
           $dt->ts_time = $dt->ts_time. ' mins';
        //    $dt->ts_date = date_format($dt->ts_date, "d/m/Y");


        }

        //return $data;
        return view('tasks.list', compact('data'));


        
       // return response()->json(['items' => $data]);
    }
    public function myTasksBoard(){


        $data = Task::where('ts_user', Auth::user()->id)->where('ts_status', '!=', '3')->get()->map(function($ts){
            $ts->time_created = $ts->created_at->format('D, d M Y, h:i A');
            $ts->status = $ts->ts_status == '1' ? 'Pending' : ($ts->ts_status == '2' ? 'Approved' : 'Cancelled');
            $ts->ts_time = $ts->ts_time. ' mins';
            $ts->theme = $ts->ts_status == '1' ? 'warning' : ($ts->ts_status == '2' ? 'primary' : 'danger');
            return $ts;
        });

      
        return view('tasks.board', compact('data'));
    }


    public function allTasks(){

        $data = Task::where('ts_status', '!=', '3')->get()->map(function($ts){
            $user = User::where('id', $ts->ts_user)->first();
            $ts->time_created = $ts->created_at->format('D, d M Y, h:i A');
            $ts->status = $ts->ts_status == '1' ? 'Pending' : ($ts->ts_status == '2' ? 'Approved' : 'Cancelled');
            $ts->ts_time = $ts->ts_time. ' mins';
            $ts->theme = $ts->ts_status == '1' ? 'warning' : ($ts->ts_status == '2' ? 'primary' : 'danger');
            $ts->owner = $user->name;
            return $ts;
        });

        return view('tasks.all_tasks', compact('data'));
    }


    public function pendingTasks(){


        $data = Task::where('ts_status', '1')->where('ts_status', '!=', '3')->get()->map(function($ts){
            $user = User::where('id', $ts->ts_user)->first();
            $ts->time_created = $ts->created_at->format('D, d M Y, h:i A');
            $ts->status = $ts->ts_status == '1' ? 'Pending' : ($ts->ts_status == '2' ? 'Approved' : 'Cancelled');
            $ts->ts_time = $ts->ts_time. ' mins';
            $ts->theme = $ts->ts_status == '1' ? 'warning' : ($ts->ts_status == '2' ? 'primary' : 'danger');
            $ts->owner = $user->name;
            return $ts;
        });

      
        return view('tasks.pending_tasks', compact('data'));
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

        $data = $request->validate([
            'ts_activity' => 'required',
            'ts_file' => 'required',
            'ts_user' => 'required',
            'ts_date' => 'required',
            'ts_time' => 'required',
        ]);


        //return $request->all();

        Task::create($request->all());

        return redirect()->back()->with('message', 'Data successfully saved!');
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

        $resource = Task::findOrFail($id);

        // Validate input
        $validated = $request->validate([
            'ts_activity' => 'required',
            'ts_file' => 'required',
            'ts_user' => 'required',
            'ts_date' => 'required',
            'ts_time' => 'required',
        ]);

        $resources->update([
            'ts_activity' => $request['ts_activity'],
            'ts_file' => $request['ts_file'],
            'ts_date' => $request['ts_date'],
            'ts_time' => $request['ts_time'],
            'ts_ref' => $request['ts_ref'],
            'ts_start' => $request['ts_start'],
            'ts_end' => $request['ts_end'],
        ]);


        return redirect()->back()->with('message', 'Data successfully updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function approveSingle($id)
    {
        $task = Task::findOrFail($id);
        $task->ts_status = 2;
        $task->save();

        return redirect()->back()->with('success', 'Task approved successfully.');
    }

    public function approveBulk(Request $request)
    {
        $validated = $request->validate([
            'task_ids' => 'required|array',
            'task_ids.*' => 'exists:tasks,id',
        ]);

        Task::whereIn('id', $validated['task_ids'])->update(['ts_status' => 2]);

        return redirect()->back()->with('success', 'Selected tasks approved successfully.');
    }

}

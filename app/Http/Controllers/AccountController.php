<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Hash;
use Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $data = User::all();
        return view('users.list', compact('data'));
        
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('users.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'phone' => 'required'
        ]);

        
        $user = User::create([ 
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('phone')),
            'role'=> $request->input('role'),
            'gender'=> $request->input('gender'),
            'photo'=> $request->input('photo'),
            'phone'=> $request->input('phone'),
        ]);

        return redirect()->back()->with('message', 'User successfully saved!');

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
        $data = User::findOrFail($id);
        return view('users.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $resource = User::findOrFail($id);

        // Validate input
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'nullable|string',
            'role' => 'required',
        ]);

        $resource->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'role' => $request['role'],
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

    public function homePage(){

        $tasks = Task::where('ts_user', Auth::user()->id)->where('ts_status', '!=', '3')->get()->map(function($ts){
            $ts->time_created = $ts->created_at->format('D, d M Y, h:i A');
            $ts->status = $ts->ts_status == '1' ? 'Pending' : ($ts->ts_status == '2' ? 'Approved' : 'Cancelled');
            $ts->theme = $ts->ts_status == '1' ? 'warning' : ($ts->ts_status == '2' ? 'primary' : 'danger');
            $ts->icon = $ts->ts_status == '1' ? 'warning' : ($ts->ts_status == '2' ? 'primary' : 'danger');
            return $ts;
        });

      

       // return $tasks;
        return view('home', compact('tasks'));
    }


    public function login(Request $request)
    {
      //  return '1111';
        // Validate login credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Get the authenticated user
            $user = Auth::user();

            // Redirect based on role
            return redirect()->intended('/home');
        }

        // If login fails, redirect back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login')->with('success', 'Successfully logged out.'); // Redirect to login page
    }


    public function changePassword(Request $request){
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed'],
        ]);

        $user = Auth::user();

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match']);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('status', 'Password updated successfully!');
    }
}

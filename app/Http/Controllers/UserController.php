<?php

namespace App\Http\Controllers;

use \App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name','ASC')->get();

        // Return view with users data
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input fields, you can add more validation rules if needed
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:Admin,Staff',
        ], [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than :max characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'role.required' => 'The role field is required.',
            'role.in' => 'The selected role is invalid.',
        ]);


        // Create and save the user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt('test123');

        $user->save();

        flash()->addSuccess('User created successfully');

        // Redirect to the users index page with a success message
        return redirect()->route('users.index')->with('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the input fields, you can add more validation rules if needed
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Ignore the user's current email
            'role' => 'required|in:Admin,Staff',
        ], [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than :max characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'role.required' => 'The role field is required.',
            'role.in' => 'The selected role is invalid.',
        ]);

        // Update the user's information
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        $user->save();

        flash()->addSuccess('User updated successfully');

        // Redirect to the users index page with a success message
        return redirect()->route('users.index')->with('success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user)
    {
        try {
            // Attempt to delete the user
            $user->delete();

            flash()->addSuccess('User deleted successfully');
        } catch (QueryException $e) {
            // Handle the exception
            flash()->addError('Error deleting user: ' . $e->getMessage());
        }

        // Redirect back to the users index page
        return redirect()->route('users.index');
    }
}

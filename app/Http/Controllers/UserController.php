<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                $users = User::simplePaginate(25);

                return view('users.index', compact('users'));
            }
        }
        abort(403);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check() && Auth::user()->role !== 'admin') {
            abort(403);
        }
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'string', 'min:12', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/', 'confirmed'],
            'role' => 'required'
        ],
            [
                'name.regex' => 'The name field must contain only letters.',
                'email.unique' => 'The email address is already in use.',
            ]);

        $data = $request->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role']
        ]);

        return redirect(route('users.index'))->with('status', 'User created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return view('users.edit', compact('user'));
            }
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email',
                    'role' => 'required'
                ],
                    [
                        'name.regex' => 'The name field must contain only letters.',
                        'email.unique' => 'The email address is already in use.',
                    ]);

                $data = $request->all();

                $user->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'role' => $data['role']
                ]);

                return redirect()->route('users.index')->with('status', 'User updated!');
            }
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                $user->delete();

                return redirect(route('users.index'));
            }
        }
        abort(403);
    }
}

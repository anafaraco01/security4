<?php

namespace App\Http\Controllers;

use App\Models\Foo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FooController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foos = Foo::simplePaginate(25);

        return view('foos.index', compact('foos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'user' || Auth::user()->role === 'admin') {
                return view('foos.create');
            }
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'user' || Auth::user()->role === 'admin') {
                $request->validate([
                    'name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'thud' => 'required|numeric|min: 0',
                    'wombat' => 'required'
                ],
                    [
                        'name.regex' => 'The name field must contain only letters.',
                        'thud.numeric' => 'The thud field must be a number.',
                        'thud.min' => 'The thud field must be at least 0.'
                    ]);

                $data = $request->all();

                Foo::create([
                    'name' => $data['name'],
                    'thud' => $data['thud'],
                    'wombat' => $data['wombat'],
                    'user_id' => Auth::user()->id
                ]);

                return redirect(route('foos.index'))->with('status', 'Foo created!');
            }
        }
        abort(403);
    }

    /**
     * Display the specified resource.
     */
    public function show(Foo $foo)
    {
        return view('foos.show', compact('foo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foo $foo)
    {
        if (Auth::check()) {
            if (Auth::user()->id === $foo->user_id || Auth::user()->role === 'admin') {
                return view('foos.edit', compact('foo'));
            }
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Foo $foo)
    {
        if (Auth::check()) {
            if (Auth::user()->id === $foo->user_id || Auth::user()->role === 'admin') {
                $foo->update($this->validateFoo($request));

                return redirect(route('foos.show', $foo))->with('status', 'Foo updated!');
            }
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Foo $foo)
    {
        if (Auth::check()) {
            if (Auth::user()->id === $foo->user_id || Auth::user()->role === 'admin') {
                $foo->delete();

                return redirect(route('foos.index'));
            }
        }
        abort(403);
    }

    /*
     *
     * @return \array
     */
    public function validateFoo(Request $request): array
    {
        return $request->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'thud' => 'required|numeric|min: 0',
            'wombat' => 'required'
        ],
            [
                'name.regex' => 'The name field must contain only letters.',
                'thud.numeric' => 'The thud field must be a number.',
                'thud.min' => 'The thud field must be at least 0.'
            ]);
    }
}

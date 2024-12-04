<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email',
            'tel1' => 'required|digits:3',
            'tel2' => 'required|digits:4',
            'tel3' => 'required|digits:4',
            'address' => 'required|string|max:255',
            'inquiry_type' => 'required',
            'inquiry_content' => 'required|string|max:1000',
        ]);

        return redirect('/thanks');
    }
}

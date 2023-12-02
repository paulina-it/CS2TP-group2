<?php

namespace App\Http\Controllers;

use App\Models\ContactQuery;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'first-name' => 'required|string|max:255',
            'last-name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'text' => 'required|string',
        ]);

        $contactQuery = new ContactQuery();
        $contactQuery->firstName = request('first-name');
        $contactQuery->lastName = request('last-name');
        $contactQuery->email = request('email');
        $contactQuery->text = request('text');

        // $contactQuery->save();
        // var_dump($contactQuery);

        return redirect()->route('contact.show')->with('success', 'Form submitted successfully!');
    }
    public function show() {
        return view('contact');
    }
}

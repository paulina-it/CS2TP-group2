<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerQuery;

class CustomerQueryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first-name' => 'required|string|max:255',
            'last-name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'regex:/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}(?:\.[a-zA-Z]{2,})?$/',
            ],
            'message' => 'required|string',
        ]);

        $customerQuery = new CustomerQuery();
        $customerQuery->firstName = request('first-name');
        $customerQuery->lastName = request('last-name');
        $customerQuery->email = request('email');
        $customerQuery->query_type = request('query-type');
        $customerQuery->message = request('message');

        $customerQuery->save();

        return redirect()->route('contact.show')->with('success', 'Form submitted successfully!');
    }

    public function show() {
        return view('contact');
    }
}

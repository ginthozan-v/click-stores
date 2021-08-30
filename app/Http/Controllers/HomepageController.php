<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Contact;

class HomepageController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email',
                'message' => 'required',
            ]);
            
            $data = $request->all();
            $contact = new Contact;

            $contact->Name = $data['name'];
            $contact->Email = $data['email'];
            $contact->Subject = $data['subject'];
            $contact->Message = $data['message'];
            $contact->save();
            return redirect()->back()->with('flash_message_success', 'Message send Successfully!');
        }

        if ($request->isMethod('get')) {
            return view('contact');
        }
    }
}

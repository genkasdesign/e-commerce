<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function send(Request $request)
    {
        // Validation minimale (optionnelle)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // Pour l'instant, on simule l'envoi
        // (plus tard, on pourra envoyer un email)
        return redirect()->route('contact')->with('success', 'Votre message a été envoyé.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = User::where('is_admin', false)->get(); // seulement les clients
        return view('admin.clients.index', compact('clients'));
    }

    public function edit(User $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, User $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $client->id,
            'is_admin' => 'boolean',
        ]);

        $data = $request->only('name', 'email');
        $data['is_admin'] = $request->has('is_admin') ? 1 : 0;

        $client->update($data);
        return redirect()->route('admin.clients.index')->with('success', 'Client mis à jour.');
    }

    public function destroy(User $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client supprimé.');
    }
}
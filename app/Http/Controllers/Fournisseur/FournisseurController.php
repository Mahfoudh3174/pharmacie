<?php

namespace App\Http\Controllers\Fournisseur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index()
    {
        $fournisseurs = Fournisseur::latest()->paginate(10);
        return view('fournisseur.index', compact('fournisseurs'));
        return view('fournisseur.index');
    }

    public function create()
    {
        return view('fournisseur.create');
    }

    public function store(Request $request)
    {
        // Logic to store the fournisseur
        return to_route('fournisseurs.index');
    }

    public function edit($id)
    {
        return view('fournisseur.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update the fournisseur
        return redirect()->route('fournisseurs.index');
    }

    public function destroy($id)
    {
        // Logic to delete the fournisseur
        return redirect()->route('fournisseurs.index');
    }
}

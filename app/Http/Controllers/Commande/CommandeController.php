<?php

namespace App\Http\Controllers\Commande;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::latest()-> paginate(10);
        
        return view('commande.index', compact('commandes'));
       
    }

    public function create()
    {
        return view('commande.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'medicament' => 'required|array',
            'medicament.*.id' => 'required|exists:medicaments,id',
            'medicament.*.quantity' => 'required|integer|min:1',
        ]);
        // Logic to store the commande
        DB::beginTransaction();
        
        $commande = Commande::create([
            'user_id' => $request->user_id,
        ]);
        foreach ($request->medicament as $medicament) {
            $commande->medicaments()->attach($medicament['id'], ['quantity' => $medicament['quantity']]);
        }
        DB::commit();
        return to_route('commandes.index');
    }

    public function edit($id)
    {
        return view('commande.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update the commande
        return redirect()->route('commandes.index');
    }

    public function destroy($id)
    {
        // Logic to delete the commande
        return redirect()->route('commandes.index');
    }
    public function show($id)
    {
        $commande = Commande::findOrFail($id);
        return view('commande.show', compact('commande'));
    }
    public function delete($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->delete();
        return redirect()->route('commandes.index')->with('success', 'Commande deleted successfully.');
    }
   
}

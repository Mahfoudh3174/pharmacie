<?php

namespace App\Http\Controllers\Medicament;

use App\Http\Controllers\Controller;
use App\Models\Medicament;
use Illuminate\Http\Request;

class MedicamentController extends Controller
{
    

public function index()
{
    $medicaments = Medicament::paginate(10);
    
    return view('admin.medicament.index', compact('medicaments'));
    
}
public function create()
{
    return view('medicament.create');


}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
    ]);

    Medicament::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'category_id' => $request->category_id,
    ]);

    return to_route('medicament.index')->with('success', 'Medicament created successfully.');
}
public function show($id)
{
    $medicament = Medicament::findOrFail($id);
    return view('medicament.show', compact('medicament'));

}
public function edit($id)
{
    $medicament = Medicament::findOrFail($id);
    return view('medicament.edit', compact('medicament'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
    ]);

    $medicament = Medicament::findOrFail($id);
    $medicament->update($request->all());

    return to_route('medicament.index')->with('success', 'Medicament updated successfully.');
}
public function destroy($id)
{
    $medicament = Medicament::findOrFail($id);
    $medicament->delete();

    return to_route('medicament.index')->with('success', 'Medicament deleted successfully.');
}
}
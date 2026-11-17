<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Http\Requests\EquipmentRequest;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $equipment = Equipment::with('user')->latest()->paginate(10);
    return view('equipment.index', compact('equipment'));
}

public function create()
{
    return view('equipment.create');
}

public function store(EquipmentRequest $request)
{
    $request->user()->equipment()->create($request->validated());

    return redirect()->route('equipment.index')
        ->with('success', 'Equipment added successfully.');
}

public function show(Equipment $equipment)
{
    return view('equipment.show', compact('equipment'));
}

public function edit(Equipment $equipment)
{
    return view('equipment.edit', compact('equipment'));
}

public function update(EquipmentRequest $request, Equipment $equipment)
{
    $equipment->update($request->validated());

    return redirect()->route('equipment.index')
        ->with('success', 'Equipment updated successfully.');
}

public function destroy(Equipment $equipment)
{
    $equipment->delete();

    return redirect()->route('equipment.index')
        ->with('success', 'Equipment deleted.');
}
}

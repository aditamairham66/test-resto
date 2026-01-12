<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MasterIngridient;
use Illuminate\Http\Request;

class IngridientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.master.ingridient.index', [
            'title' => 'Ingridient',
            'ingridients' => MasterIngridient::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master.ingridient.form', [
            'title' => 'Create Ingridient',
            'url' => route('ingridient.store'),
            'form' => new MasterIngridient(),
            'method' => 'POST',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        MasterIngridient::create([
            'name' => $request->name,
        ]);

        return redirect()->route('ingridient.index')->with('success', 'Ingridient created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterIngridient $ingridient)
    {
        return view('pages.master.ingridient.form', [
            'title' => 'Edit Ingridient',
            'url' => route('ingridient.update', $ingridient),
            'form' => $ingridient,
            'method' => 'PUT',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterIngridient $ingridient)
    {
        $ingridient->update([
            'name' => $request->name,
        ]);

        return redirect()->route('ingridient.index')->with('success', 'Ingridient updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterIngridient $ingridient)
    {
        $ingridient->delete();

        return redirect()->route('ingridient.index')->with('success', 'Ingridient deleted successfully.');
    }
}

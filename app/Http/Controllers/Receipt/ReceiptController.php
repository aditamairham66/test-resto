<?php

namespace App\Http\Controllers\Receipt;

use App\Http\Controllers\Controller;
use App\Models\MasterCategory;
use App\Models\MasterIngridient;
use App\Models\Receipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.receipt.index', [
            'title' => 'Receipt',
            'receipts' => Receipt::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.receipt.form', [
            'title' => 'Create Receipt',
            'url' => route('receipt.store'),
            'form' => new Receipt(),
            'method' => 'POST',
            'categories' => MasterCategory::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Receipt::create([
            'name' => $request->name,
            'master_category_id' => $request->category_id,
        ]);

        return redirect()->route('receipt.index')->with('success', 'Receipt created successfully.');
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
    public function edit(Receipt $receipt)
    {
        return view('pages.receipt.form', [
            'title' => 'Edit Receipt',
            'url' => route('receipt.update', $receipt->id),
            'form' => $receipt,
            'method' => 'PUT',
            'categories' => MasterCategory::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receipt $receipt)
    {
        $receipt->update([
            'name' => $request->name,
            'master_category_id' => $request->category_id,
        ]);

        return redirect()->route('receipt.index')->with('success', 'Receipt updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receipt $receipt)
    {
        $receipt->delete(); 

        return redirect()->route('receipt.index')->with('success', 'Receipt deleted successfully.');
    }
}

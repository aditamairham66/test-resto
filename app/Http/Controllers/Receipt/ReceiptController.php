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
    public function index(Request $request)
    {   
        $receipts = Receipt::query()
            ->when($request->q, function ($query, $q) {
                $query->where('name', 'like', '%' . $q . '%');
            })
            ->when($request->category_id, function ($query, $category_id) {
                $query->where('master_category_id', $category_id);
            })
            ->when($request->ingridient_id, function ($query, $ingridient_id) {
                $query->whereHas('ingridients', function ($query) use ($ingridient_id) {
                    $query->where('master_ingridient_id', $ingridient_id);
                });
            });

        return view('pages.receipt.index', [
            'title' => 'Receipt',
            'receipts' => $receipts->get(),
            'categories' => MasterCategory::all(),
            'ingridients' => MasterIngridient::all(),
            'q' => $request->q,
            'category_id' => $request->category_id,
            'ingridient_id' => $request->ingridient_id,
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

<?php

namespace App\Http\Controllers\Receipt;

use App\Http\Controllers\Controller;
use App\Models\MasterIngridient;
use App\Models\ReceiptIngridient;
use Illuminate\Http\Request;

class ReceiptIngridientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $receipts = ReceiptIngridient::query()
            ->when($request->q, function ($query, $q) {
                $query->whereHas('receipt', function ($query) use ($q) {
                    $query->where('name', 'like', '%' . $q . '%');
                });
            })
            ->when($request->ingridient_id, function ($query, $ingridient_id) {
                $query->where('master_ingridient_id', $ingridient_id);
            })->where('receipt_id', $request->receipt_id);

        return view('pages.receipt.ingridient.index', [
            'title' => 'Receipt Ingridient',
            'receipts' => $receipts->get(),
            'receipt_id' => $request->receipt_id,
            'ingridients' => MasterIngridient::all(),
            'q' => $request->q,
            'ingridient_id' => $request->ingridient_id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('pages.receipt.ingridient.form', [
            'title' => 'Create Receipt Ingridient',
            'url' => route('receipt.ingridient.store', ['receipt_id' => $request->receipt_id]),
            'form' => new ReceiptIngridient(),
            'method' => 'POST',
            'ingridients' => MasterIngridient::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ReceiptIngridient::create([
            'receipt_id' => $request->receipt_id,
            'master_ingridient_id' => $request->ingridient_id,
        ]);

        return redirect()->route('receipt.ingridient.index', ['receipt_id' => $request->receipt_id])->with('success', 'Receipt Ingridient created successfully.');
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
    public function edit(ReceiptIngridient $receiptIngridient, Request $request)
    {
        return view('pages.receipt.ingridient.form', [
            'title' => 'Edit Receipt Ingridient',
            'url' => route('receipt.ingridient.update', [$receiptIngridient->id, 'receipt_id' => $request->receipt_id]),
            'form' => $receiptIngridient,
            'method' => 'PUT',
            'ingridients' => MasterIngridient::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReceiptIngridient $receiptIngridient)
    {
        $receiptIngridient->update([
            'receipt_id' => $request->receipt_id,
            'master_ingridient_id' => $request->ingridient_id,
        ]);

        return redirect()->route('receipt.ingridient.index', ['receipt_id' => $request->receipt_id])->with('success', 'Receipt Ingridient updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReceiptIngridient $receiptIngridient)
    {
        $receiptIngridient->delete();

        return redirect()->route('receipt.ingridient.index', ['receipt_id' => $receiptIngridient->receipt_id])->with('success', 'Receipt Ingridient deleted successfully.');
    }
}

<?php

use App\Http\Controllers\Receipt\ReceiptController;
use App\Http\Controllers\Receipt\ReceiptIngridientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('receipt.index');
});


Route::resource('category', App\Http\Controllers\Master\CategoryController::class)->except(['show']);
Route::resource('ingridient', App\Http\Controllers\Master\IngridientController::class)->except(['show']);
Route::resource('receipt', App\Http\Controllers\Receipt\ReceiptController::class)->except(['show']);
Route::prefix('receipt')->as('receipt.')->group(function () {
    Route::resource('/ingridient', App\Http\Controllers\Receipt\ReceiptIngridientController::class)->except(['show'])->parameters([
        'ingridient' => 'receiptIngridient',
    ]);
});

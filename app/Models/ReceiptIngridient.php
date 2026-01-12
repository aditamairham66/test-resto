<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiptIngridient extends Model
{
    protected $table = 'receipt_ingridient';

    protected $fillable = [
        'receipt_id',
        'master_ingridient_id',
    ];

    public function receipt()
    {
        return $this->belongsTo(Receipt::class, 'receipt_id');
    }

    public function ingridient()
    {
        return $this->belongsTo(MasterIngridient::class, 'master_ingridient_id');
    }
}

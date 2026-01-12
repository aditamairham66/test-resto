<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $table = 'receipt';

    protected $fillable = [
        'master_category_id',
        'name',
    ];

    public function category()
    {
        return $this->belongsTo(MasterCategory::class, 'master_category_id');
    }
}

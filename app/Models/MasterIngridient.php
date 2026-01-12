<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterIngridient extends Model
{
    protected $table = 'master_ingridient';

    protected $fillable = [
        'name',
    ];
}

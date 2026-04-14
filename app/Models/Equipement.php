<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    protected $table = 'equipements';
    protected $primaryKey = 'id_equipement';
    protected $guarded = [];

    protected $casts = [
        'date_expiration' => 'date',
    ];
}

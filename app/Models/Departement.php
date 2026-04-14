<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $table = 'departements';
    protected $guarded = [];

    /** The RH manager responsible for this department */
    public function responsable()
    {
        return $this->belongsTo(Utilisateur::class, 'responsable_id');
    }

    /** All employees in this department */
    public function employes()
    {
        return $this->hasMany(Utilisateur::class, 'departement_id');
    }
}

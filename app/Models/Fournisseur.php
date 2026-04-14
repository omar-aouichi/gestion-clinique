<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $table = 'fournisseurs';
    protected $guarded = [];

    /** All purchase orders placed with this supplier */
    public function commandes()
    {
        return $this->hasMany(Commande::class, 'fournisseur_id');
    }
}

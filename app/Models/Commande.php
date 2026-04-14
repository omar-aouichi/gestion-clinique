<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $table = 'commandes';
    protected $guarded = [];

    protected $casts = [
        'date_commande' => 'date',
        'date_livraison' => 'date',
    ];

    /** The supplier for this order */
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'fournisseur_id');
    }
}

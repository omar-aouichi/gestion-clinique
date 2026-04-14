<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $table = 'factures';
    protected $guarded = [];

    protected $casts = [
        'etat_paiement' => 'boolean',
        'date_emission' => 'date',
    ];

    /** The patient this invoice is for */
    public function patient()
    {
        return $this->belongsTo(Utilisateur::class, 'patient_id');
    }

    /** The secretary who issued this invoice */
    public function secretaire()
    {
        return $this->belongsTo(Utilisateur::class, 'secretaire_id');
    }
    /** Virtual attribute for UI consistency */
    public function getStateAttribute()
    {
        return (object) [
            'value' => $this->etat_paiement ? 'PAYEE' : 'IMPAYEE'
        ];
    }
}

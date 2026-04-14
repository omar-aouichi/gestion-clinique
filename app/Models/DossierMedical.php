<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DossierMedical extends Model
{
    protected $table = 'dossier_medicals';
    protected $guarded = [];

    protected $casts = [
        'actes' => 'array',
        'resultats_valides' => 'boolean',
    ];

    /** The patient this dossier belongs to */
    public function patient()
    {
        return $this->belongsTo(Utilisateur::class, 'patient_id');
    }

    /** All clinical interventions in this dossier */
    public function interventions()
    {
        return $this->hasMany(Intervention::class, 'dossier_id');
    }

    /** Virtual attribute to bridge DB statut with UI state->value */
    public function getStateAttribute()
    {
        return (object) ['value' => strtoupper($this->statut)];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    protected $table = 'interventions';
    protected $guarded = [];

    /** The medical record this intervention belongs to */
    public function dossier()
    {
        return $this->belongsTo(DossierMedical::class, 'dossier_id');
    }

    /** The doctor who performed this intervention */
    public function medecin()
    {
        return $this->belongsTo(Utilisateur::class, 'medecin_id');
    }

    /**
     * Nurses who assisted in this intervention (Many-to-Many via 'assiste' pivot).
     * This is the belongsToMany side of the UML <<assiste>> relationship.
     */
    public function infirmiers()
    {
        return $this->belongsToMany(
            Utilisateur::class,
            'assiste',
            'intervention_id',
            'infirmier_id'
        )->withTimestamps();
    }

    /** Virtual attribute to bridge DB statut with UI state->value */
    public function getStateAttribute()
    {
        return (object) ['value' => strtoupper($this->statut)];
    }
}

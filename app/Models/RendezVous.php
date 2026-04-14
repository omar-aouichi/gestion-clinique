<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    protected $table = 'rendez_vous';
    protected $guarded = [];

    protected $casts = [
        'date_heure' => 'datetime',
    ];

    /** The patient who booked this appointment */
    public function patient()
    {
        return $this->belongsTo(Utilisateur::class, 'patient_id');
    }

    /** The doctor for this appointment */
    public function medecin()
    {
        return $this->belongsTo(Utilisateur::class, 'medecin_id');
    }

    /** The nurse for this appointment */
    public function infirmier()
    {
        return $this->belongsTo(Utilisateur::class, 'infirmier_id');
    }
}

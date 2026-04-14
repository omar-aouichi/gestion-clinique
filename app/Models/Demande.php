<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    protected $table = 'demandes';
    protected $guarded = [];

    protected $casts = [
        'date' => 'date',
    ];

    /** The employee who submitted this request */
    public function employe()
    {
        return $this->belongsTo(Utilisateur::class, 'employe_id');
    }

    /** Notifications generated from this request */
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'demande_id');
    }
}

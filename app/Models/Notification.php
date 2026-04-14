<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $guarded = [];

    protected $casts = [
        'date_envoi' => 'datetime',
    ];

    /** The demand that triggered this notification */
    public function demande()
    {
        return $this->belongsTo(Demande::class, 'demande_id');
    }

    /** The user who receives this notification */
    public function destinataire()
    {
        return $this->belongsTo(Utilisateur::class, 'destinataire_id');
    }
}

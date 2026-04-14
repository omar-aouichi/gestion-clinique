<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogJournal extends Model
{
    protected $table = 'log_journals';
    protected $guarded = [];

    /** The user who triggered this log entry */
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'idUtilisateur');
    }
}

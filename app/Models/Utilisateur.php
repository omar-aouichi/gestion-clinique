<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Single Table Inheritance (STI) base model.
 * All actors live in the 'utilisateurs' table, differentiated by the 'role' column.
 */
class Utilisateur extends Authenticatable
{
    use Notifiable;

    protected $table = 'utilisateurs';
    protected $guarded = [];
    protected $hidden = ['mdp', 'remember_token'];

    protected $casts = [
        'role' => \App\Enums\UserRole::class,
    ];

    // ===================== LARAVEL AUTH OVERRIDES =====================

    /**
     * Laravel Auth expects a 'password' field by default.
     * We override this to point to our 'mdp' column.
     */
    public function getAuthPassword(): string
    {
        return $this->mdp;
    }

    /**
     * Override remember token methods to avoid column-not-found errors
     * if 'remember_token' column is missing from the table.
     */
    public function getRememberToken(): ?string { return null; }
    public function setRememberToken($value): void {}
    public function getRememberTokenName(): string { return 'remember_token'; }

    // ===================== RELATIONSHIPS =====================

    public function dossierMedical()
    {
        return $this->hasOne(DossierMedical::class, 'patient_id');
    }

    public function rendezVousPatient()
    {
        return $this->hasMany(RendezVous::class, 'patient_id');
    }

    public function rendezVousMedecin()
    {
        return $this->hasMany(RendezVous::class, 'medecin_id');
    }

    public function interventions()
    {
        return $this->hasMany(Intervention::class, 'medecin_id');
    }

    /**
     * A nurse belongs to many interventions via the 'assiste' pivot table.
     */
    public function interventionsAssistees()
    {
        return $this->belongsToMany(
            Intervention::class,
            'assiste',
            'infirmier_id',
            'intervention_id'
        )->withTimestamps();
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    public function demandes()
    {
        return $this->hasMany(Demande::class, 'employe_id');
    }

    public function factures()
    {
        return $this->hasMany(Facture::class, 'patient_id');
    }

    public function facturesEmises()
    {
        return $this->hasMany(Facture::class, 'secretaire_id');
    }

    public function logs()
    {
        return $this->hasMany(LogJournal::class, 'idUtilisateur');
    }

    public function notificationsRecues()
    {
        return $this->hasMany(Notification::class, 'destinataire_id');
    }

    // ===================== ROLE-BASED SCOPES =====================

    public function scopePatients($query)  { return $query->where('role', 'patient'); }
    public function scopeMedecins($query)  { return $query->where('role', 'medecin'); }
    public function scopeInfirmiers($query){ return $query->where('role', 'infirmier'); }

    // ===================== HELPERS =====================

    public function getFullNameAttribute(): string
    {
        return trim($this->prenom . ' ' . $this->nom);
    }

    public function isAdmin(): bool              { return $this->role === 'admin'; }
    public function isMedecin(): bool            { return $this->role === 'medecin'; }
    public function isInfirmier(): bool          { return $this->role === 'infirmier'; }
    public function isSecretaire(): bool         { return $this->role === 'secretaire'; }
    public function isPatient(): bool            { return $this->role === 'patient'; }
    public function isRH(): bool                 { return $this->role === 'rh'; }
    public function isGerantStock(): bool        { return $this->role === 'gerant_stock'; }
    public function isCadre(): bool              { return $this->role === 'cadre_administratif'; }
    public function isDG(): bool                 { return $this->role === 'dg'; }
}

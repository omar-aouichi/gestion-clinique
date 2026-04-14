<?php

use Illuminate\Support\Facades\Route;

// =====================================================================
// PUBLIC ROUTES (No authentication required)
// =====================================================================

Route::get('/', function () {
    return view('index');
});

// Authentication
Route::get('/login',  [\App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout',[\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// =====================================================================
// PROTECTED ROUTES (Require login)
// =====================================================================

Route::middleware(['auth'])->group(function () {

    // ----------------------------------------------------------------
    // Secretary Portal
    // ----------------------------------------------------------------
    Route::prefix('secretary')->name('secretary.')->group(function () {
        Route::get('/',              function() { return redirect()->route('secretary.appointments'); });
        Route::get('/patients',       [\App\Http\Controllers\Secretary\SecretaryController::class, 'patients'])->name('patients');
        Route::get('/create-patient', [\App\Http\Controllers\Secretary\SecretaryController::class, 'create'])->name('create-patient');
        Route::post('/create-patient', [\App\Http\Controllers\Secretary\SecretaryController::class, 'store'])->name('store-patient');
        Route::post('/create-patient-urgence', [\App\Http\Controllers\Secretary\SecretaryController::class, 'storeUrgence'])->name('store-urgence');
        Route::get('/facturation',    [\App\Http\Controllers\Secretary\SecretaryController::class, 'facturation'])->name('facturation');
        Route::post('/facturation',   [\App\Http\Controllers\Secretary\SecretaryController::class, 'storeFacture'])->name('store-facture');
        Route::get('/appointments',   [\App\Http\Controllers\Secretary\SecretaryController::class, 'appointments'])->name('appointments');
        
        Route::put('/patients/{id}',    [\App\Http\Controllers\Secretary\SecretaryController::class, 'updatePatient'])->name('update-patient');
        Route::patch('/appointments/{id}/status', [\App\Http\Controllers\Secretary\SecretaryController::class, 'updateAppointmentStatus'])->name('update-appointment-status');
        Route::post('/factures/{id}/recu', [\App\Http\Controllers\Secretary\SecretaryController::class, 'emettreRecu'])->name('emettre-recu');
        Route::get('/patients/{id}/dossier', [\App\Http\Controllers\PatientModuleController::class, 'consulterDossier'])->name('view-dossier');
        Route::post('/annuler-rdv/{id}', [\App\Http\Controllers\Admin\SecretaireController::class, 'annulerRdv'])->name('annuler-rdv');
        Route::post('/suspendre-patient/{id}', [\App\Http\Controllers\Admin\SecretaireController::class, 'suspendrePatient'])->name('suspendre-patient');
        Route::post('/factures/{id}/annuler', [\App\Http\Controllers\Admin\SecretaireController::class, 'annulerFacture'])->name('annuler-facture');
        Route::post('/patient-sous-x', [\App\Http\Controllers\Admin\SecretaireController::class, 'creerPatientSousX'])->name('sous-x');
        Route::post('/factures/{id}/encaisser', [\App\Http\Controllers\Secretary\SecretaryController::class, 'encaisser'])->name('encaisser');
        Route::post('/appointments/book', [\App\Http\Controllers\Secretary\SecretaryController::class, 'bookAppointment'])->name('book-appointment');
    });

    // ----------------------------------------------------------------
    // Patient Portal
    // ----------------------------------------------------------------
    Route::prefix('patient')->name('patient.')->group(function () {
        Route::get('/dashboard',         [\App\Http\Controllers\PatientModuleController::class, 'patientDashboard'])->name('dashboard');
        Route::post('/annuler-rdv/{id}', [\App\Http\Controllers\PatientModuleController::class, 'annulerRdv'])->name('annuler-rdv');
        Route::post('/payer-facture/{id}',[\App\Http\Controllers\PatientModuleController::class, 'payerFacture'])->name('payer-facture');
    });

    // ----------------------------------------------------------------
    // Médecin Portal
    // ----------------------------------------------------------------
    Route::prefix('medecin')->name('medecin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\PatientModuleController::class, 'medecinDashboard'])->name('dashboard');
        Route::get('/dossier/{patientId}', [\App\Http\Controllers\PatientModuleController::class, 'consulterDossier'])->name('dossier');
        Route::post('/intervention/{id}/demarrer', [\App\Http\Controllers\PatientModuleController::class, 'demarrerIntervention'])->name('demarrer-intervention');
        Route::post('/intervention/{id}/cloturer', [\App\Http\Controllers\PatientModuleController::class, 'cloturerIntervention'])->name('cloturer-intervention');
        Route::post('/intervention/{id}/compte-rendu', [\App\Http\Controllers\PatientModuleController::class, 'sauvegarderCompteRendu'])->name('compte-rendu');
        Route::post('/dossier/{dossierId}/acte', [\App\Http\Controllers\PatientModuleController::class, 'ajouterActe'])->name('ajouter-acte');
        Route::post('/dossier/{dossierId}/valider', [\App\Http\Controllers\PatientModuleController::class, 'validerResultats'])->name('valider-resultats');
        Route::post('/dossier/{dossierId}/archive', [\App\Http\Controllers\PatientModuleController::class, 'archiveDossier'])->name('archive');
    });

    // ----------------------------------------------------------------
    // Infirmier Portal
    // ----------------------------------------------------------------
    Route::prefix('infirmier')->name('infirmier.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\PatientModuleController::class, 'infirmierDashboard'])->name('dashboard');
        Route::post('/intervention/{id}/assister', [\App\Http\Controllers\PatientModuleController::class, 'assisterIntervention'])->name('assister');
        Route::post('/dossier/{dossierId}/vitals', [\App\Http\Controllers\PatientModuleController::class, 'mettreAJourDossier'])->name('vitals');
    });

    // ----------------------------------------------------------------
    // HR / Employe / RH / Cadre / DG Portals
    // ----------------------------------------------------------------
    Route::prefix('employe')->name('employe.')->group(function () {
        Route::get('/', function() { return redirect()->route('employe.dashboard'); });
        Route::get('/dashboard',      [\App\Http\Controllers\HRModuleController::class, 'employeDashboard'])->name('dashboard');
        Route::post('/pointer',       [\App\Http\Controllers\HRModuleController::class, 'pointer'])->name('pointer');
        Route::post('/deposer-demande',[\App\Http\Controllers\HRModuleController::class, 'deposerDemande'])->name('deposer-demande');
    });

    Route::prefix('rh')->name('rh.')->group(function () {
        Route::get('/', function() { return redirect()->route('rh.dashboard'); });
        Route::get('/dashboard',             [\App\Http\Controllers\HRModuleController::class, 'rhDashboard'])->name('dashboard');
        Route::put('/employes/{id}',         [\App\Http\Controllers\HRModuleController::class, 'modifierEmploye'])->name('modifier-employe');
        Route::post('/departements/affecter',[\App\Http\Controllers\HRModuleController::class, 'affecter'])->name('affecter');
        Route::post('/departements/retirer', [\App\Http\Controllers\HRModuleController::class, 'retirer'])->name('retirer');
        Route::delete('/employes/{id}',      [\App\Http\Controllers\HRModuleController::class, 'destroy'])->name('destroy');
        Route::post('/departements',         [\App\Http\Controllers\HRModuleController::class, 'storeDepartement'])->name('ajouter-departement');
        Route::delete('/departements/{id}',  [\App\Http\Controllers\HRModuleController::class, 'destroyDepartement'])->name('supprimer-departement');
    });

    Route::prefix('cadre')->name('cadre.')->group(function () {
        Route::get('/', function() { return redirect()->route('cadre.dashboard'); });
        Route::get('/dashboard',          [\App\Http\Controllers\HRModuleController::class, 'cadreDashboard'])->name('dashboard');
        Route::post('/soumettre-demande', [\App\Http\Controllers\HRModuleController::class, 'soumettreDemande'])->name('soumettre');
    });

    Route::prefix('dg')->name('dg.')->group(function () {
        Route::get('/', function() { return redirect()->route('dg.dashboard'); });
        Route::get('/dashboard',                  [\App\Http\Controllers\HRModuleController::class, 'dgDashboard'])->name('dashboard');
        Route::post('/demande/{id}/valider',      [\App\Http\Controllers\HRModuleController::class, 'validerDemande'])->name('valider-demande');
        Route::post('/cadres',                    [\App\Http\Controllers\HRModuleController::class, 'ajouterCadre'])->name('ajouter-cadre');
        Route::delete('/cadres/{id}',             [\App\Http\Controllers\HRModuleController::class, 'retirerCadre'])->name('retirer-cadre');
        Route::put('/cadres/{id}/statut',         [\App\Http\Controllers\HRModuleController::class, 'modifierStatutCadre'])->name('modifier-statut-cadre');
    });

    // ----------------------------------------------------------------
    // Stock Portals
    // ----------------------------------------------------------------
    Route::prefix('stock')->group(function () {
        Route::get('/', function() { return redirect()->route('stock.dashboard'); });
        Route::get('/consulter',  [\App\Http\Controllers\Stock\GerantStockController::class, 'index'])->name('stock.dashboard');
        Route::get('/mouvement', [\App\Http\Controllers\Stock\GerantStockController::class, 'createMouvement'])->name('stock.mouvement');
        Route::post('/mouvement', [\App\Http\Controllers\Stock\GerantStockController::class, 'storeMouvement'])->name('stock.mouvement.store');
        Route::post('/equipement', [\App\Http\Controllers\Stock\GerantStockController::class, 'storeEquipement'])->name('stock.equipement.store');
        Route::delete('/equipement/{id}', [\App\Http\Controllers\Stock\GerantStockController::class, 'destroyEquipement'])->name('stock.equipement.destroy');
        Route::post('/signaler/{id}', function ($id) {
            $eq = \App\Models\Equipement::where('id_equipement', $id)->first();
            if ($eq) {
                app(\App\Services\StockService::class)->signaler_administratif($id, $eq->nom);
                return back()->with('success', "Alerte envoyée pour [{$eq->nom}].");
            }
            return back()->with('error', 'Équipement non trouvé.');
        })->name('stock.signaler_administratif');

        Route::prefix('administratif')->group(function () {
            Route::get('/dashboard', [\App\Http\Controllers\Stock\AdministratifStockController::class, 'dashboard'])->name('stock.administratif.dashboard');
            Route::post('/contact-fournisseur', [\App\Http\Controllers\Stock\AdministratifStockController::class, 'contactFournisseur'])->name('stock.administratif.contact');
            Route::post('/valider-commande/{id}', [\App\Http\Controllers\Stock\AdministratifStockController::class, 'validerCommande'])->name('stock.administratif.valider');
            Route::post('/effectuer-paiement/{id}', [\App\Http\Controllers\Stock\AdministratifStockController::class, 'effectuerPaiement'])->name('stock.administratif.payer');
            Route::post('/commande', [\App\Http\Controllers\Stock\AdministratifStockController::class, 'effectuerCommande'])->name('stock.administratif.commander');
            Route::post('/commande/{id}/livrer', [\App\Http\Controllers\Stock\AdministratifStockController::class, 'marquerLivre'])->name('stock.administratif.livrer');
            Route::post('/commande/{id}/paiement-montant', [\App\Http\Controllers\Stock\AdministratifStockController::class, 'envoyerMontant'])->name('stock.administratif.envoyer_montant');
            Route::post('/commande/{id}/facture', [\App\Http\Controllers\Stock\AdministratifStockController::class, 'envoyerFacture'])->name('stock.administratif.facturer');
        });
    });

    // ----------------------------------------------------------------
    // Admin Technique Portal
    // ----------------------------------------------------------------
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/users',              [\App\Http\Controllers\AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create',       [\App\Http\Controllers\AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users',             [\App\Http\Controllers\AdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit',    [\App\Http\Controllers\AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}',         [\App\Http\Controllers\AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}',      [\App\Http\Controllers\AdminUserController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/{id}/reset-password', [\App\Http\Controllers\AdminUserController::class, 'resetPassword'])->name('users.reset-password');
        Route::get('/logs',               [\App\Http\Controllers\AdminUserController::class, 'logs'])->name('logs.index');
        Route::post('/backup',            [\App\Http\Controllers\AdminUserController::class, 'backup'])->name('backup.run');
    });

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit', fn() => view('profile.edit'))->name('edit');
    });

    // Notifications
    Route::post('/notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all',  [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');

}); // end auth middleware

<?php
namespace App\Repositories\Mock;
use App\DTOs\RendezVousDTO;
use App\Enums\RendezVousState;
use App\Repositories\Interfaces\RendezVousRepositoryInterface;
use Illuminate\Support\Collection;
class MockRendezVousRepository implements RendezVousRepositoryInterface {
    private static ?Collection $rdvs = null;
    public function __construct() {
        if (self::$rdvs === null) {
            self::$rdvs = collect([
                new RendezVousDTO(1, 1, 'Aouichi Omar', 'D001', 'Dr. House', '2026-04-15', '10:00', RendezVousState::CONFIRME),
                new RendezVousDTO(2, 2, 'Benzema Karim', 'D002', 'Dr. Grey', '2026-04-16', '14:30', RendezVousState::EN_ATTENTE),
            ]);
        }
    }
    public function getAll(): Collection { return self::$rdvs; }
    public function findById(int $id) { return self::$rdvs->first(fn($r) => $r->id === $id); }
    public function findByPatient(int $patientId): Collection { return self::$rdvs->filter(fn($r) => $r->patient_id === $patientId); }
    public function create(array $data) {
        $id = self::$rdvs->max('id') + 1;
        $rdv = new RendezVousDTO($id, $data['patientId'], $data['patientNom'], $data['medecinId'], $data['medecinNom'], $data['dateHeader'], $data['heure'], $data['state'] ?? RendezVousState::EN_ATTENTE);
        self::$rdvs->push($rdv);
        return $rdv;
    }
    public function updateState(int $id, RendezVousState $state) {
        $r = $this->findById($id);
        if ($r) { $r->state = $state; return true; }
        return false;
    }
    public function checkConflict(string $date, string $heure, string $medecinId) {
        return self::$rdvs->contains(fn($r) => $r->date_header === $date && $r->heure === $heure && $r->medecin_id === $medecinId && $r->state !== RendezVousState::ANNULE);
    }
}

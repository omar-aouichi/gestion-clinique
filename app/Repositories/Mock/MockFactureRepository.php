<?php
namespace App\Repositories\Mock;
use App\DTOs\FactureDTO;
use App\Enums\FactureState;
use App\Repositories\Interfaces\FactureRepositoryInterface;
use Illuminate\Support\Collection;
class MockFactureRepository implements FactureRepositoryInterface {
    private static ?Collection $factures = null;
    public function __construct() {
        if (self::$factures === null) {
            self::$factures = collect([
                new FactureDTO(1, 1, 'Aouichi Omar', 150.00, ['Consultation Générale', 'Analyse Sang'], '2026-04-12', FactureState::EMISE),
                new FactureDTO(2, 2, 'Benzema Karim', 80.00, ['Consultation Spécialisée'], '2026-04-13', FactureState::IMPAYEE),
            ]);
        }
    }
    public function getAll(): Collection { return self::$factures; }
    public function findById(int $id) { return self::$factures->first(fn($f) => $f->id === $id); }
    public function findByPatient(int $patientId): Collection { return self::$factures->filter(fn($f) => $f->patient_id === $patientId); }
    public function create(array $data) {
        $id = self::$factures->max('id') + 1;
        $f = new FactureDTO($id, $data['patientId'], $data['patientNom'], $data['montantTotal'], $data['actes'], $data['dateEmission'], $data['state'] ?? FactureState::EMISE);
        self::$factures->push($f);
        return $f;
    }
    public function updateState(int $id, FactureState $state) {
        $f = $this->findById($id);
        if ($f) { $f->state = $state; return true; }
        return false;
    }
}

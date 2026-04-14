<?php

namespace App\Repositories\Mock;

use App\DTOs\LogDTO;
use App\Repositories\Interfaces\LogRepositoryInterface;
use Illuminate\Support\Collection;

class MockLogRepository implements LogRepositoryInterface
{
    private static ?Collection $logs = null;

    public function __construct()
    {
        if (self::$logs === null) {
            self::$logs = collect([
                new LogDTO(1, '2026-04-13 08:00:00', 'Initialisation du système', 1, 'Admin Technique'),
            ]);
        }
    }

    public function getAll(): Collection
    {
        return self::$logs;
    }

    public function create(array $data)
    {
        $id = self::$logs->count() > 0 ? self::$logs->max('id') + 1 : 1;
        $log = new LogDTO(
            $id,
            now()->toDateTimeString(),
            $data['action'],
            $data['user_id'],
            $data['user_name'] ?? 'Utilisateur'
        );
        self::$logs->prepend($log); // Newest first
        return $log;
    }
}

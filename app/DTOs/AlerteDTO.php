<?php

namespace App\DTOs;

class AlerteDTO
{
    public function __construct(
        public int $id,
        public string $message,
        public int $equipement_id,
        public string $status // pending/resolved
    ) {}
}

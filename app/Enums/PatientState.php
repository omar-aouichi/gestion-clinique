<?php

namespace App\Enums;

enum PatientState: string
{
    case ACTIF = 'ACTIF';
    case ARCHIVE = 'ARCHIVE';
    case SUSPENDU = 'SUSPENDU';
}

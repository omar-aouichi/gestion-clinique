<?php

namespace App\Enums;

enum InterventionState: string
{
    case PLANIFIEE = 'PLANIFIEE';
    case EN_COURS = 'EN_COURS';
    case TERMINEE = 'TERMINEE';
}

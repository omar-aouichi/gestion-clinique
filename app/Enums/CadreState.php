<?php

namespace App\Enums;

enum CadreState: string
{
    case HORS_LIGNE = 'HORS_LIGNE';
    case AUTHENTIFIE = 'AUTHENTIFIE';
    case PRIVILEGES_MIS_A_JOUR = 'PRIVILEGES_MIS_A_JOUR';
}

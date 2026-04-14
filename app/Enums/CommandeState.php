<?php

namespace App\Enums;

enum CommandeState: string
{
    case CREE = 'CREE';
    case EN_ATTENTE = 'EN_ATTENTE';
    case VALIDE = 'VALIDE';
    case ANNULE = 'ANNULE';
    case LIVRE = 'LIVRE';
}

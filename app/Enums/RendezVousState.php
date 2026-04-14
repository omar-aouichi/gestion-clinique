<?php

namespace App\Enums;

enum RendezVousState: string
{
    case PLANIFIE = 'PLANIFIE';
    case CONFIRME = 'CONFIRME';
    case EN_ATTENTE = 'EN_ATTENTE';
    case ANNULE = 'ANNULE';
    case TERMINE = 'TERMINE';
}

<?php

namespace App\Enums;

enum DemandeState: string
{
    case NOUVELLE = 'NOUVELLE';
    case ANALYSEE = 'ANALYSEE';
    case APPROUVEE = 'APPROUVEE';
    case REFUSEE = 'REFUSEE';
    case A_REVISER = 'A_REVISER';
}

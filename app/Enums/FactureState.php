<?php

namespace App\Enums;

enum FactureState: string
{
    case EMISE = 'EMISE';
    case IMPAYEE = 'IMPAYEE';
    case ANNULEE = 'ANNULEE';
    case PAYEE = 'PAYEE';
}

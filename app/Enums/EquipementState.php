<?php

namespace App\Enums;

enum EquipementState: string
{
    case VALIDE = 'VALIDE';
    case EXPIRE = 'EXPIRE';
    case RETIRE = 'RETIRE';
}

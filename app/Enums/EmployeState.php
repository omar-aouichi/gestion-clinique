<?php

namespace App\Enums;

enum EmployeState: string
{
    case EN_COURS_DE_RECRUTEMENT = 'EN_COURS_DE_RECRUTEMENT';
    case ACTIF = 'ACTIF';
    case EN_CONGE = 'EN_CONGE';
    case DEMISSIONNAIRE = 'DEMISSIONNAIRE';
    case SORTI_DU_SYSTEME = 'SORTI_DU_SYSTEME';
}

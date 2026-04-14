<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case SECRETAIRE = 'secretaire';
    case MEDECIN = 'medecin';
    case INFIRMIER = 'infirmier';
    case RH = 'rh';
    case GERANT_STOCK = 'gerant_stock';
    case CADRE_ADMINISTRATIF = 'cadre_administratif';
    case DG = 'dg';
    case PATIENT = 'patient';
}

<?php

namespace App\Enums;

enum VaccinationStatus: int
{
    case NOT_VACCINATED = 1;
    case SCHEDULED = 2;
    case VACCINATED = 3;
}

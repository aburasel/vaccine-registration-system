<?php

namespace App\Services;

use App\Models\Patient;

class PatientRegistrationService
{
    public function register(array $data): Patient
    {
        return Patient::create($data);
    }
}

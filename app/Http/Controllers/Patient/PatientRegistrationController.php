<?php

namespace App\Http\Controllers\Patient;

use App\Enums\ActiveStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRegisterRequest;
use App\Models\Patient;
use App\Models\VaccineCenter;

class PatientRegistrationController extends Controller
{
    /**
     * registration
     */
    public function create()
    {
        $vaccineCenters = VaccineCenter::where(['active' => ActiveStatus::ACTIVE])->get();

        return view('patient.register', ['vaccineCenters' => $vaccineCenters]);
    }

    public function store(PatientRegisterRequest $request)
    {
        $validated = $request->validated();
        $patient = Patient::create($validated);
        
        if ($patient) {
            return redirect()->back()->with('success', 'Your have been registered successfully!');
        } else {
            return redirect()->back()->with('error', 'There was a failure while registering!');
        }

    }
}

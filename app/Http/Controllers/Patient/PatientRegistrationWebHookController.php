<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\VaccineCenter;
use App\Services\PatientRegistrationService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PatientRegistrationWebHookController extends Controller
{
    use ResponseAPI;

    public function register(Request $request, PatientRegistrationService $patientRegistrationService)
    {
        $inputJson = $request->getContent();
        $inputArray = json_decode($inputJson, true);
        $validator = Validator::make($inputArray, [
            'name' => ['required', 'string', 'max:255'],
            'nid' => ['required', 'string', 'max:28', 'min:10', 'unique:'.Patient::class],
            'phone' => ['required', 'string', 'max:28', 'min:11', 'unique:'.Patient::class],
            'vaccine_center' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:56', 'unique:'.Patient::class],
        ]);

        if ($validator->fails()) {
            $message = implode(' ', $validator->errors()->all());

            return $this->error($message, Response::HTTP_PRECONDITION_FAILED);
        }

        $validated = $validator->validated();

        $center = VaccineCenter::where(['name' => $validated['vaccine_center']])->first();

        $vaccineCenterId = $center['id'];

        $validated['vaccine_center_id'] = $vaccineCenterId;

        $patient = $patientRegistrationService->register($validated);

        if ($patient) {
            return $this->success('Successful', [], Response::HTTP_OK);
        } else {
            return $this->error('Error', [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        //Storage::disk('local')->put('hook-data.txt', $inputJson);
    }
}

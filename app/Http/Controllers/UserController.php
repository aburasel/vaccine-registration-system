<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show all application users.
     */
    public function index(): View
    {
        $patients = DB::table('patients as P')
            ->join('vaccine_centers as V', 'vaccine_center_id', '=', 'V.id')
            ->select('P.id', 'P.name', 'p.email', 'P.vaccination_status', 'V.name as center')
            ->orderBy('P.vaccine_center_id')
            ->orderBy('P.vaccination_status')
            ->paginate(50);

        return view('dashboard', [
            'patients' => $patients,
        ]);
    }
}
//php artisan queue:work
//php artisan schedule:run

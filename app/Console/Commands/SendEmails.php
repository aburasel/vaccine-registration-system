<?php

namespace App\Console\Commands;

use App\Enums\ActiveStatus;
use App\Enums\VaccinationStatus;
use App\Models\Patient;
use App\Models\VaccineCenter;
use App\Notifications\VaccineScheduled;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email at everyday 9 PM [Weekends excluded]';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $centers = VaccineCenter::where(['active' => ActiveStatus::ACTIVE])->get();

        foreach ($centers as $center) {
            $patients = Patient::where(
                [
                    'vaccine_center_id' => $center->id,
                    'vaccination_status' => VaccinationStatus::NOT_VACCINATED,
                ]
            )
                ->orderBy('created_at')
                ->get();

            if ($patients) {
                Patient::whereIn('id', $patients->pluck('id'))->update(['vaccination_status' => VaccinationStatus::SCHEDULED]);
                Notification::send($patients, new VaccineScheduled($center));
            }

        }

    }
}

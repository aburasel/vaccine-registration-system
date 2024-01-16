<?php

namespace App\Notifications;

use App\MyApp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class VaccineScheduled extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $vaccinationCenter;

    public function __construct($vaccinationCenter)
    {
        $this->vaccinationCenter = $vaccinationCenter;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Vaccine Scheduled')
            ->greeting('Assalamu-alaikum,')
            ->line('Mr/Ms '.$notifiable->name)
            ->line('Your vaccine scheduled at- ')
            ->line(new HtmlString('<b>'.MyApp::vaccinationTime.'</b>'))
            ->line('Vaccination center : '.$this->vaccinationCenter->name.'!')
            ->line('Please be present at the center in time')
            ->line('Thank you');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function failed(\Exception $exception)
    {
        \Illuminate\Support\Facades\Log::debug('Vaccination email failed'.$exception->getMessage());
    }
}

<?php

namespace App\Notifications;

use App\Models\Car;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CarLikedNotification extends Notification
{
    use Queueable;

    public $car;

    public $user;

    public $action; // added or removed

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Car $car, User $user, string $action)
    {
        $this->car = $car;
        $this->user = $user;
        $this->action = $action;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = $this->user->name.' '.$this->action.' your car '.$this->car->make.' '.$this->car->model;

        return (new MailMessage)
            ->line($message)
            ->action('View Car', url('/cars/'.$this->car->id));
    }
}

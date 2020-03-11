<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewCertificate extends Notification implements ShouldQueue
{
    use Queueable;
    protected $completed;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($completed)
    {
        $this->completed = $completed;
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
        return (new MailMessage)->greeting('Добрый день!')->subject('Новый успешно пройденный итоговый тест')
            ->line('Пользователь '.$this->completed->user->name.' успешно прошел итоговый тест по курсу "'.$this->completed->name.'" к платформе Oncorehab Study.')
            ->action('Список заявок на свидетельство', url("/insider/certificates/"));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

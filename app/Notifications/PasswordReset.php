<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordReset extends Notification
{
    use Queueable;
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('simasjid.ibnusina@gmail.com', 'SI Masjid Ibnu Sina')
            ->line('Anda mendapatkan pesan ini karena kami menerima permintaan reset password untuk akun Anda.') // Here are the lines you can safely override
            ->action('Reset Password', url('password/reset', $this->token))
            ->line('Jika Anda tidak melakukan permintaan reset password, silakan abaikan pesan ini.');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

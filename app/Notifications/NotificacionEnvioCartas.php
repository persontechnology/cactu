<?php

namespace cactu\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificacionEnvioCartas extends Notification
{
    use Queueable;
    protected $buzon;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($buzon_m)
    {
        $this->buzon=$buzon_m;
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
        return (new MailMessage)
                    ->subject('NOTIFICACIÓN DE CARTAS')
                    ->line('CACTU piensa en ti y te ayuda a recibir tus carta de tu patrocinador!')
                    ->line('Estimadx Niñx '.$this->buzon->ninio->nombres. ' Ingresa al link tienes cartas que revisar' )
                    ->action('Ingresar a mi buzón de mensajes ', route('entrada',$this->buzon->ninio->token ))
                    ->line('Gracias por tu atención!');
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

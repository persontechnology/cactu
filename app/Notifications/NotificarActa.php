<?php

namespace cactu\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificarActa extends Notification
{
    use Queueable;
    protected $acta;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($acta_m)
    {
        $this->acta=$acta_m;
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
        $fecha=Carbon::now();
        return (new MailMessage)
                    ->subject('NUEVA ACTA ENTREGA RECEPCIÓN')
                    ->line('En la cuidad de '.$this->acta->comunidadActa->comunidad->canton->nombre. ' con la fecha '. $fecha. ', se realiza la entraga de una  NUEVA ACTA ENTREGA RECEPCIÓN MATERIALES al Srx '
                    .$this->acta->comunidadActa->comunidad->usuario->name .' Gestor de la comunidad '.$this->acta->comunidadActa->comunidad->nombre. ', para el uso de '. $this->acta->poaCuentaContableMes->cuentaContablePoaCuenta->poaContable->poa->actividad->nombre.$this->acta->poaCuentaContableMes->cuentaContablePoaCuenta->poaContable->poa->actividad->modeloProgramatico->codigo
                    .$this->acta->poaCuentaContableMes->cuentaContablePoaCuenta->poaContable->poa->actividad->codigo.', para el mes de '.$this->acta->poaCuentaContableMes->mes->mes)
                    ->action('Ver Más', route('mi-actas',$this->acta->id))
                    ->line('Gracias por su Atensión!');
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

<?php

namespace Wolosky\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Wolosky\User;

class ResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->view('emails.resetPassword',[
            
            'data'=> $this->data, 
            ])            
            ->to($this->data['user']->email, $this->data['user']->name)
                ->subject('Recupera tu contraseña de tu cuenta - Wolosky Administracion')
                ->from('contacto@woloskygimnasia.com', 'Wolosky Administracion');
    }
}

<?php

namespace Wolosky\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
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
        return $this->view('emails.contactMail',[
            'text'=> $this->data->message, 
            'client' => $this->data->name, 
            'mail' => $this->data->email
            ])            
            ->to('woloskyrebe@gmail.com', 'GIMNASIO WOLOSKY')
                ->subject('Nuevo Contaco || WoloskyGimnasia.com')
                ->from($this->data->email, $this->data->name);
    }
}

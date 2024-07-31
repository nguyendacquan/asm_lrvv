<?php

namespace App\Mail;

use App\Models\lien_he;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public $lienHe;
    public $images;
    public function __construct($lienHe, $images)
    {
        $this->lienHe = $lienHe;
        $this->images = $images;
    }



    public function build()
    {
        $email = $this->view('clients.contact.mail')
            ->with('lienHe', $this->lienHe)
            ->subject('Liên hệ từ website');
        if ($this->images) {
            $email->attach(storage_path('app/public/'. $this->images));
        }

        return $email;
    }
}

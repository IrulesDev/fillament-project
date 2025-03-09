<?php

namespace App\Mail;

use App\Models\RapotSantri;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RapotMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rapotData; 


    /**
     * Create a new message instance.
     */
    public function __construct($rapotData)
    {
        $rapotData = RapotSantri::all()  ;

        return $rapotData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'RapotMail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.rapot',
            
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
{
    return $this->subject('Laporan Rapot Siswa')
                ->markdown('emails.rapot')
                ->with(['rapotData' => $this->rapotData]);
}
}

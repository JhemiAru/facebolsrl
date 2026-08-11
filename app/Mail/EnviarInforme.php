<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class EnviarInforme extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;
    public $nombre;
    public $rutaPdf;
    public $nombreArchivo;

    /**
     * Create a new message instance.
     */
    public function __construct($datos, $nombre, $rutaPdf, $nombreArchivo)
    {
        $this->datos = $datos;
        $this->nombre = $nombre;
        $this->rutaPdf = $rutaPdf;
        $this->nombreArchivo = $nombreArchivo;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address(
                config('mail.from.address'),
                'FACEBOL SRL'
            ),
            subject: $this->datos['asunto'],
            replyTo: [
                new \Illuminate\Mail\Mailables\Address(
                    $this->datos['remitente'],
                    $this->nombre
                ),
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.enviar-informe',
            with: [
                'contenido' => $this->datos['contenido'],
            ],
        );
    }

    /**
     * Build the message with additional headers.
     */
    public function build()
    {
        return $this->withSwiftMessage(function ($message) {
            $headers = $message->getHeaders();

            // Headers para evitar que sea marcado como spam
            $headers->addTextHeader('X-Entity-Ref-ID', uniqid('facebol-informe-', true));
            $headers->addTextHeader('X-Mailer', 'FACEBOL System v1.0');
            $headers->addTextHeader('X-Priority', '3');
            $headers->addTextHeader('Importance', 'Normal');
        });
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->rutaPdf)
                ->as($this->nombreArchivo)
                ->withMime('application/pdf'),
        ];
    }
}

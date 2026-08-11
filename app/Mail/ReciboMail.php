<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class ReciboMail extends Mailable
{
  use Queueable, SerializesModels;

  public $factura;
  public $pdfPath;
  public $mensajeExtra;
  public $numeroRecibo;

  /**
   * Create a new message instance.
   */
  public function __construct($factura, $pdfPath, $mensajeExtra = '', $numeroRecibo = 'N/A')
  {
    $this->factura = $factura;
    $this->pdfPath = $pdfPath;
    $this->mensajeExtra = $mensajeExtra;
    $this->numeroRecibo = $numeroRecibo;
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    $clienteNombre = $this->factura->informacion
      ? $this->factura->informacion->nombre . ' ' . ($this->factura->informacion->apellido_paterno ?? '')
      : 'Cliente';

    return new Envelope(
      subject: '[FACEBOL] Recibo de Pago N° ' . $this->numeroRecibo . ' - ' . date('d/m/Y'),
      from: new \Illuminate\Mail\Mailables\Address(
        config('mail.from.address'),
        'FACEBOL SRL'
      ),
      replyTo: [
        new \Illuminate\Mail\Mailables\Address(
          config('mail.from.address'),
          'FACEBOL SRL'
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
      view: 'emails.recibo',
      text: 'emails.recibo-text',
      with: [
        'factura' => $this->factura,
        'mensajeExtra' => $this->mensajeExtra,
        'numeroRecibo' => $this->numeroRecibo,
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

      // Headers para evitar spam
      $headers->addTextHeader('X-Entity-Ref-ID', uniqid('facebol-recibo-', true));
      $headers->addTextHeader('X-Mailer', 'FACEBOL System v1.0');
      $headers->addTextHeader('X-Priority', '3'); // Normal priority
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
    if (file_exists($this->pdfPath)) {
      return [
        Attachment::fromPath($this->pdfPath)
          ->as('Recibo_' . $this->numeroRecibo . '_' . date('Y-m-d') . '.pdf')
          ->withMime('application/pdf'),
      ];
    }

    return [];
  }
}

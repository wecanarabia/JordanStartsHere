<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use MailerSend\Helpers\Builder\Variable;
use MailerSend\Helpers\Builder\Personalization;
use MailerSend\LaravelDriver\MailerSendTrait;

class SendMail extends Mailable
{
    use Queueable, SerializesModels,MailerSendTrait;

    public $otp;
    /**
     * Create a new message instance.
     */
    public function __construct($otp)
    {
        $this->otp=$otp;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'OTP Verification',
    //         from: 'joradanstarts@joradanstartshere.com',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'email',
    //         with: [
    //             'otp' => $this->otp,
    //         ],
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }

    public function build()
    {
        $to = Arr::get($this->to, '0.address');

        return $this->view('email')
            ->mailersend(
                null,
                [
                    new Variable($to, ['name' => 'Jordan Starts Here'])
                ],
                ['tag'],
                [
                    new Personalization($to, [
                        'var' => 'variable',
                        'number' => 123,
                        'object' => [
                            'key' => 'object-value'
                        ],
                        'objectCollection' => [
                            [
                                'name' => 'MailerSend'
                            ],
                            [
                                'name' => 'Guru'
                            ]
                        ],
                    ])
                ]
            );
    }
}


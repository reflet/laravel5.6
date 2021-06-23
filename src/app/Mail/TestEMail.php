<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestEMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * メッセージ本文
     *
     * @var string
     */
    protected $body;

    /**
     * Create a new message instance.
     *
     * @param  string $body
     * @return void
     */
    public function __construct(string $body)
    {
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): TestEMail
    {
        return $this
            ->from('hoge@example.com')
            ->view('emails.test')
            ->with([
                'body' => $this->body ?? ''
            ]);
    }
}

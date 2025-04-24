<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Mail\ContactFormMail;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    protected $viewName;
    protected $customSubject;
    /**
     * Create a new message instance.
     *
     * @param array $data
     * @param string $viewName
     * @param string|null $subject
     */
    public function __construct(array $data, string $viewName = 'emails.contact', ?string $subject = null)
    {
        $this->data = $data;
        $this->viewName = $viewName;
        $this->customSubject = $subject;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = $this->customSubject ?? $this->data['subject'] ?? 'Contact Form Message';

        return $this->subject($subject)
                    ->view($this->viewName)
                    ->with('data', $this->data); // send as $data in view
    }
}

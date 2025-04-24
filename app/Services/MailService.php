<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Helpers\ContactLogger;
use Exception;

class MailService
{
    public function sendContactMail(array $data, string $view = 'emails.contact'): bool
    {
        $recipient = $data['email'] ?? null;
        $subject = $data['subject'] ?? 'Contact Form Message';

        try {
            Mail::to($recipient)->send(new ContactFormMail($data, $view));

            ContactLogger::log([
                'status'    => 'success',
                'to'        => $recipient,
                'subject'   => $subject,
                'view'      => $view,
                'data'      => array_slice($data, 0, 5),
                'timestamp' => now()->toDateTimeString(),
                
            ] , 'MailSent');

            return true;
        } catch (Exception $e) {
            ContactLogger::log([
                'status'    => 'failed',
                'to'        => $recipient,
                'subject'   => $subject,
                'view'      => $view,
                'data'      => array_slice($data, 0, 5),
                'error'     => $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ] , 'MailError');

            return false;
        }
    }
}

<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ContactLogger
{
    public static function log(array $data , $type): void
    {
        $logFile = base_path(env('CONTACT_LOG_PATH', 'storage/logs/contact.log'));
        $archivePath = base_path(env('CONTACT_LOG_ARCHIVE_PATH', 'storage/logs/contact_archives/'));
        $maxSize = (int) env('CONTACT_LOG_MAX_SIZE', 1048576); // 1 MB

        $data['ip_address'] = request()->ip();
        $data['request_url'] = request()->fullUrl();
        $data['logged_at'] = now()->toDateTimeString();
        // Ensure archive folder exists
        if (!File::exists($archivePath)) {
            File::makeDirectory($archivePath, 0755, true);
        }

        // Archive if file exceeds max size
        if (File::exists($logFile) && File::size($logFile) >= $maxSize) {
            $timestamp = now()->format('Ymd_His');
            $newLogName = $archivePath . 'contact_' . $timestamp . '.log';
            File::move($logFile, $newLogName);
        }

        // Log the data
        Log::channel('contact')->info($type, $data);
    }
}

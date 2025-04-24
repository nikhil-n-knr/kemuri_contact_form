<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class EncryptionHelper
{
    public static function encrypt($data): string|null
    {
        try {
            $key = base64_decode(env('CONTACT_ENCRYPTION_KEY'));
            $iv = random_bytes(openssl_cipher_iv_length('AES-256-CBC'));

            $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);

            if ($encrypted === false) {
                throw new \Exception('Encryption failed');
            }

            return base64_encode($iv . $encrypted);
        } catch (\Throwable $e) {
            Log::error('Encryption failed: ' . $e->getMessage());
            return null;
        }
    }

    public static function decrypt($encryptedData): string|null
    {
        try {
            $key = base64_decode(env('CONTACT_ENCRYPTION_KEY'));
            $decoded = base64_decode($encryptedData);

            if ($decoded === false || strlen($decoded) < openssl_cipher_iv_length('AES-256-CBC')) {
                throw new \Exception('Invalid encrypted data format');
            }

            $ivLength = openssl_cipher_iv_length('AES-256-CBC');
            $iv = substr($decoded, 0, $ivLength);
            $cipherText = substr($decoded, $ivLength);

            $decrypted = openssl_decrypt($cipherText, 'AES-256-CBC', $key, 0, $iv);

            if ($decrypted === false) {
                throw new \Exception('Decryption failed');
            }

            return $decrypted;
        } catch (\Throwable $e) {
            Log::error('Decryption failed: ' . $e->getMessage());
            return null;
        }
    }
}


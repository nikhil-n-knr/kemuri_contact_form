<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\ContactLogger;

class SanitizeInput
{
    public function handle(Request $request, Closure $next)
    {
        $original = $request->all();
        $input = $request->all();
        array_walk_recursive($input, function (&$value) {
            if (is_string($value)) {
                $value = trim(strip_tags($value)); // Trim and strip HTML
            }
        });
        ContactLogger::log([ '🧼 SanitizeInput - Original' => $original] , 'OrginalInput');
        ContactLogger::log([ '✅ SanitizeInput - Sanitized' => $input] , 'SanitizeOutput');        

        $request->merge($input);

        return $next($request);
    }
}

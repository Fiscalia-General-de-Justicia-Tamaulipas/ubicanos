<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
use Symfony\Component\HttpFoundation\Response;

class SetSecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $nonce = base64_encode(random_bytes(16));
        $viteDevelopmentSource = app()->isLocal() ? ' http://localhost:5173' : '';
        $viteDevelopmentConnection = app()->isLocal() ? ' ws://localhost:5173' : '';
        Vite::useCspNonce($nonce);

        $response = $next($request);

        $response->headers->set('Content-Security-Policy', implode('; ', [
            "default-src 'self'",
            "base-uri 'self'",
            "object-src 'none'",
            "form-action 'self'",
            "script-src 'self' 'nonce-{$nonce}'{$viteDevelopmentSource}",
            "style-src 'self' 'unsafe-inline'{$viteDevelopmentSource}",
            "img-src 'self' data: https://tile.openstreetmap.org https://maps.google.com https://laravel.com{$viteDevelopmentSource}",
            "font-src 'self'{$viteDevelopmentSource}",
            "connect-src 'self'{$viteDevelopmentConnection}",
        ]));

        return $response;
    }
}

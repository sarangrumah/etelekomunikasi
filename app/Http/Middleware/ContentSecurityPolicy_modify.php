<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next)
    {
        // Generate a single nonce per request
        $nonce = bin2hex(random_bytes(16));

        // Build the CSP header with the current nonce
        $csp = $this->getCSP($nonce);

        // Share the nonce with views for inline scripts/styles
        View::share('nonce', $nonce);

        $response = $next($request);

        if ($response instanceof \Illuminate\Http\Response) {
            // Set the Content-Security-Policy header
            $response->headers->set('Content-Security-Policy', $csp);
        }

        $response = $next($request);

        if ($response instanceof \Illuminate\Http\Response || $response instanceof \Illuminate\Http\RedirectResponse) {
            $response->headers->set('Content-Security-Policy', $csp);
        } else {
            if (method_exists($response, 'headers')) {
                $response->headers->set('Content-Security-Policy', $csp);
            }
        }
        return $response;
    }

    protected function getCSP($nonce)
    {
        // Define your allowed domains
        $allowedDomains = [
            'https://cdn.ckeditor.com',
            'https://cdnjs.cloudflare.com',
            'https://unpkg.com/',
            'https://code.jquery.com',
            'https://cdn.jsdelivr.net',
            'https://e-telekomunikasi.komdigi.go.id',
            'https://fonts.gstatic.com',
            'https://fonts.googleapis.com'
        ];

        // Build the CSP directives
        $csp = "";
        $csp .= "default-src 'self'; ";
        $csp .= "script-src 'self' 'nonce-{$nonce}' " . implode(' ', []) . "; ";
        $csp .= "style-src 'self' 'nonce-{$nonce}' " . implode(' ', []) . "; ";
        $csp .= "img-src 'self' data:; ";
        $csp .= "connect-src 'self' " . implode(' ', $allowedDomains) . "; ";
        $csp .= "form-action 'self' " . implode(' ', $allowedDomains) . "; ";
        $csp .= "font-src 'self'" . implode(' ', $allowedDomains) . "; ";
        $csp .= "base-uri 'self'; ";
        $csp .= "object-src 'none'; ";
        // $csp .= "report-uri 'none';";

        return $csp;
    }
}
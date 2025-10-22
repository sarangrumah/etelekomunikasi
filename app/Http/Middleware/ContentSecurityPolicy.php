<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
        {
            
        // $response = $next($request);

        // $nonce = bin2hex(random_bytes(16));
        // $hash = 'sJ6S3JjdrY+/1EMpWnONepW7bnDCh0gldmlmns7MciI='; 
        // // Log::info('Generated nonce: ' . $nonce);
        // $csp = "default-src 'self'; ";
        // // $csp .= "script-src 'self; ";
        // // $csp .= "script-src 'self' 'sha256-sJ6S3JjdrY+/1EMpWnONepW7bnDCh0gldmlmns7MciI='; ";
        // $csp .= "script-src 'self' 'nonce-unique-nonce-value' https://cdn.ckeditor.com
        // https://cdnjs.cloudflare.com https://unpkg.com/ https://code.jquery.com https://cdn.jsdelivr.net
        // https://e-telekomunikasi.kominfo.go.id 'sha256-$hash';";
        // $csp .= "style-src 'self' 'nonce-unique-nonce-value' https://cdn.ckeditor.com https://unpkg.com/
        // https://code.jquery.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://fonts.googleapis.com
        // https://e-telekomunikasi.kominfo.go.id 'sha256-$hash';";
        // // $csp .= "script-src 'self' 'unsafe-inline' 'sha256-sJ6S3JjdrY+/1EMpWnONepW7bnDCh0gldmlmns7MciI=' 'sha256-$hash' https://unpkg.com; ";
        // // $csp .= "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com http://e-telekomunikasi.kominfo.go.id 'sha256-$hash' https://unpkg.com; ";
        // $csp .= "font-src 'self' https://fonts.gstatic.com http://e-telekomunikasi.kominfo.go.id https://unpkg.com data:; ";
        // $csp .= "connect-src 'self' http://e-telekomunikasi.kominfo.go.id; ";
        // $csp .= "img-src 'self' https://code.jquery.com data:; ";
        // // $csp .= "connect-src 'self'; ";
        // $csp .= "frame-src 'self';";
        // $csp .= "frame-ancestors 'none';";

        // $response->headers->set('Content-Security-Policy', $csp);
        // // view()->share('nonce', $nonce);
        // View::share('nonce', $nonce);

        $response = $next($request);

        $nonce = bin2hex(random_bytes(16));
        $hash = 'sJ6S3JjdrY+/1EMpWnONepW7bnDCh0gldmlmns7MciI=';
        $hash2 = 'vqkZjjiZlmMNj9vs365VY5Hxs0NS/hZ/H5PsWeDGboA=';


        $csp = "default-src 'self'; ";
        $csp .= "script-src 'self' https://cdn.ckeditor.com/4.24.0-lts/* https://cdn.ckeditor.com/4.24.0-lts/standard/lang/en.js https://cdn.ckeditor.com/4.24.0-lts/standard/styles.js 'nonce-unique-nonce-value' *.tinymce.com *.tiny.cloud https://cdnjs.cloudflare.com https://unpkg.com/ https://code.jquery.com https://cdn.jsdelivr.net https://e-telekomunikasi.komdigi.go.id 'sha256-$hash' 'sha256-$hash2'; ";
        $csp .= "style-src 'self' https://cdn.ckeditor.com/4.24.0-lts/* https://cdn.ckeditor.com/4.24.0-lts/standard/styles.js 'nonce-unique-nonce-value' *.tinymce.com *.tiny.cloud https://unpkg.com https://code.jquery.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://fonts.googleapis.com https://e-telekomunikasi.komdigi.go.id 'sha256-$hash' 'sha256-$hash2';";
        $csp .= "font-src 'self' https://cdn.ckeditor.com/4.24.0-lts/* https://cdn.ckeditor.com/4.24.0-lts/standard/styles.js https://fonts.gstatic.com http://e-telekomunikasi.komdigi.go.id https://unpkg.com data:; ";
        $csp .= "connect-src 'self' *.tinymce.com *.tiny.cloud  https://cdn.ckeditor.com/4.24.0-lts/* http://e-telekomunikasi.komdigi.go.id;";
        $csp .= "img-src 'self' https://code.jquery.com *.tinymce.com *.tiny.cloud data:;";
        // $csp .= "require-trusted-types-for 'script';";
        $csp .= "frame-src 'self'; ";
        $csp .= "frame-ancestors 'none';"; 
        // $csp .= "require-trusted-types-for 'script';";
        // $csp .= "trusted-types default;";

        $response->headers->set('Content-Security-Policy', $csp);

        View::share('nonce', $nonce);

        return $response;
    }
}
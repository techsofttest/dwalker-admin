<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Cors_middleware Hook
 * Handles CORS headers, OPTIONS preflight requests, and HTTP Security Headers for Next.js API calls.
 */
class Cors_middleware {

    public function handle_cors_and_security() {
        // Allowed origins for CORS (Development & Production Next.js URLs)
        $allowed_origins = array(
            'http://localhost:3000',
            'http://127.0.0.1:3000',
            'https://dwalker-jewelers.vercel.app',
            'https://www.dwalker.co.nz'
        );

        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

        if (in_array($origin, $allowed_origins)) {
            header("Access-Control-Allow-Origin: " . $origin);
        } else {
            // Default fallback origin
            header("Access-Control-Allow-Origin: http://localhost:3000");
        }

        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, X-Api-Key");
        header("Access-Control-Max-Age: 86400"); // Cache preflight response for 24 hours

        // HTTP Security Headers
        header("X-Content-Type-Options: nosniff");
        header("X-Frame-Options: SAMEORIGIN");
        header("X-XSS-Protection: 1; mode=block");
        header("Referrer-Policy: strict-origin-when-cross-origin");

        // If OPTIONS preflight request, terminate early with 200 OK
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }
    }
}

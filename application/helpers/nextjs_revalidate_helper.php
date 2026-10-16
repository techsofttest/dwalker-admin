<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Next.js Revalidation Helper
 * Sends an asynchronous trigger to Next.js on-demand ISR revalidation endpoint.
 */

if (!function_exists('trigger_nextjs_revalidation')) {
    /**
     * Triggers Next.js to purge and rebuild static cache for a specified path.
     *
     * @param string $path Target path to revalidate (e.g. '/', '/products', '/new-arrivals')
     * @return bool        True if trigger sent successfully
     */
    function trigger_nextjs_revalidation($path = '/') {
        $nextjs_domain    = 'http://localhost:3000'; // Replace with production URL on deploy
        $revalidate_secret = 'dwalker_secret_token_2026'; // Must match REVALIDATE_SECRET in Next.js

        $url = $nextjs_domain . '/api/revalidate?secret=' . urlencode($revalidate_secret) . '&path=' . urlencode($path);

        // Non-blocking cURL call
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2); // 2 second timeout so admin UI isn't slowed down
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($http_code === 200);
    }
}

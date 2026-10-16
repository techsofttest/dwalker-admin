<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Rate Limit Helper
 * Protects sensitive endpoints against brute-force attacks and bot abuse.
 */

if (!function_exists('check_rate_limit')) {
    /**
     * Checks if the client IP has exceeded the allowed request limit for an action.
     *
     * @param string $action_key Unique key for the endpoint (e.g. 'login_attempt', 'checkout')
     * @param int    $max_attempts Maximum allowed requests in window (default: 5)
     * @param int    $decay_seconds Time window in seconds (default: 60)
     * @return bool  True if under limit, false if rate limited
     */
    function check_rate_limit($action_key = 'general', $max_attempts = 5, $decay_seconds = 60) {
        $ci =& get_instance();
        $ci->load->driver('cache', array('adapter' => 'file'));

        $ip = $ci->input->ip_address();
        $cache_key = 'rate_limit_' . md5($action_key . '_' . $ip);

        $attempts = $ci->cache->get($cache_key);

        if ($attempts === FALSE) {
            $ci->cache->save($cache_key, 1, $decay_seconds);
            return true;
        }

        if ($attempts >= $max_attempts) {
            return false;
        }

        $ci->cache->save($cache_key, $attempts + 1, $decay_seconds);
        return true;
    }
}

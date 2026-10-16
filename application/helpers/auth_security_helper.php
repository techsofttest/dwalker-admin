<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth Security Helper
 * Provides modern bcrypt password hashing, legacy fallback verification,
 * and automatic password upgrade on login.
 */

if (!function_exists('verify_and_upgrade_password')) {
    /**
     * Verifies password against hash. Supports bcrypt, md5, sha1, and auto-upgrades legacy hashes.
     *
     * @param string $input_password  Raw password entered by user/admin
     * @param string $stored_hash     Stored password hash in database
     * @param string $table           Database table ('dwalker_admin' or 'dwalker_users')
     * @param string $id_field        ID field name ('adminId' or 'USER_ID')
     * @param mixed  $id_value        ID value
     * @param string $pass_field      Password column name ('adminPassword' or 'PASSWORD')
     * @return bool                   True if password is correct, false otherwise
     */
    function verify_and_upgrade_password($input_password, $stored_hash, $table, $id_field, $id_value, $pass_field = 'PASSWORD') {
        $ci =& get_instance();

        // 1. Check if stored hash is a modern password_hash (starts with $2y$, $2a$, $2b$)
        if (substr($stored_hash, 0, 4) === '$2y$' || substr($stored_hash, 0, 4) === '$2a$' || substr($stored_hash, 0, 4) === '$2b$') {
            return password_verify($input_password, $stored_hash);
        }

        // 2. Legacy Check: MD5
        $is_valid_md5  = (md5($input_password) === $stored_hash);
        
        // 3. Legacy Check: SHA1
        $is_valid_sha1 = (sha1($input_password) === $stored_hash);

        if ($is_valid_md5 || $is_valid_sha1) {
            // Upgrade password hash to modern Bcrypt seamlessly
            $new_bcrypt_hash = password_hash($input_password, PASSWORD_BCRYPT, ['cost' => 12]);
            
            $ci->db->where($id_field, $id_value);
            $ci->db->update($table, [$pass_field => $new_bcrypt_hash]);

            return true;
        }

        return false;
    }
}

if (!function_exists('hash_password_secure')) {
    /**
     * Generates a modern Bcrypt password hash.
     *
     * @param string $password Raw password string
     * @return string          Bcrypt hashed string
     */
    function hash_password_secure($password) {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }
}

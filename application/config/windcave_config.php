<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| WINDCAVE PAYMENT GATEWAY CONFIG (DEFAULT / FALLBACK)
| -------------------------------------------------------------------
| Environment-specific credentials should be set in untracked files:
|   - application/config/development/windcave_config.php (Ignored by git)
|   - application/config/production/windcave_config.php  (Ignored by git)
*/

$config['windcave_mode'] = 'test';

$config['windcave_api_url']     = 'https://uat.windcave.com/api/v1';
$config['windcave_username']    = '';
$config['windcave_api_key']     = '';
$config['windcave_auth_header'] = '';

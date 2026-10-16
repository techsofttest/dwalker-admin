<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks Configuration
| -------------------------------------------------------------------------
*/

$hook['pre_system'][] = array(
    'class'    => 'Cors_middleware',
    'function' => 'handle_cors_and_security',
    'filename' => 'Cors_middleware.php',
    'filepath' => 'hooks'
);


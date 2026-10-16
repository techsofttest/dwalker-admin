<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Centralized Email Configuration for D Walker Jewellers
 * CodeIgniter automatically loads this file when $this->load->library('email') is called.
 */

$config['protocol']     = 'smtp';
$config['smtp_host']    = 'ssl://smtp.gmail.com';
$config['smtp_port']    = 465;
$config['smtp_timeout'] = 10;
$config['smtp_user']    = 'techsofttest123@gmail.com';
$config['smtp_pass']    = 'uqzoqojfbrsmakqh';
$config['mailtype']     = 'html';
$config['charset']      = 'utf-8';
$config['newline']      = "\r\n";
$config['crlf']         = "\r\n";
$config['validation']   = TRUE;
$config['wordwrap']     = TRUE;

// Default sender settings
$config['from_email']   = 'techsofttest123@gmail.com';
$config['from_name']    = 'D. Walker Jewellers';

// Centralized Admin Notification Recipients (order alerts, contact inquiries)
$config['admin_emails'] = 'dwalkerjewels@gmail.com, nair182002@gmail.com, techsofttest@gmail.com';


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Router extends CI_Router {

	protected function _set_default_controller()
	{
		if (empty($this->default_controller))
		{
			show_error('Unable to determine what should be displayed. A default route has not been specified in the routing file.');
		}

		if (sscanf($this->default_controller, '%[^/]/%s', $class, $method) !== 2)
		{
			$method = 'index';
		}

		// Support sub-directories in default_controller (e.g. 'admin/login' or 'admin/Login')
		if (is_dir(APPPATH.'controllers/'.$class))
		{
			$this->set_directory($class);
			$segments = explode('/', $this->default_controller);
			$class = isset($segments[1]) ? $segments[1] : $this->default_controller;
			$method = isset($segments[2]) ? $segments[2] : 'index';
		}

		if ( ! file_exists(APPPATH.'controllers/'.$this->directory.ucfirst($class).'.php'))
		{
			// This will trigger 404 later
			return;
		}

		$this->set_class($class);
		$this->set_method($method);

		// Assign routed segments, index starting from 1
		$this->uri->rsegments = array(
			1 => $class,
			2 => $method
		);

		log_message('debug', 'No URI present. Default controller set.');
	}
}

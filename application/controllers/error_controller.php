<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* \brief Errors management.
*/
class Error_controller extends My_controller
{
	/**
	* \brief Class constructor.
	*/
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* \brief Auto loaded class function.
	*/
	public function index()
	{}

	/**
	* \brief Manages restricted access
	*/
	public function restricted()
	{
		$this->construct_page->_run($this->config->item('restricted_path')); // header + restricted_access + footer
	}
}

?>

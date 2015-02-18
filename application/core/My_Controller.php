<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* \brief Class for manage authorizations.
*/
class My_controller extends CI_controller
{
	/**
	* \brief Class constructor.
	*/
	public function __construct()
	{
		parent::__construct();
	//	$this->_check_permission();
	}

	/**
	* \brief Check page permission and kick if access is not allowed.
	*/
	protected function _check_permission()
	{
		$uri = $this->router->fetch_class().'/'.$this->router->fetch_method(); // uri recovery
		if($this->session->userdata('logged') !== TRUE && !in_array($uri, $this->config->item('not_logged_allowed'))){ $this->_kick(); } // kick if needed
	}

	/**
	* \brief Kick the user from the page (included ajax requests).
	*/
	protected function _kick()
	{
		if($this->input->is_ajax_request()) // ajax
		{
			echo json_encode(array('status' => 'disconnected'));
			die();
		}
		else // other
		{
			redirect(base_url() . 'restricted');
			die();
		}
	}
}

?>

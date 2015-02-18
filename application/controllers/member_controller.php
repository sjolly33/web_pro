<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* \brief Members management.
*/
class Member_controller extends My_controller
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
	* \param data Data sent to the view (default = empty array).
	*/
	public function index($data = array())
	{
		$this->construct_page->_run('member/index', $data);
	}

    /**
    * \brief Register a new member in the database.
    */
	public function register()
	{
		$data = array();

		if($this->input->post() !== FALSE) // if there is post data
		{
			$m = new Member();

			$m->username = $this->input->post('username');
			$m->pass = $this->input->post('pass');
			$m->confirm_pass = $this->input->post('confirm_pass');
			$m->email = $this->input->post('email');
			$m->confirm_email = $this->input->post('confirm_email');
			$m->salt = md5(uniqid(rand(), true));

			if($m->save()){ $data['success_register'] = 'Enregistrement effectué.'; }
			else
			{
				$data['error_register'] = $m->error->all;
				$data['post'] = $this->input->post();
			}
		}

		$this->construct_page->_run('member/register', $data); // header + member/register + footer
	}

	/**
	* \brief Site login.
	*/
	public function login()
	{
		$data = array();

		if($this->input->post() !== FALSE) // if there is post data
		{
			$bad_connection = 'Mauvais couple email / mot de passe';

			// get member by email
			$bd_member = new Member();
			$bd_member->where('email', $this->input->post('email'))->get();

			if($bd_member->result_count() == 0) // email doesn t exist
			{
				$data['error_login'] = $bad_connection;
			}
			////
			else // email exists
			{
				// member temporary created to test encrypted pass matching (never saved in db)
	        	$tmp_member = new Member();
	        	$tmp_member->pass = $this->input->post('pass');
	        	$tmp_member->salt = $bd_member->salt; // get existing member salt to encrypt
	        	$tmp_member->_encrypt('pass'); // encrypt pass
				////

				if($bd_member->pass === $tmp_member->pass) // valid match
				{
					$this->session->set_userdata('logged', TRUE);
					redirect('member', 'refresh');
				}
				else // bad match
				{
					$data['error_login'] = $bad_connection;
				}
			}
		}

		$this->construct_page->_run('member/login', $data); // header + member/login + footer
	}

	/**
	* \brief Site logout.
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('member', 'refresh');
	}
}

?>

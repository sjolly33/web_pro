<?php

class Patient extends DataMapper
{
	var $has_one = array();
	var $has_many = array('meeting');

	var $validation = array(
		'last_name' => array(
			'label' => 'last name',
			'rules' => array('required', 'min_length' => 1, 'max_length' => 30)
		),

		'first_name' => array(
			'label' => 'first name',
			'rules' => array('required', 'min_length' => 1, 'max_length' => 30)
		),

		'email' => array(
			'label' => 'email adress',
			'rules' => array('required', 'unique', 'valid_email', 'min_length' => 1, 'max_length' => 200)
		),

		'phone_number' => array(
			'label' => 'phone number',
			'rules' => array('integer', 'min_length' => 2, 'max_length' => 15)
		),

		'birth_date' => array(
			'label' => 'birth date',
			'rules' => array('valid_date')
		)
	);

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}

?>
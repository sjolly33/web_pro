<?php

class Event extends DataMapper
{
	var $has_one = array();
	var $has_many = array();

	var $validation = array(
		'title' => array(
            'label' => 'title_new',
            'rules' => array('required', 'unique', 'min_length' => 1, 'max_length' => 200)
		),

		'date' => array(
			'label' => 'date_new',
			'rules' => array('required', 'valid_date')
		),

		'text' => array(
			'label' => 'text_new',
			'rules' => array('required', 'min_length' => 1, 'max_length' => 5000)
		),

		'status' => array(
			'label' => 'status_new',
			'rules' => array('integer', 'greater_than' => -1, 'less_than' => 129)
		)
	);

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}

?>
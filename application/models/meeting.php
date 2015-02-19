<?php

class Meeting extends DataMapper
{
	var $has_one = array('patient');
	var $has_many = array();

	var $validation = array(
		'date' => array(
			'label' => 'date',
			'rules' => array('required', 'valid_date')
		),

		'time' => array(
			'label' => 'time',
			'rules' => array('required', 'numeric')
		)
	);

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}

?>
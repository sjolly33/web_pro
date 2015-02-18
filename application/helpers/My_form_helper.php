<?php

function form_email($data = '', $value = '', $extra = '')
{
	if (!is_array($data))
	{
		$data = array('name' => $data);
	}

	$data['type'] = 'email';
	return form_input($data, $value, $extra);
}

?>
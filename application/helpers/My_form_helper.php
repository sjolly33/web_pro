<?php

/**
* \brief Construct an input witch type is email.
* \param data The parameters as a string (name only) or as an associative array (parameter_name => parameter value).
* \param value The default value as a string.
* \param extra Additional data (like javascript) as a string.
* \return The input tag as a string.
*/
function form_email($data = '', $value = '', $extra = '')
{
	if(!is_array($data))
	{
		$data = array('name' => $data);
	}

	$data['type'] = 'email';
	return form_input($data, $value, $extra);
}

/**
* \brief Construct an input witch type is date.
* \param data The parameters as a string (name only) or as an associative array (parameter_name => parameter value).
* \param value The default value as a string.
* \param extra Additional data (like javascript) as a string.
* \return The input tag as a string.
*/
function form_date($data = '', $value = '', $extra = '')
{
	if(!is_array($data))
	{
		$data = array('name' => $data);
	}

	$data['type'] = 'date';
	return form_input($data, $value, $extra);
}

/**
* \brief Construct an input witch type is tel (telephone number).
* \param data The parameters as a string (name only) or as an associative array (parameter_name => parameter value).
* \param value The default value as a string.
* \param extra Additional data (like javascript) as a string.
* \return The input tag as a string.
*/
function form_tel($data = '', $value = '', $extra = '')
{
	if(!is_array($data))
	{
		$data = array('name' => $data);
	}

	$data['type'] = 'tel';
	return form_input($data, $value, $extra);
}

?>
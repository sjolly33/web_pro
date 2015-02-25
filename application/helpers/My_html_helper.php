<?php
	/**
	* \brief : constructs the path an image.
	* \param text : the name of the image (default = 0 => returns the images folder path).
	* \return : the path of the image whose name is provided or the path of the images folder as a string.
	*/
	function img_path($text = '')
	{
		$ci =& get_instance();
		return $ci->config->item('img_path') . $text;
	}

	/**
	* \brief : constructs title page with logo.
	* \param text : the title page text as string.
	* \param logo : the logo address as string (default = none).
	* \param mime : the mime type of the logo (default = '').
	* \return : The logo (if exists), the site name (if exists) and the text passed as a string.
	*/
	function title_page($text, $logo = '', $mime = '')
	{
		// get site_name
		$ci =& get_instance();
		$site_name = $ci->config->item('site_name');
		////

		$title = '';

		if($logo != ''){ $title.= link_tag(img_path($logo), 'icon', $mime); } // insert logo if exists

		$title .= '<title>';
		if($site_name != ''){ $title .= $site_name . ' - '; } // insert site name if exists
		$title .= $text . '</title>'; // insert text

		return $title;
	}

	/**
	* \brief : constructs div tag with text.
	* \param text : the text to insert into the div as a string.
	* \param params : the div attributes as an associative array (default = none).
	* \return : The div area with the text inside as a string.
	*/
	function div($text, $params = array())
	{
		$out = '<div' ;
		foreach($params as $key => $value)
		{
			$out .= ' ' . $key . '="' . $value . '"';
		}

		$out .= '>' . $text . '</div>';

		return $out;
	}

	/**
	* \brief : constructs span tag with text.
	* \param text : the text to insert into the span as a string.
	* \param params : the span attributes as an associative array (default = none).
	* \return : The span area with the text inside as a string.
	*/
	function span($text, $params = array())
	{
		$out = '<span' ;
		foreach($params as $key => $value)
		{
			$out .= ' ' . $key . '="' . $value . '"';
		}

		$out .= '>' . $text . '</span>';

		return $out;
	}

	/**
	* \brief : constructs a link (<a>).
	* \param text : the text to insert into the <a> as a string.
	* \param href : the href attribute for the <a> as a string (default = #).
	* \param params : the <a> attributes as an associative array (default = none).
	* \return : The <a> area with the text inside as a string.
	*/
	function a($text, $href = '#', $params = array())
	{
		$out = '<a href="' . $href . '"' ;
		foreach($params as $key => $value)
		{
			$out .= ' ' . $key . '="' . $value . '"';
		}

		$out .= '>' . $text . '</a>';

		return $out;
	}

?>

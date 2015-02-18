<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Construct_page
{
	/**
	* \brief : load one or many pages with header and footer.
	* \param view : view(s) to be loaded. As a string if only one page is loaded OR as an array of strings if many pages are loaded.
	* \param view_data : data to pass to the view. As an array if only one page is loaded OR as an array of arrays if many pages are loaded.
	* \param header_data : data to pass to the header as an array.
	* \param footer_data : data to pass to the footer as an array.
	* \param header : header name (default = 'header').
	* \param footer : footer name (default = 'footer').
	*/
    public function _run($view, $view_data = array(), $header_data = array(), $footer_data = array(), $header = 'header', $footer = 'footer')
   	{
   		$ci =& get_instance();
    	$ci->load->view($header, $header_data); // header

    	// view(s)
    	if(gettype($view) == 'string') // only one view
    	{
    		$ci->load->view($view, $view_data);
    	}
    	else if(gettype($view) == 'array') // many views
    	{
	    	foreach($view as $key => $v)
	    	{
	    		$ci->load->view($v, $view_data[$key]);
	    	}    		
    	}
    	else // $view tyoe error
    	{
    		trigger_error("view must be string or array.");//echo "Error : typeof $view must be string or array.";
    	}
    	////

    	$ci->load->view($footer, $footer_data); // footer
    }
}

?>

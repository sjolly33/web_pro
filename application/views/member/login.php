<?php
	/**
	* \brief Constructs a form control with label.
	* \param name The field name as a string.
	* \param label The field label as a string (will be visible by user).
	* \param control The control function name as a string (will be call as a function).
	* \param attributes_control The control field attributes as an associative array (default = empty).
	* \return The controller as a string.
	*/
	function construct_control($name, $label, $control, $attributes_control = array())
	{
		$field_class = array('class' => 'form-group');
		if(!ISSET($attributes_control['name']))
		{
			$attributes_control += array('name' => $name); // add name to attributes_control array
		}

		return div(
			form_label($label, $name, array('class' => 'control-label')) .
			call_user_func($control, $attributes_control),							
			$field_class);
	}
?>


<!DOCTYPE html>
<html lang=<?php echo $this->config->item('lang'); ?>>
    <head>
    	<?php echo title_page('login', 'icon.png', 'image/png'); ?>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
    </head>

	<body>
		<div class = 'container'>
			<div class='col-xs-12 col-sm-offset-8 col-sm-4 col-md-offset-8 col-md-3' style='background-color : grey;'>

				<?php
					// error display
					if(ISSET($error_login)){ echo div(div($error_login, array('class' => 'col-xs-12 text-center error')), array('class' => 'row')); }
					////

					echo form_open('member/login');
					echo div(form_fieldset('Connexion'), array('class' => 'text-center'));

					echo construct_control('email', 'adresse e-mail', 'form_email', array('class' => 'form-control'));
					echo construct_control('pass', 'mot de passe', 'form_password', array('class' => 'form-control'));

					echo br();
					echo div(form_submit(array('name' => 'send_login', 'value' => 'connexion', 'class' => 'btn btn-default')), array('class' => 'text-center'));
					echo form_fieldset_close() . form_close();
				?>
				
			</div>

			<div class='col-md-1'> <!-- ajust to 12 col --></div>
		</div>
	</body>
</html>
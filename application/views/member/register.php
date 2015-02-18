<?php
	/**
	* \brief Constructs a form control with label.
	* \brief If the form as already been submited but is not valid, the error fields will be highlight and the success fields will be automatically filled with post data received by controller.
	* \param name The field name as a string (must be the same for control name and error name).
	* \param label The field label as a string (will be visible by user).
	* \param control The control function name as a string (will be call as a function).
	* \param post The post data received by controller if the form has already been submited as an associative array (key = field names, values = value sent).
	* \param error_register The errors returned by controller as an associative array (key = field names, values = error message).
	* \return The controller as a string.
	*/
	function construct_control($name, $label, $control, $post, $error_register)
	{
		$field_class_none = array('class' => 'form-group');
		$field_class_valid = array('class' => 'form-group has-feedback');
		$field_class_error = array('class' => 'form-group has-error has-feedback');
		$glyph_ok = '<span class="glyphicon glyphicon-ok form-control-feedback"></span>';
		$glyph_remove = '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';

		if(!ISSET($error_register[$name])) // no error on field
		{
			$field_class = $field_class_valid;
			$glyph = $glyph_ok;
			if(!ISSET($post[$name])) // if no post data
			{
				$value = ''; // filling variable if doesn t exist
				$field_class = $field_class_none; // applying none style since field has not been submited
				$glyph = ''; // clearing glyph
			}
			else{ $value = $post[$name]; }
			$attributes_control = array('name' => $name,  'class' => 'form-control', 'value' => $value);

			return div(
				form_label($label, $name, array('class' => 'control-label')) .
				call_user_func($control, $attributes_control).
				$glyph,
				$field_class);
		}
		else // error on field
		{
			$attributes_control = array('name' => $name,  'class' => 'form-control');

			return div(
				form_label($label, $name, array('class' => 'control-label')) .
				call_user_func($control, $attributes_control) .
				$glyph_remove .
				'<span class="help-block">' . $error_register[$name] . '</span>',
				$field_class_error);
			}
	}
?>


<!DOCTYPE html>
<html lang=<?php echo $this->config->item('lang'); ?>>
    <head>
    	<?php echo title_page('register', 'icon.png', 'image/png'); ?>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
    </head>

	<body>
		<div class = 'container'>
			<div class='col-xs-12 col-sm-offset-8 col-sm-4 col-md-offset-8 col-md-3' style='background-color : grey;'>

				<?php
					// needed variables declaration
					if(!ISSET($post)){ $post = array(); }
					if(!ISSET($error_register)){ $error_register = array(); }
					////

					// success display
					if(ISSET($success_register)){ echo div(div($success_register, array('class' => 'col-xs-12 text-center success')), array('class' => 'row')); }
					////

					echo form_open('member/register');
					echo div(form_fieldset('Inscription'), array('class' => 'text-center'));

 					// username field
					echo construct_control('username', 'pseudo', 'form_input', $post, $error_register);
					////

					// pass and confirm_pass fields
					echo construct_control('pass', 'mot de passe', 'form_password', $post, $error_register);
					echo construct_control('confirm_pass', 'mot de passe (vérification)', 'form_password', $post, $error_register);
					////

					// email an confirm_email fields
					echo construct_control('email', 'adresse e-mail', 'form_email', $post, $error_register);
					echo construct_control('confirm_email', 'adresse e-mail (vérification)', 'form_email', $post, $error_register);
					////

					echo br();
					echo div(form_submit(array('name' => 'send_new', 'value' => 'inscription', 'class' => 'btn btn-default')), array('class' => 'text-center'));
					echo form_fieldset_close() . form_close();
				?>
			</div>

			<div class='col-md-1'> <!-- ajust to 12 col --></div>
		</div>
	</body>
</html>
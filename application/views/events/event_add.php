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
		$field_class_valid = array('class' => 'form-group has-success has-feedback');
		$field_class_error = array('class' => 'form-group has-error has-feedback');
		$field_class_label = array('class' => 'control-label');
		$field_class_control = array('class' => 'form-control');
		$glyph_ok = span('', array('class' => 'glyphicon glyphicon-ok form-control-feedback'));
		$glyph_remove = span('', array('class' => 'glyphicon glyphicon-remove form-control-feedback'));

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
			$attributes_control = array_merge(array('name' => $name, 'value' => $value), $field_class_control);

			return div(
				form_label($label, $name, $field_class_label) .
				call_user_func($control, $attributes_control).
				$glyph,
				$field_class);
		}
		else // error on field
		{
			$attributes_control = array_merge(array('name' => $name), $field_class_control);

			return div(
				form_label($label, $name, $field_class_label) .
				call_user_func($control, $attributes_control) .
				$glyph_remove .
				span($error_register[$name], array('class' => 'help-block')),
				$field_class_error);
			}
	}
?>


<!DOCTYPE html>
<html lang=<?php echo $this->config->item('lang'); ?>>
    <head>
    	<?php echo title_page('Ajouter actualité', 'icon.png', 'image/png'); ?>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
    </head>

	<body>
		<div class='container'>
			<div class='col-xs-12 col-sm-offset-2 col-sm-10 col-md-offset-2 col-md-6'>
				<?php
					// needed variables declaration
					if(!ISSET($post)){ $post = array(); }
					if(!ISSET($error_register)){ $error_register = array(); }
					////

					// success display
					if(ISSET($success_register)){ echo div(div($success_register, array('class' => 'col-xs-12 text-center success')), array('class' => 'row')); }
					////

					echo form_open(base_url() . 'add_new');
					echo div(div(form_fieldset('Ajouter une actualité'), array('class' => 'text-center')), array('class' => 'row')) . br();

					echo construct_control('title', 'titre', 'form_input', $post, $error_register); // title field
					echo construct_control('text', 'contenu', 'form_textarea', $post, $error_register); // text field

					echo br() . div(form_submit(array('name' => 'send_event_add', 'value' => 'Envoyer', 'class' => 'btn btn-default')), array('class' => 'text-center'));
					echo form_fieldset_close() . form_close();
				?>
			</div>
		</div>
	</body>
</html>
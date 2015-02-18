<!DOCTYPE html>
<html lang=<?php echo $this->config->item('lang'); ?>>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
	    <meta name='description' content=<?php echo $this->config->item('site_desc'); ?>>
	    <meta name='author' content=<?php echo $this->config->item('author_name'); ?>>
    </head>

	<body>
		<?php // temporaire : simulation connexion / admin
			$this->session->set_userdata('is_logged_in', true);
			$this->session->set_userdata('is_admin', true);
		?>
		<div class='navbar navbar-inverse navbar-static-top' role='navigation'>
			<div class='container'>
				<div class='row'>
					<div class='col-xs-12 col-sm-4 col-md-2'> <!-- brand -->
						<?php echo img(array('src' => img_path('logo.png'), 'alt' => 'logo', 'class' => 'navbar-brand')); ?>
						<a class='navbar-brand' href=<?php echo base_url() ?> ><?php echo $this->config->item('site_name'); ?></a>
					</div>

					<div class='col-xs-12 col-sm-6 col-md-5'> <!-- game navigation -->
						<?php
							$a_params = array('class' => 'text-center');
							$list = array(a('Actualités', base_url('news'), $a_params), a('Rendez-vous', base_url('meet'), $a_params));
							echo ul($list, array('class' => 'nav navbar-nav'));
						?>
					</div>

					<div class='col-sm-2 col-md-5'> <!-- ajust to 12 col -->
					</div>

					<div class='nav-collapse collapse'> <!-- hidden at less than 940px -->
					</div>
				</div>
			</div>
		</div>
	</body>
</html>


<!--
			<?php
			/*echo "
			<div class='col-xs-1 col-sm-1 col-md-1 text-center' style='background-color : pink;'>1</div> <!-- temporaire : marquage des colones -->
			<div class='col-xs-1 col-sm-1 col-md-1 text-center' style='background-color : purple;'>2</div> <!-- temporaire : marquage des colones -->
			<div class='col-xs-1 col-sm-1 col-md-1 text-center' style='background-color : cyan;'>3</div> <!-- temporaire : marquage des colones -->
			<div class='col-xs-1 col-sm-1 col-md-1 text-center' style='background-color : green;'>4</div> <!-- temporaire : marquage des colones -->
			<div class='col-xs-1 col-sm-1 col-md-1 text-center' style='background-color : brown;'>5</div> <!-- temporaire : marquage des colones -->
			<div class='col-xs-1 col-sm-1 col-md-1 text-center' style='background-color : red;'>6</div> <!-- temporaire : marquage des colones -->
			<div class='col-xs-1 col-sm-1 col-md-1 text-center' style='background-color : grey;'>7</div> <!-- temporaire : marquage des colones -->
			<div class='col-xs-1 col-sm-1 col-md-1 text-center' style='background-color : yellow;'>8</div> <!-- temporaire : marquage des colones -->
			<div class='col-xs-1 col-sm-1 col-md-1 text-center' style='background-color : teal;'>9</div> <!-- temporaire : marquage des colones -->
			<div class='col-xs-1 col-sm-1 col-md-1 text-center' style='background-color : olive;'>10</div> <!-- temporaire : marquage des colones -->
			<div class='col-xs-1 col-sm-1 col-md-1 text-center' style='background-color : aqua;'>11</div> <!-- temporaire : marquage des colones -->
			<div class='col-xs-1 col-sm-1 col-md-1 text-center' style='background-color : lime;'>12</div> <!-- temporaire : marquage des colones -->
			";*/
			?>

	TODO
		CSS
			class
				bloc_an_event
				success
-->

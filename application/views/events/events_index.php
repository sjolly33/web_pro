<!DOCTYPE html>
<html lang=<?php echo $this->config->item('lang'); ?>>
    <head>
    	<?php echo title_page('news', 'icon.png', 'image/png'); ?>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>        
	</head>

	<body>
		<div class='container'>
			<?php if($this->session->userdata('is_logged_in') === true AND $this->session->userdata('is_admin') === true){ ?>
				<div class='text-right'><a href='<?php echo base_url(); ?>add_new' class='btn btn-success'>Ajouter une actualité</a></div>
			<?php echo br(2); } ?>

			<?php foreach($events as $e){ ?>
			<div class='bloc_an_event'>
				<div class='row'>
					<div class='col-xs-12 col-sm-10 col-md-11 title'><h4><?php echo $e->title; ?></h4></div>
					<div class='col-xs-12 col-sm-2 col-md-1 text-right date'><?php echo $e->date; ?></div>
				</div>
				<div class='row'>
					<div class='col-xs-12 col-sm-12 col-md-12 text'><?php echo $e->text; ?></div>
				</div>

				<?php if($this->session->userdata('is_logged_in') === true AND $this->session->userdata('is_admin') === true){ ?>
				<a href='<?php echo base_url() . 'modify_new/' . $e->id; ?>' class='btn btn-warning'><i class='fa fa-long-arrow-up'></i> Modifier <i class='fa fa-long-arrow-up'></i></a>
				<a href='<?php echo base_url() . 'del_new/' . $e->id; ?>' class='btn btn-danger' onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette actualité ?'));"><i class='fa fa-long-arrow-up'></i> Supprimer <i class='fa fa-long-arrow-up'></i></a>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
	</body>
</html>
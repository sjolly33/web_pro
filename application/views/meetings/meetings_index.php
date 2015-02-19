<!DOCTYPE html>
<html lang=<?php echo $this->config->item('lang'); ?>>
    <head>
    	<?php echo title_page('meets', 'icon.png', 'image/png'); ?>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>        
	</head>

	<body>
		<div class='container'>
			<?php
				/*echo form_open(base_url() . 'meet');
				echo form_dropdown('weeks', $weeks, $selected_week);
				echo '&nbsp' . form_submit(array('name' => 'send_week_choice', 'value' => 'Ok', 'class' => 'btn btn-default'));
				echo form_close();*/

				$meetings_table = array();
				foreach($week_planning as $k => $hour)
				{					
					$an_hour = array($hour['hour']);
					foreach($hour['week_meets'] as $day => $patient)
					{
						if($patient == '') // filling empty slots
						{
							$this->session->set_userdata('take_slot_date', $day);
							array_push($an_hour, a('prendre rdv', base_url('add_meet')));
						}
						else{ array_push($an_hour, '-'); } // filling full slots
						
					}

					array_push($meetings_table, $an_hour);
				}

             	echo $this->table->set_template(array('table_open' => '<table border="1" id="table_task" class="table table-responsive table-bordered">',
                    'cell_start'          => '<td class="text-center" style="background-color : #EEE;">',
                    'cell_alt_start'      => '<td class="text-center" style="background-color : #DDD;">',
                    'heading_cell_start'  => '<th class="text-center">'
             		));

             	array_unshift($worked_days, ''); // 1st column, 1st row
             	echo $this->table->set_heading($worked_days);
				echo $this->table->generate($meetings_table); 
			?>
		</div>
	</body>
</html>
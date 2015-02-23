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
				echo form_open(base_url() . 'meet');
				echo form_dropdown('list_weeks', $list_weeks);
				echo '&nbsp' . form_submit(array('name' => 'send_week_choice', 'value' => 'Ok', 'class' => 'btn btn-default'));
				echo form_close();

				if(ISSET($selected_week_taken_slots))
				{
					// dates in week (l d/m/y)
					$days = array();
					for($i = 0; $i < 7; ++$i)
					{
						$date_datetime = strtotime('+ ' . $i . 'day', $first_day);
						$date_day_week = date('l', $date_datetime);

						if(ISSET($worked_days[$date_day_week])){ array_push($days, $date_day_week . ' ' . date('Y/m/d', $date_datetime)); } // dates in header
					}
					////

					// settings table
					echo $this->table->set_template(
	             		array(
	             			'table_open' => '<table border="1" id="table_task" class="table table-responsive table-bordered">',
	                    	'cell_start'          => '<td class="text-center" style="background-color : #EEE;">',
	                    	'cell_alt_start'      => '<td class="text-center" style="background-color : #DDD;">',
	                    	'heading_cell_start'  => '<th class="text-center">'
	             	));

					// construct heading (from) from \var days (en)
					$heading = $days;
					foreach($heading as $key => $d)
					{
						$original_date_daytime = strtotime($d);
						$heading[$key] = $worked_days[date('l', $original_date_daytime)] . ' ' . date('d/m/y', $original_date_daytime);
					}
					array_unshift($heading, '');
					echo $this->table->set_heading($heading);
					////
	             	////

					$meetings_table = array(); // array planning
					foreach($time_slots as $a_slot)
					{
						$slot_hour = date('H:i', $a_slot);

						$week_slot = array();						
						array_push($week_slot, $slot_hour);
						foreach($days as $day)
						{
							$current_treated_date = strtotime($day . ' ' . $slot_hour);
							if(strtotime('-' . $this->config->item('delay_before_meet'), $current_treated_date) <= strtotime('now') OR ISSET($selected_week_taken_slots[$current_treated_date])) // if it s to late to ask a meeting or if the slot is already taken
							{
								array_push($week_slot, '');
							}
							else
							{
								array_push($week_slot, a('rdv', base_url() . 'add_meet/' . $current_treated_date));
							}
						}
						array_push($meetings_table, $week_slot);
					}	             	
	             	
					echo $this->table->generate($meetings_table);
				}
			?>
		</div>
	</body>
</html>
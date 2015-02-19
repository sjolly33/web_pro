<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* \brief Members management.
*/
class MeetingsCtrl extends My_controller
{
	/**
	* \brief Class constructor.
	*/
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* \brief Auto loaded class function.
	* \param data Data sent to the view (default = empty array).
	*/
	public function index($data = array())
	{
		$data['1st_day'] = strtotime('16 February 2015 01:00:05');
		$data['worked_days'] = $this->config->item('worked_days');

		/**$data['weeks'] = array(0 => 'semaine 1', 1 => 'semaine 2', 2 => 'semaine 3');
		$data['selected_week'] = 2;*/
		/*$data['week_planning'] = array(
				array('hour' => '9h00', 'X', '', 'X', 'X', '', '', 'X'),
				array('hour' => '10h00', '', 'X', '', 'X', 'X', 'X', ''),
				array('hour' => '12h00', 'X', 'X', 'X', 'X', 'X', 'X', '')
			);*/


		// compute worked slots for each worked day
		$begin = strtotime($this->config->item('1st_meet_begin')); // first meet begining in date format
		$end = strtotime($this->config->item('last_meet_end')); // last meet ending in date format
		$duration = explode(':', $this->config->item('meet_duration'));
		$meets = array(); // array to contain slots
		for($i = $begin; end($meets) < $end; $i = strtotime('+' . $duration[0] . ' hours ' . $duration[1] . ' minutes', end($meets)))
		{
			array_push($meets, $i);
		}
		////

		$week_planing = array(); // array to contain week complete planning (2d : days / slots)
		foreach($meets as $m) // hours (size = nb of hours)
		{
			$a_meeting = array();
			for($i = 0; $i < count($data['worked_days']); ++$i) // days (size = nb of worked days)
			{
				$a_meeting[date('l d/m/Y', strtotime('+' . $i . ' day', $data['1st_day']))] = '';
			}

			array_push($week_planing, array('hour' => date('H:i', $m), 'week_meets' => $a_meeting));
		}

		$data['week_planning'] = $week_planing;

		/*
		foreach($data['worked_days'] as $day)
		{
			$an_hour = array($day => )
		}

		if($this->input->post())
		{

		}
*/
		$this->construct_page->_run('meetings/meetings_index', $data);
	}

    /**
    * \brief Add a new rdv.
    * \brief note : get slot date in \var take_slot_date session variable.
    */
	public function add()
	{
	}
}

?>

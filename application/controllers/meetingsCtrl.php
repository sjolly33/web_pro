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
		$data['list_weeks'] = $this->_construct_weeks_list();

		if($this->input->post())
		{
			$first_day = $this->input->post('list_weeks'); // get selected week

			$meet_model = new Meeting();
			$selected_week_meets = $meet_model->where('date >=', date('Y/m/d', $first_day))->where('date <', date('Y/m/d', strtotime('next monday', $first_day)))->get();

			$selected_week_taken_slots = array(); // associative array to contain week complete planning (keys = dates (datetime format), values = '-' (meet slot taken))
			foreach($selected_week_meets as $a_meet){ $selected_week_taken_slots[strtotime($a_meet->date . ' ' . $a_meet->time)] = '-'; }

			$data['selected_week_taken_slots'] = $selected_week_taken_slots;
			$data['worked_days'] = $this->config->item('worked_days');
			$data['time_slots'] = $this->_construct_time_slots();
			$data['first_day'] = $first_day;
		}

		$this->construct_page->_run('meetings/meetings_index', $data);
	}

	/**
	* \brief Compute worked slots for each worked day.
	* \return Array of worked slots (dates in datetime format).
	*/
	private function _construct_time_slots()
	{
		$time_slots = array();
		for($i = strtotime($this->config->item('1st_meet_begin')); end($time_slots) < strtotime($this->config->item('last_meet_end')); $i = strtotime('+' . $this->config->item('meet_duration'), end($time_slots)))
		{
			array_push($time_slots, $i);
		}

		return $time_slots;
	}

	/**
	* \brief Construct informations for the weeks list.
	* \return An associative array (keys = dates (datetime format), values = dates (dd/mm/yyyy format)).
	*/
	private function _construct_weeks_list()
	{
		// select previous monday (today if we are on monday)
		$today = strtotime('now');
		if(date('l', $today) == 'Monday'){ $this_monday = strtotime('today'); } // if we are on monday
		else{ $this_monday = strtotime('last Monday', $today); }
		////

		$weeks_list = array();
		for($i = 0; $i < $this->config->item('nb_weeks_displayed'); ++$i)
		{
			$current_monday = strtotime('+' . $i . ' week', $this_monday);
			$weeks_list[$current_monday] = date('d/m/Y', $current_monday);
		}

		return $weeks_list;
	}

    /**
    * \brief Add a new meeting.
    * \param date The date chosen for meeting (time format).
    * \note Verify \param date availability in this method.
    */
	public function add($date)
	{
		echo date('l d/m/Y H:i', $date) . br();
		$this->construct_page->_run('meetings/meeting_add');
	}
}

?>

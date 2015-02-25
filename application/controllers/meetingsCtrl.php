<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* \brief Members management.
*/
class MeetingsCtrl extends My_controller
{
	private $_existing_slots; /** Contains worked slots for each worked day as an array (dates in datetime format) */


	/**
	* \brief Class constructor.
	*/
	public function __construct()
	{
		parent::__construct();
		$this->_existing_slots = $this->_construct_time_slots();
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
			$meet_model->where('date >=', date('Y/m/d', $first_day))->where('date <', date('Y/m/d', strtotime('next monday', $first_day)))->get();

			$selected_week_taken_slots = array(); // associative array to contain week complete planning (keys = dates (datetime format), values = '-' (meet slot taken))
			foreach($meet_model as $a_meet){ $selected_week_taken_slots[strtotime($a_meet->date . ' ' . $a_meet->time)] = '-'; }

			$data['selected_week_taken_slots'] = $selected_week_taken_slots;
			$data['worked_days'] = $this->config->item('worked_days');
			$data['time_slots'] = $this->_existing_slots;
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
	public function add($date = null)
	{
		$data = array();
		$data['post'] = array();
		$data['error_register'] = array();

		echo date('l d/m/Y H:i', $date) . br();

		if(!is_null($date)) // there is a date
		{
			// controls
			$new_meeting = new Meeting();

			$new_meeting->where('date', date('Y/m/d', $date))->where('time', date('H:i', $date))->get();
			if($new_meeting->result_count() !== 0){ header('Location: ' . base_url() . 'meet'); } // taken slot

			if(array_key_exists(date('l', $date), $this->config->item('worked_days')) == false OR in_array(strtotime(date('H:i', $date)), $this->_existing_slots) == false) // NOT worked day OR NOT existing slot
			{
				header('Location: ' . base_url() . 'meet');
			} // existing meeting day and slot

			if($date <= strtotime('+' . $this->config->item('delay_before_meet'), strtotime('now'))){ header('Location: ' . base_url() . 'meet'); } // past date
			////
		}
		else if($this->input->post()) // no date but post data
		{
			$patient_model = new Patient();

			$patient_model->first_name = $this->input->post('first_name');
			$patient_model->last_name = $this->input->post('last_name');
			$patient_model->email = $this->input->post('email');
			$patient_model->phone_number = ($this->input->post('phone_number') == '') ? NULL : $this->input->post('phone_number'); // phone number null field ?
			$patient_model->birth_date = ($this->input->post('birth_date') == '') ? NULL : $this->input->post('birth_date'); // birth date null field ?

		
			if($patient_model->save()){ $data['success_register'] = 'Patient enregistré.'; }
			else
			{
				$data['error_register'] = $patient_model->error->all;
				$data['post'] = $this->input->post();
			}
		}
		else // no date, no post data => error
		{
			header('Location: ' . base_url() . 'meet');
		}

		$this->construct_page->_run('meetings/meeting_add', $data);
	}
}

?>

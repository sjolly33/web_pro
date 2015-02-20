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
		$data['1st_day'] = strtotime('16 February 2015 00:00:00');
		$data['worked_days'] = $this->config->item('worked_days');

		/**$data['weeks'] = array(0 => 'semaine 1', 1 => 'semaine 2', 2 => 'semaine 3');
		$data['selected_week'] = 2;*/

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

		$week_planning = array(); // array to contain week complete planning
		$meet_model = new Meeting();
		foreach($meets as $m) // hours (size = nb of hours)
		{
			$a_meeting = array();
			for($i = 0; $i < count($data['worked_days']); ++$i) // days (size = nb of worked days)
			{
				$meet_date_num = strtotime('+' . $i . ' day ' . date('H', $m) . ' hours ' . date('i', $m) . ' minutes', $data['1st_day']);
				$meet_date_weekday = date('l', $meet_date_num);
				$meet_date_day = date('Y/m/d', $meet_date_num);

				$meet_model->where('time', date('H:i', $m))->where('date', $meet_date_day)->get();

				$a_meeting[$meet_date_num] = $meet_model->patient_id;
			}

			array_push($week_planning, array('hour' => date('H:i', $m), 'week_meets' => $a_meeting));
		}

		/*foreach($week_planning as $ligne)
		{
			foreach($ligne['week_meets'] as $k => $v)
			{
				echo 'cle = ' . $k . br() . 'valeur = ' . $v . br();
			}
			echo br();
		}*/

		$data['week_planning'] = $week_planning;

		$this->construct_page->_run('meetings/meetings_index', $data);
	}

    /**
    * \brief Add a new rdv.
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

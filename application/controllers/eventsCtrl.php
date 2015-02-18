<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* \brief Members management.
*/
class EventsCtrl extends My_controller
{
	/**
	* \brief Class constructor.
	*/
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* \brief Auto loaded class function. Display events.
	* \param data Data sent to the view (default = empty array).
	*/
	public function index($data = array())
	{
		$events = new Event();
		$data['events'] = $events->where('status', 1)->order_by('date', 'desc')->get();

		$this->construct_page->_run('events/events_index', $data);
	}

	/**
	* \brief Add a new event.
	*/
	public function add()
	{
		$data = array();

		if($this->input->post() !== FALSE) // if there is post data
		{
			$e = new Event();

			$e->title = $this->input->post('title');
			$e->text = $this->input->post('text');
			$time = time();
			$e->date = mdate('%Y-%m-%d %H:%i:%s', $time);

			if($e->save())
			{
				$data['success_register'] = 'Actualité créée.';
				header('Location: ' . base_url() . 'news');
			}
			else
			{
				$data['error_register'] = $e->error->all;
				$data['post'] = $this->input->post();
			}
		}

		$this->construct_page->_run('events/event_add', $data); // header + events/event_add + footer
	}

	/**
	* \brief Delete an event.
	* \param id The event s id in database.
	*/
	public function delete($id)
	{
		$e = new Event();
		$e->get_by_id($id);

		$e->status = 0;
		$e->save();

		header('Location: ' . base_url() . 'news');
	}

	/**
	* \brief Modify an event.
	* \param id The event s id in database.
	*/
	public function change($id)
	{
		$original_event = new Event();
		$original_event->get_by_id($id);

		$data = array();
		$data['post'] = $original_event;

		if($this->input->post() !== FALSE) // if there is post data
		{
			$changed_event = $original_event->get_clone(); // cloning event to test changes
			$changed_event->title = $this->input->post('title');
			$changed_event->text = $this->input->post('text');

			if($changed_event->save())
			{
				$data['success_register'] = 'Actualité modifiée.';
				$data['post'] = $changed_event;
				header('Location: ' . base_url() . 'news');
			}
			else
			{
				$errors = $changed_event->error->all;
				foreach($errors as $key => $e) { $changed_event->{$key} = $original_event->{$key}; } // reset values of error fields
				$data['error_register'] = $errors;
				$data['post'] = $changed_event;
			}
		}

		$this->construct_page->_run('events/event_change', $data);
	}
}

?>

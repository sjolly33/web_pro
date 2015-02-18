<?php
	/**
	* \brief : restricts a page access : if the user hasn t the necessary rights, he is redirected to a restriction page.
	* \param res : the necessary rights to access the page as an array.
	* \param rights : the user rights as an associative array where key is the right name and value is true (if assigned) or false (if not).
	* \param mode : if \res is an array, mode 0 is the conjunction of the rights, whereas mode 1 is the disjunction. Value is 0 or 1.
	*/
	function restricted_access($res, $right, $mode = 0)
	{
		if($mode == 0) // conjunction : one right not validated => redirection
		{
			foreach($res as $r) // foreach necessary right
			{
				if($right[$r] == false) // if the user does not have the right access
				{
					redirect('restricted');
				}
			}
		}

		else if($mode == 1) // disjunction : at least one right validated => ok
		{
			foreach($res as $r) // foreach necessary right
			{
				if($right[$r] == true) // if the user has the right access
				{
					return;
				}
			}
			redirect('restricted'); // no rights access => redirection
		}
	}

	$match = array('admin', 'r2', 'r3', 'r4', 'r5', 'r6', 'r7', 'r8');
	/**
	* \brief : create an associative array of rights according to a gross entry from database.
	* \param in : entry from database as a string (each character is 0 or 1).
	* \param match : a correspondence table as an array.
	* \return : the rights as an associative array.
	*/
	function rel_to_var($in, $match)
	{
		$out = array();

		foreach($match as $key => $value)
		{
			if(substr($in, $key, 1) == 1){ $out[$value] = true; } // true if string contains 1
			else{ $out[$value] = false; } // false if string contains 0 or other
		}
		
		return $out;
	}

	/**
	* \brief : create an entry to the database according to an associative array of rights.
	* \param in : the rights as an associative array.
	* \param match : a correspondence table as an array.
	* \return : entry to the database as a string (each character is 0 or 1).
	*/
	function var_to_rel($in, $match)
	{
		$out = '';

		foreach($match as $key => $value)
		{
			if($in[$value] == true){ $out[$key] = 1; }
			else{ $out[$key] = 0; }
		}

		return $out;
	}
?>

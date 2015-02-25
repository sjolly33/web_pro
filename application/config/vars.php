<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['site_name'] = 'Pro'; /** site name */
$config['site_desc'] = 'A professional website'; /** site description */
$config['author_name'] = 'lorallyne'; /** website author name */
$config['lang'] = 'fr'; /** site language */
$config['img_path'] = 'assets/img/'; /** images path after base path (base_url()) */
$config['css_path'] = 'assets/css/'; /** stylesheets path after base path (base_url()) */
$config['not_logged_allowed'] = array(
	'newsCtrl/',
	'newsCtrl/index',
); /** accessible pages without login */
$config['restricted_path'] = 'restricted_access'; /** the restricted page path in views */
$config['access'] = array(); /** access rights as an associative array */
$config['rights_length'] = 8; /** access rights length in database */
$config['1st_meet_begin'] = '0:00'; /** first meeting begining hour as a string (hours) */
$config['last_meet_end'] = '23:15'; /** last meeting ending hour as a string (hours) */
$config['meet_duration'] = '45 minutes'; /** duration of each meeting as a string (hours) */
$config['worked_days'] = array('Monday' => 'lundi', 'Tuesday' => 'mardi', 'Wednesday' => 'mercredi', 'Thursday' => 'jeudi', 'Friday' => 'vendredi', 'Saturday' => 'samedi', 'Sunday' => 'dimanche'); /** worked week days as an associative array (keys : weekdays in english with a capital, values : translation to display) */
$config['nb_weeks_displayed'] = 10; /** number of weeks accessible from this week in meeting/index */
$config['delay_before_meet'] = '1 hour'; /** minimal delay before a meeting (impossible to take a meeting less \param before the meeting) */

?>

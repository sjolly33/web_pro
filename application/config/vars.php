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
$config['1st_meet_begin'] = '9:30'; /** first meeting begining hour as a string (hours) */
$config['last_meet_end'] = '18:15'; /** last meeting ending hour as a string (hours) */
$config['meet_duration'] = '0:45'; /** duration of each meeting as a string (hours) */
$config['worked_days'] = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'); /** worked week days */

?>

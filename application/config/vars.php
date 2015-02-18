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

?>

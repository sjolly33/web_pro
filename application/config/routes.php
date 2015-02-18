<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = 'member_controller'; ///////////////////// TODO
$route['404_override'] = 'errors/page_missing';

// member_controller
$route['member'] = 'member_controller/index';
$route['member/register'] = 'member_controller/register';
$route['member/login'] = 'member_controller/login';
$route['member/logout'] = 'member_controller/logout';
////

// error_controller
$route['restricted'] = 'error_controller/restricted';
////


// event
$route['news'] = 'eventsCtrl';
$route['news/index'] = 'eventsCtrl/index';
$route['add_new'] = 'eventsCtrl/add';
$route['del_new/(:num)'] = 'eventsCtrl/delete/$1';
$route['modify_new/(:num)'] = 'eventsCtrl/change/$1';

////

// meet
$route['meet'] = 'meetCtrl';
////


/* End of file routes.php */
/* Location: ./application/config/routes.php */
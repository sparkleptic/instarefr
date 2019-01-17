<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['404_override'] = '';

$route['translate_uri_dashes'] = TRUE;

$route['login'] = 'User/index';
$route['user/login'] = 'User/index';
$route['user/signup'] = 'User/index';
$route['user/dashboard'] = 'User/dashboard'; 
$route['my-account'] = 'User/dashboard';  
$route['user/upload'] = 'User/upload';

$route['post-a-job'] = 'job/index';
$route['find-a-job'] = 'job/find';
$route['find-a-job/(:any)'] = 'job/find/$1';
$route['manage-job'] = 'job/manage'; 
$route['single-job/(:any)'] = 'job/single_job/$1/';  
$route['company-jobs/(:any)/(:any)'] = 'company/jobs/$1/$2';
$route['job-tag/(:any)'] = 'job/tags_job_list/$1';
$route['apply-job/(:any)'] = 'job/apply_job/$1';
$route['refer_candidate/(:any)'] = 'job/refer_candidate/$1';
$route['manage-job/(:any)'] = 'job/manage/$1/edit';
$route['refer-and-earn'] = 'job/refer_and_earn';  
$route['points_transaction'] = 'points/points_transaction';
$route['invite-friends'] = 'points/invite_friends/';

$route['instarefr_invitation/(:any)'] = 'points/instarefr_invitation/$1';
$route['candidate-detail/(:any)'] = 'User/user_detail/$1';


$route['404_override'] = 'home/redirect_404';
$route['blog'] = 'home/blog';
$route['blog/(:any)'] = 'home/blog/$1';
$route['faq'] = 'home/fre_que';
$route['frequently-asked-questions'] = 'home/fre_que';
$route['privacy-policy'] = 'home/privacy_policy';
$route['terms-condition'] = 'home/terms_and_condition';
$route['contact-us'] = 'home/contact_us';

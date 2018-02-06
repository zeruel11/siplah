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
$route['default_controller'] = 'beranda';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'beranda/masuk';
$route['logout'] = 'beranda/keluar';
$route['gedung/(:num)'] = 'beranda/detailGedung/$1';
// $route['renovasi/proposal'] = 'beranda/dataRenovasi/$1';
// $route['renovasi/kerja'] = 'beranda/dataRenovasi/$1';
$route['renovasi/(:any)'] = 'beranda/dataRenovasi/$1';
$route['renovasi/pekerjaan/(:num)'] = 'beranda/listPekerjaan/$1';
$route['search'] = 'beranda/searchGedung';
$route['renovasi/pekerjaan/baru'] = 'beranda/tambahPekerjaan';
$route['renovasi/pekerjaan/edit/(:any)'] = 'beranda/ubahPekerjaan/$1';
$route['renovasi/del/(:num)'] = 'beranda/hapusRenovasi/$1';
$route['renovasi/setuju/(:num)'] = 'beranda/setuju/$1';
$route['renovasi/tolak/(:num)'] = 'beranda/tolak/$1';
$route['renovasi/selesai/(:num)'] = 'beranda/doneRenovasi/$1';
$route['manage/user_baru'] = 'manage/createUser';
$route['manage/user_update/(:num)'] = 'manage/updateUser/$1';
$route['ajuan'] = 'beranda/tambahRenovasi';
$route['renovasi/ed/(:num)'] = 'beranda/ubahRenovasi/$1';
$route['gantipassword(:num)'] = 'ver_login/changepwd/$1';

// redirect direct access
$route['renovasi'] = 'beranda';

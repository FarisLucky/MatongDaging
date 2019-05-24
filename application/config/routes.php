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
$route['default_controller'] = 'Dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['pembayaran/uangmuka/kelola/(:num)'] = 'pembayaran/kelola_um/$1';
$route['pembayaran/uangmuka/bayar'] = 'pembayaran/uang_muka_modal';
$route['pembayaran/uangmuka/submitbayar'] = 'pembayaran/core_uang_muka';
$route['pembayaran/transaksi/bayar/(:num)'] = 'pembayaran/bayar_transaksi/$1';
$route['pembayaran/transaksi/bayar'] = 'pembayaran/transaksi_modal';
$route['pembayaran/datac'] = 'pembayaran/data_transaksi';
$route['pembayaran/transaksi/submitbayar'] = 'pembayaran/core_cicilan';
$route['approve/transaksi/detail/(:num)'] = 'approve/detail/$1';

// Auth Login
$route['auth/kelompokproperti'] = 'auth/auth_properti';
// $route['setting/profilperusahaan'] = 'Profil_perusahaan'; //Route Perumahan
// $route['setting/user'] = 'Kelola_users'; //Route User
// $route['setting/datauser'] = 'Kelola_users/datausers'; //Route user
// $route['setting/userstatus'] = 'Kelola_users/userstatus'; //Route user
// $route['setting/detailuser/(:num)'] = 'Kelola_users/detailuser/$1'; //Route user
// $route['setting/userproperti'] = 'Kelola_users/userProperti'; //Route user
// $route['setting/hapus/(:num)'] = 'Kelola_users/hapus/$1'; //Route user
// $route['setting/tambahuser'] = 'Kelola_users/tambah'; //Route user
// $route['setting/coretambah'] = 'Kelola_users/core_tambah'; //Route user
// Route Login
// $route['login'] = 'auth'; //Route user
// $route['core_login'] = 'auth/core_login'; //Route user

$route['wc'] = 'Welcome'; //Route Perumahan
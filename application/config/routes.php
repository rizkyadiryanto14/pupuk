<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//auth

$route['login']			= 'Auth/logic_login';
$route['logout']		= 'Auth/logout';
$route['dashboard']		= 'Backend/Dashboard';

//pupuk
$route['pupuk']							= 'Backend/Pupuk';
$route['pupuk/insert']					= 'Backend/Pupuk/insert';
$route['pupuk/update']					= 'Backend/Pupuk/update';
$route['pupuk/detail_update/(:num)']	= 'Backend/Pupuk/detail_view/$1';
$route['pupuk/delete/(:num)']			= 'Backend/Pupuk/delete';
$route['pupuk/get_data_pupuk']			= 'Backend/Pupuk/get_data_pupuk';

//pemesanan
$route['pemesanan']						= 'Backend/Pemesanan';
$route['pemesanan/insert']				= 'Backend/Pemesanan/insert';
$route['pemesanan/update']				= 'Backend/Pemesanan/update';
$route['pemesanan/delete/(:num)']		= 'Backend/Pemesanan/delete/$1';
$route['pemesanan/get_data_pemesanan'] 	= 'Backend/Pemesanan/get_data_pemesanan';
$route['pemesanan/api_users']			= 'Backend/Pemesanan/listing_users';
$route['pemesanan/api_pupuk']			= 'Backend/Pemesanan/listing_pupuk';
$route['pemesanan/get_snap_token']		= 'Backend/Pemesanan/get_snap_token';


//pengiriman
$route['pengiriman']						= 'Backend/Pengiriman';
$route['pengiriman/insert']					= 'Backend/Pengiriman/insert';
$route['pengiriman/update']					= 'Backend/Pengiriman/update';
$route['pengiriman/delete/(:num)']			= 'Backend/Pengiriman/delete/$1';
$route['pengiriman/get_data_pengiriman'] 	= 'Backend/Pengiriman/get_data_pengiriman';

//subsidi
$route['subsidi']					= 'Backend/Subsidi';
$route['subsidi/insert']			= 'Backend/Subsidi/insert';


//users
$route['users']						= 'Backend/Users';

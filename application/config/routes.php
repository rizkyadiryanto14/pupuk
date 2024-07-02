<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//auth

$route['login']			= 'Auth/logic_login';
$route['registrasi']	= 'Auth/registrasi';
$route['logout']		= 'Auth/logout';
$route['dashboard']		= 'Backend/Dashboard';

//pupuk
$route['pupuk']							= 'Backend/Pupuk';
$route['pupuk/insert']					= 'Backend/Pupuk/insert';
$route['pupuk/update']					= 'Backend/Pupuk/update';
$route['pupuk/detail_update/(:num)']	= 'Backend/Pupuk/detail_view/$1';
$route['pupuk/delete/(:num)']			= 'Backend/Pupuk/delete';
$route['pupuk/get_data_pupuk']			= 'Backend/Pupuk/get_data_pupuk';
$route['pupuk/update_view/(:num)']		= 'Backend/Pupuk/update_view/$1';

//pemesanan
$route['pemesanan']						= 'Backend/Pemesanan';
$route['pemesanan/insert']				= 'Backend/Pemesanan/insert';
$route['pemesanan/update']				= 'Backend/Pemesanan/update';
$route['pemesanan/delete/(:num)']		= 'Backend/Pemesanan/delete/$1';
$route['pemesanan/get_data_pemesanan'] 	= 'Backend/Pemesanan/get_data_pemesanan';
$route['pemesanan/api_users']			= 'Backend/Pemesanan/listing_users';
$route['pemesanan/api_pupuk']			= 'Backend/Pemesanan/listing_pupuk';
$route['pemesanan/get_snap_token']		= 'Backend/Pemesanan/get_snap_token';
$route['pemesanan/update_view/(:num)']	= 'Backend/Pemesanan/update_view/$1';
$route['pemesanan/midtrans_callback']	= 'Backend/Pemesanan/midtrans_callback';
$route['pemesanan/get_data_riwayat']	= 'Backend/Pemesanan/get_data_riwayat';


//pengiriman
$route['pengiriman']						= 'Backend/Pengiriman';
$route['pengiriman/insert']					= 'Backend/Pengiriman/insert';
$route['pengiriman/update']					= 'Backend/Pengiriman/update';
$route['pengiriman/delete/(:num)']			= 'Backend/Pengiriman/delete/$1';
$route['pengiriman/get_data_pengiriman'] 	= 'Backend/Pengiriman/get_data_pengiriman';

//subsidi
$route['subsidi']							= 'Backend/Subsidi';
$route['subsidi/insert']					= 'Backend/Subsidi/insert';
$route['subsidi/get_data_subsidi']			= 'Backend/Subsidi/get_data_subsidi';
$route['subsidi/daftar_penerima_subsidi'] 	= 'Backend/Subsidi/daftar_penerima_subsidi';
$route['subsidi/import']					= 'Backend/Subsidi/import';
$route['subsidi/listing_usaha']				= 'Backend/Subsidi/listing_usahadagang';

$route['home/get_data_subsidi']				= 'Backend/Subsidi/get_data_subsidi';


$route['usaha_dagang']						= 'Backend/Usaha_dagang';
$route['usaha_dagang/get_data_usahadagang'] = 'Backend/Usaha_dagang/get_data_usahadagang';
$route['usaha_dagang/insert']				= 'Backend/Usaha_dagang/insert';
$route['usaha_dagang/update_view/(:num)']	= 'Backend/Usaha_dagang/update_view/$1';
$route['usaha_dagang/update_logic/(:num)']	= 'Backend/Usaha_dagang/update_logic/$1';
$route['usaha_dagang/delete/(:num)']		= 'Backend/Usaha_dagang/delete/$1';


//users
$route['users']								= 'Backend/Users';
$route['users/get_data_users']				= 'Backend/Users/get_data_users';
$route['users/update_view/(:num)']			= 'Backend/Users/update_view/$1';
$route['users/update_logic/(:num)']			= 'Backend/Users/update_logic/$1';
$route['users/delete/(:num)']				= 'Backend/Users/delete/$1';
$route['users/ceknik']						= 'Backend/Users/ceknik';

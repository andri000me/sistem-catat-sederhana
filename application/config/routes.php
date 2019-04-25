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
$route['default_controller'] = 'admin';
$route['404_override'] = '';
//Produk
$route['produk'] = 'admin/data_produk';
$route['add_foto_produk/(:any)'] = 'admin/tambah_foto_produk/$1';
$route['add_produk'] = 'admin/produk';
$route['edit_produk/(:any)'] = 'admin/detail_produk/$1';
//Penjualan
$route['penjualan'] = 'admin/data_penjualan';
$route['add_penjualan'] = 'admin/penjualan';
$route['detail_penjualan/(:any)'] = 'transaction/detail_penjualan/$1';
$route['edit_penjualan/(:any)'] = 'transaction/edit_penjualan/$1';
$route['cetak/(:any)'] = 'admin/cetak_nota/$1';
//Kategori
$route['kategori_produk'] = 'admin/data_kategori_produk';
//Omset
$route['omset'] = 'admin/data_omset_user';
$route['translate_uri_dashes'] = FALSE;

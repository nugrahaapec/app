<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Login - logout Route
$routes->get('/', 'Auth\Auth::login');
$routes->post('Auth/loginProses', 'Auth\Auth::loginProses');
$routes->get('logout', 'Auth\Auth::logout');
// end route login

// route admin
$routes->get('Admin', 'Admin\Admin::index');
$routes->get('DataUser', 'Admin\Admin::data_user');
$routes->get('MPerangkat', 'Admin\Other::perangkat');
$routes->get('EditUser/(:any)', 'Admin\Admin::edit_user/$1');
$routes->get('Delete/(:any)', 'Admin\Admin::hapus/$1');
$routes->get('DataStore', 'Admin\Admin::data_store');
$routes->get('StatusPerangkat', 'Admin\Other::status');
$routes->get('JumlahPerangkat', 'Admin\Other::jumlah');
$routes->get('EditStore/(:any)', 'Admin\Admin::edit_store/$1');
$routes->get('Reset', 'Admin\Other::reset');
$routes->post('CreateUser', 'Admin\Admin::create');
$routes->post('CreateStore', 'Admin\Admin::createStore');
$routes->post('Upload', 'Admin\Admin::import');
$routes->post('UpdateBatch', 'Admin\Admin::updateBatch');
$routes->post('TambahPerangkat', 'Admin\Other::tambah');
$routes->put('Update/(:any)', 'Admin\Admin::update/$1');
$routes->put('UpdateStore/(:any)', 'Admin\Admin::updateStore/$1');
$routes->delete('HapusStore/(:any)', 'Admin\Admin::hapusStore/$1');
$routes->delete('HapusPerangkat/(:any)', 'Admin\Other::hapus/$1');
// end route admin


//user route
$routes->get('User', 'User\User::index');
$routes->get('Status', 'User\User::status');
$routes->get('Perangkat', 'User\User::perangkat');
$routes->get('PermintaanPerangkat', 'User\User::permintaan');
$routes->get('Other', 'User\User::cctv_network');
$routes->get('EditProfile/(:any)', 'User\User::EditProfile/$1');
$routes->get('PrintRpt_Maintenance/(:any)', 'User\User::PrintRpt/$1');
$routes->get('Destroy', 'Auth\Auth::Destroy');
$routes->get('FormMaintenance', 'User\User::FormMaintenance');
$routes->get('ReportFormMaintenance', 'User\User::ReportFormMaintenance');
$routes->get('Maintenance', 'User\User::Maintenance');
$routes->get('ReportPermintaan', 'User\User::ReportPermintaan');
$routes->get('Konfirmasi', 'User\User::ConfirmasiPerangkat');
$routes->get('PermintaanNewStore', 'User\User::newStore');
$routes->post('SavePermintaan', 'User\User::SavePermintaan');
$routes->post('SaveNewPermintaan', 'User\User::SaveNewPermintaan');
$routes->post('SavePerangkat', 'User\User::SavePerangkat');
$routes->post('SaveOther', 'User\User::SaveOther');
$routes->post('addStore', 'User\User::addStore');
$routes->post('SaveMaintenance/(:segment)', 'User\User::SaveMaintenance/$1');
$routes->post('SaveCctv/(:any)', 'User\User::SaveCctv/$1');
$routes->post('Conf/(:any)', 'User\User::Conf/$1');
$routes->post('Confirm/(:any)', 'User\User::Confirm/$1');
$routes->put('addStore', 'User\User::addStore');
$routes->put('UpdateProfile/(:segment)', 'User\User::UpdateProfile/$1');
// end route user

// Staff Route
$routes->get('Staff', 'Staff\Staff::index');
$routes->get('Proses', 'Staff\Staff::Proses');
$routes->get('NewProses', 'Staff\Staff::NewProses');
$routes->get('Laporan', 'Staff\Staff::laporan');
$routes->get('LaporanNew', 'Staff\Staff::newLaporan');
$routes->get('Print/(:any)', 'Staff\Staff::print/$1');
$routes->get('ProsesPermintaan/(:any)', 'Staff\Staff::ProsesPermintaan/$1');
$routes->get('NewProsesPermintaan/(:any)', 'Staff\Staff::NewProsesPermintaan/$1');
$routes->post('Cancel/(:any)', 'Staff\Staff::Cancel/$1');
$routes->post('ProsesPermintaanStore/(:any)', 'Staff\Staff::ProsesPermintaanStore/$1');
$routes->post('ProsesNewStore/(:any)', 'Staff\Staff::NewProsesPermintaanStore/$1');
$routes->get('cekSN', 'Staff\Staff::cekSN');
$routes->get('PrintDo', 'Staff\Staff::PrintDo');
$routes->get('NewPrint', 'Staff\Staff::NewPrint');
$routes->get('PrintNew/(:any)', 'Staff\Staff::PrintNew/$1');




// End Staff Route

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

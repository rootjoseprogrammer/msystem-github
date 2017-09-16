<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//RUTA PRINCIPAL DEL SISTEMA
Route::get('/', function () {
    return view('welcome');
});

//RUTA DE LOGUEO
Auth::routes();

//RUTA DE VISTAS POR USUARIO

Route::get('/home', 'HomeController@index');
Route::get('/history', 'HomeController@history');
Route::get('/show/{id}', 'HomeController@show');
Route::get('/settings', 'HomeController@settings');
//Route::put('/home/{id}', 'HomeController@update');
Route::put('/home/{id}',[
    'as' => 'home.update',
    'uses' => 'HomeController@update'
]);



//RUTAS ESPECIALES
Route::get('users/enable/{id}', 'UsersController@enable');
Route::get('users/disable/{id}', 'UsersController@disable');
Route::get('dashboard/requests', 'DashboardController@requests');
Route::get('dashboard/settings', 'DashboardController@settings');
Route::put('dashboard/maintenancesRequest/{id}',[
    'as' => 'dashboard.maintenancesRequest',
    'uses' => 'DashboardController@maintenancesRequest'
]);
Route::put('dashboard/updateAnswer/{id}',[
    'as' => 'dashboard.updateAnswer',
    'uses' => 'DashboardController@updateAnswer'
]);
Route::get('dashboard/endwork/{id}',[
    'as' => 'dashboard.endwork',
    'uses' => 'DashboardController@endWork'
]);
Route::get('dashboard/jobs',[
    'as' => 'dashboard.jobs',
    'uses' => 'DashboardController@jobs'
]);

Route::get('dashboard/destroy/{id}', 'DashboardController@destroy');

//RUTAS ESPECIALES
Route::get('mdashboard/requests', 'mDashboardController@requests');
Route::get('mdashboard/settings', 'mDashboardController@settings');
Route::get('mdashboard/computing',[
  'as' => 'mdashboard.computing',
  'uses' => 'mDashboardController@computing'
]);
Route::get('mdashboard/response/{id}',[
  'as' => 'mdashboard.response',
  'uses' => 'mDashboardController@response'
]);
Route::get('mdashboard/show/request/{id}',[
  'as' => 'mdashboard.show_request',
  'uses' => 'mDashboardController@showRequest'
]);
Route::put('mdashboard/computingResponse/{id}',[
  'as' => 'mdashboard.computingResponse',
  'uses' => 'mDashboardController@computingResponse'
]);

Route::get('mdashboard/destroy/{id}', 'mDashboardController@destroy');

Route::get('administration/settings', 'AdministrationsController@settings');
Route::put('administration/Userupdate/{id}',[
    'as' => 'administration.Userupdate',
    'uses' => 'AdministrationsController@Userupdate'
]);

Route::put('requests-maintenances/response/{id}', [
  'as' => 'requests-maintenances.response',
  'uses' => 'MaintenancesRequestsConstoller@response'
]);

//RUTA DE ACCIONES POR CONTROLLERS
Route::get('equipments/destroy/{id}', 'EquipmentsController@destroy');
Route::get('brands/destroy/{id}', 'BrandsController@destroy');
Route::get('drives/destroy/{id}', 'HardDrivesController@destroy');
Route::get('microprocessors/destroy/{id}', 'MicroprocessorsController@destroy');
Route::get('motherboards/destroy/{id}', 'MotherboardsController@destroy');
Route::get('netcards/destroy/{id}', 'NetCardsController@destroy');
Route::get('rams/destroy/{id}', 'RamsController@destroy');
Route::get('read-drivers/destroy/{id}', 'ReadDriversController@destroy');
Route::get('videos/destroy/{id}', 'VideosController@destroy');
Route::get('administration/destroy/{id}', 'AdministrationsController@destroy');
Route::get('maintenances/destroy/{id}', 'MaintenancesController@destroy');

//RUTA PARA LA SOLICTUD DE RECURSO A MANTENIMIENTO DESDE INFORMATICA
//Route::get('dashboard/maintenances/form', 'DashboardController@maintenancesRequestForm');

//RUTAS ESPECALES PARA ESPECIFICARELMOTIVO DE LA ACCION
Route::get('equipments/delete/{id}', 'EquipmentsController@delete');
Route::get('brands/delete/{id}', 'BrandsController@delete');
Route::get('drives/delete/{id}', 'HardDrivesController@delete');
Route::get('displays/delete/{id}', 'DisplaysController@delete');
Route::get('printers/delete/{id}', 'PrintersController@delete');
Route::get('microprocessors/delete/{id}', 'MicroprocessorsController@delete');
Route::get('motherboards/delete/{id}', 'MotherboardsController@delete');
Route::get('netcards/delete/{id}', 'NetCardsController@delete');
Route::get('rams/delete/{id}', 'RamsController@delete');
Route::get('read-drivers/delete/{id}', 'ReadDriversController@delete');
Route::get('videos/delete/{id}', 'VideosController@delete');
Route::get('maintenances/delete/{id}', 'MaintenancesController@delete');
Route::get('users/delete/{id}', 'UsersController@delete');


//RUTAS PARA REPORTES EN PDF
Route::get('reports/equipments', 'ReportsController@reportsEquipments');
Route::get('reports/displays', 'ReportsController@reportsDisplays');
Route::get('reports/printers', 'ReportsController@reportsPrinters');
Route::get('reports/drives', 'ReportsController@reportsDrives');
Route::get('reports/microprocessors', 'ReportsController@reportsMicro');
Route::get('reports/motherboards', 'ReportsController@reportsMother');
Route::get('reports/netcards', 'ReportsController@reportsNetCards');
Route::get('reports/rams', 'ReportsController@reportsRams');
Route::get('reports/read-drivers', 'ReportsController@reportsReadDrivers');
Route::get('reports/videos', 'ReportsController@reportsVideos');
Route::get('reports/maintenances', 'ReportsController@reportsMaintenance');
Route::get('reports/general', 'ReportsController@reportGeneral');
Route::get('reports', 'ReportsController@index');


//VISTAS Y SUS RESPECTIVOS CONTROLLERS
Route::resource('applications','ApplicationsController');
Route::resource('equipments','EquipmentsController');
Route::resource('brands','BrandsController');
Route::resource('drives','HardDrivesController');
Route::resource('microprocessors','MicroprocessorsController');
Route::resource('motherboards','MotherboardsController');
Route::resource('netcards','NetCardsController');
Route::resource('rams','RamsController');
Route::resource('read-drivers','ReadDriversController');
Route::resource('videos','VideosController');
Route::resource('administration','AdministrationsController');
Route::resource('dashboard', 'DashboardController');
Route::resource('mdashboard', 'mDashboardController');
Route::resource('maintenances', 'MaintenancesController');
Route::resource('users', 'UsersController');
Route::resource('inventories', 'InventoriesController');
Route::resource('records', 'RecordsController');
Route::resource('displays', 'DisplaysController');
Route::resource('printers', 'PrintersController');
Route::resource('requests-maintenances', 'MaintenancesRequestsConstoller');

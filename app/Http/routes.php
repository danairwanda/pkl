<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('login');
});
/*	| middleware default "WEB" : memeriksa Session CSRF, kernel HTTP, dll | */
// Route::group(['middleware' => 'web'], function (){
// 	/* | redirect ke halaman login | */
// 	Route::auth();
// 	Route::get('/', function (){
// 		return view('welcome');
// 	});
// });
// /* 	| url ini hanya bisa diakses oleh user yang sudah login | */
// Route::group(['middleware' => ['web','auth']], function (){
// 	Route::get('/home','HomeController@index');
// 	Route::get('/', function (){
// 		if (Auth::user()->admin == 1) {
// 			/*	| untuk user login : admin | */
// 			return view('admin_home');
// 		}else{
// 			/* | untuk user login : user biasa | */
// 			return view('user_home');
// 		}
// 	});
// });
/* | url/admin hanya bisa diakses oleh user yang sudah login sebagai admin | */
Route::get('admin', ['middleware' => ['web','auth','admin'], function (){
	return view('admin/admin_home');
}]);


Route::get('/admin', function (){
	return view('admin');
	});

Route::get('/operator', function (){
	return view('operator');
});


Route::group(['prefix' => 'api'], function()
{
	Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
	Route::post('authenticate', 'AuthenticateController@authenticate');
	Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
	
	Route::get('external/uker', 'ApiExternalController@getAllUker');
	Route::get('external/pegawai', 'ApiExternalController@getAllPegawai');


	// Route::get('agenda','AgendaController@index');
	Route::resource('coba', 'CobaController', array('except'=>array('create','edit')));
	Route::resource('agenda', 'AgendaController', array('except'=>array('create','edit')));
	Route::resource('detilAgenda', 'AgendaDetailController', array('except'=>array('create','edit')));
	Route::resource('barangInven', 'BarangInvenController', array('except'=>array('create','edit')));
	Route::resource('invenMasuk', 'InvenMasukController', array('except'=>array('create','edit')));
	Route::resource('invenStatus', 'InvenStatusController', array('except'=>array('create','edit')));
	Route::resource('namaForm', 'NamaFormController', array('except'=>array('create','edit')));
	Route::resource('gangguan', 'GangguanController', array('except'=>array('create','edit')));
	Route::resource('provider', 'ProviderController', array('except'=>array('create','edit')));
	Route::resource('penanganan', 'PenangananController', array('except'=>array('create','edit')));
	Route::resource('firewall', 'FirewallController', array('except'=>array('create','edit')));
	Route::resource('kondisi', 'KondisiAlatController', array('except'=>array('create','edit')));
	Route::resource('switchCore', 'SwitchCoreController', array('except'=>array('create','edit')));
	Route::resource('switchSub', 'SwitchSubController', array('except'=>array('create','edit')));
	Route::resource('merek', 'MerekAlatController', array('except'=>array('create','edit')));
	Route::resource('hub', 'HubController', array('except'=>array('create','edit')));
	Route::resource('accessPoint', 'AccessPointController', array('except'=>array('create','edit')));
	Route::resource('pddError', 'pddErrorController', array('except'=>array('create','edit')));
	Route::resource('pddBuffer', 'pddBufferController', array('except'=>array('create','edit')));
	//controller
	Route::get('agendaAll','AgendaController@getAll');
	Route::get('agendaAll', 'AgendaController@getAll');
	Route::get('detilAgendaAll', 'AgendaDetailController@getAll');
	Route::get('barangInvenAll', 'BarangInvenController@getAll');
	Route::get('invenMasukAll', 'InvenMasukController@getAll');
	Route::get('invenStatusAll', 'InvenStatusController@getAll');
	Route::get('namaFormAll', 'NamaFormController@getAll');
	Route::get('gangguanAll', 'GangguanController@getAll');
	Route::get('providerAll', 'ProviderController@getAll');
	Route::get('penangananAll', 'PenangananController@getAll');
	Route::get('firewallAll', 'FirewallController@getAll');
	Route::get('kondisiAll', 'KondisiAlatController@getAll');
	Route::get('switchCoreAll', 'SwitchCoreController@getAll');
	Route::get('switchSubAll', 'SwitchSubController@getAll');
	Route::get('merekAll', 'MerekAlatController@getAll');
	Route::get('hubAll', 'HubController@getAll');
	Route::get('accessPointAll', 'AccessPointController@getAll');
	Route::get('pddErrorAll', 'pddErrorController@getAll');
	Route::get('pddBufferAll', 'pddBufferController@getAll');

});


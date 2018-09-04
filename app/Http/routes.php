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

// Route::get('/', 'WelcomeController@index');

Route::get('/', 'HomeController@index');

// Modules
Route::get('/modules', 'ModulesController@index');
Route::get('/add_module', 'ModulesController@add_module');
Route::post('/insert_module', 'ModulesController@insert_module');
Route::get('/edit_module/{id}', 'ModulesController@edit_module');
Route::post('/update_module/{id}', 'ModulesController@update_module');

// Styles
Route::get('/styles', 'StylesController@index');
Route::get('/add_style', 'StylesController@add_style');
Route::post('/insert_style', 'StylesController@insert_style');
Route::get('/edit_style/{id}', 'StylesController@edit_style');
Route::post('/update_style/{id}', 'StylesController@update_style');

// Fabrics
Route::get('/fabrics', 'FabricsController@index');
Route::get('/add_fabric', 'FabricsController@add_fabric');
Route::post('/insert_fabric', 'FabricsController@insert_fabric');
Route::get('/edit_fabric/{id}', 'FabricsController@edit_fabric');
Route::post('/update_fabric/{id}', 'FabricsController@update_fabric');
Route::get('/refreshfabrics', 'FabricsController@refreshfabrics');

// MatAbbrev
Route::get('/matabbrevs', 'MatAbbrevController@index');
Route::get('/add_matabbrev', 'MatAbbrevController@add_matabbrev');
Route::post('/insert_matabbrev', 'MatAbbrevController@insert_matabbrev');
Route::get('/edit_matabbrev/{id}', 'MatAbbrevController@edit_matabbrev');
Route::post('/update_matabbrev/{id}', 'MatAbbrevController@update_matabbrev');

// Supplier
Route::get('/suppliers', 'SupplierController@index');
Route::get('/add_supplier', 'SupplierController@add_supplier');
Route::post('/insert_supplier', 'SupplierController@insert_supplier');
Route::get('/edit_supplier/{id}', 'SupplierController@edit_supplier');
Route::post('/update_supplier/{id}', 'SupplierController@update_supplier');

// WMS
Route::get('/wms', 'WMSController@index');
Route::get('/remove_nothu', 'WMSController@remove_nothu');
Route::get('/remove_hu', 'WMSController@remove_hu');
Route::get('/removed_nothu', 'WMSController@removed_nothu');
Route::get('/removed_hu', 'WMSController@removed_hu');
Route::get('/delete_nothu', 'WMSController@delete_nothu');
Route::get('/delete_hu', 'WMSController@delete_hu');
Route::post('/import_nothu', 'WMSController@postImportNOTHU');
Route::post('/import_hu', 'WMSController@postImportHU');

// Budget
Route::get('/budget', 'BudgetController@index');
Route::get('/budget_import', 'BudgetController@budget_import');
Route::post('/import_budget', 'ImportController@postImportBudget');
Route::get('/add_budget', 'BudgetController@add_budget');
Route::post('/insert_budget', 'BudgetController@insert_budget');
Route::get('/edit_budget/{id}', 'BudgetController@edit_budget');
Route::post('/update_budget/{id}', 'BudgetController@update_budget');

// FR_plan
Route::get('/fr_plan', 'FR_PlanController@index');
Route::get('/fr_plan_import', 'FR_PlanController@fr_plan_import');
Route::post('/import_fr_plan', 'ImportController@postImportFR_plan');
Route::get('/add_fr_plan', 'FR_PlanController@add_fr_plan');
Route::post('/insert_fr_plan', 'FR_PlanController@insert_fr_plan');
Route::get('/edit_fr_plan/{id}', 'FR_PlanController@edit_fr_plan');
Route::post('/update_fr_plan/{id}', 'FR_PlanController@update_fr_plan');

//settings
Route::get('/atila', 'AtilaController@index');
Route::get('/copy_cc_from_nav', 'AtilaController@copy_cc_from_nav');
Route::get('/truncate_local_cc', 'AtilaController@truncate_local_cc');
Route::get('/copy_cc_from_local', 'AtilaController@copy_cc_from_local');
Route::get('/delete_nav_cc', 'AtilaController@delete_nav_cc');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

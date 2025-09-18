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
Route::get('/upload_image/{id}', 'StylesController@upload_image');
Route::post('/upload_style_image/', 'ImportImageController@upload_style_image');

Route::get('/import_styles', 'ImportstyleController@index');
Route::post('/postImportStyle', 'ImportstyleController@postImportStyle');

// Styles extra
Route::get('/styles_extra', 'Styles_extraController@index');
Route::get('/add_style_extra', 'Styles_extraController@add_style');
Route::post('/insert_style_extra', 'Styles_extraController@insert_style');
Route::get('/edit_style_extra/{id}', 'Styles_extraController@edit_style');
Route::post('/update_style_extra/{id}', 'Styles_extraController@update_style');
Route::get('/upload_image_extra/{id}', 'Styles_extraController@upload_image');
Route::post('/upload_style_extra_image/', 'ImportImageController@upload_style_extra_image');


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

// Daily Budget
Route::get('daily_budget', 'ImportBudget@table');


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

// sanja
Route::get('/bbstatus', 'AtilaController@bbstatus');
Route::get('/edit_po_bbstatus/{pon}', 'AtilaController@edit_po_bbstatus');
Route::post('/update_bbstatus', 'AtilaController@update_bbstatus');
Route::get('/it_dezurstva', 'AtilaController@it_dezurstva');

// Machines
Route::get('/machines', 'machinesController@index');
Route::get('/transferg_k_get', 'machinesController@transferg_k_get');
Route::post('/transferg_k', 'machinesController@transferg_k');
Route::post('/transferg_k_post', 'machinesController@transferg_k_post');
Route::get('/transferg_k_delete/{os}', 'machinesController@transferg_k_delete');
Route::get('/transferk_g_get', 'machinesController@transferk_g_get');
Route::post('/transferk_g', 'machinesController@transferk_g');
Route::post('/transferk_g_post', 'machinesController@transferk_g_post');
Route::get('/transferk_g_delete/{os}', 'machinesController@transferk_g_delete');
Route::get('/machines_table', 'machinesController@machines_table');

// Box
Route::get('/box', 'boxController@index');
Route::get('/add_box', 'boxController@add_box');
Route::post('insert_box', 'boxController@insert_box');
Route::get('/edit_box/{id}', 'boxController@edit_box');
Route::post('/edit_box2', 'boxController@edit_box2');
Route::post('/update_box/{id}', 'boxController@update_box');
Route::post('/update_box2/{id}', 'boxController@update_box2');
Route::get('/box_table', 'boxController@table');
Route::post('box_search_by_style', 'boxController@box_search_by_style');
Route::post('box_search_by_style_2', 'boxController@box_search_by_style_2');
Route::get('/update_second_q_info', 'boxController@update_second_q_info');

// Import
Route::get('/import', 'ImportController@poststock_take');
Route::post('/postImportstock_take', 'ImportController@postImportstock_take');

Route::get('import_budget', 'ImportBudget@index');
Route::post('postImportBudget', 'ImportBudget@postImportBudget');

Route::get('close_po', 'AtilaController@close_po');
Route::post('close_po_post', 'ImportController@close_po_post');

// SAP EWM BIN TO LOCAION

Route::get('inventory_bintoloc', 'AtilaController@inventory_bintoloc');
Route::get('inventory_bintoloc_scan', 'AtilaController@inventory_bintoloc_scan');
Route::post('inventory_bintoloc_post', 'AtilaController@inventory_bintoloc_post');
Route::post('inventory_bintoloc_post_loc', 'AtilaController@inventory_bintoloc_post_loc');

// SAP Inventory
Route::get('/sap_inventory', 'sap_inventoryController@index_main');
Route::get('/inventory', 'sap_inventoryController@index');
Route::get('/inventory_scan', 'sap_inventoryController@index_scan');
Route::get('/import_inventory', 'sap_inventoryController@import');
// Route::post('import_post', 'sap_inventoryController@import_post');
Route::post('import_post', 'ImportController@import_post');

Route::get('/sap_inventory_scan', 'sap_inventoryController@index_main_scan');

Route::post('insert_temp_su', 'sap_inventoryController@insert_temp_su');
Route::post('update_su/{id}', 'sap_inventoryController@update_su');
Route::get('/inventory_stop', 'sap_inventoryController@inventory_stop');
Route::get('/inventory_cancel', 'sap_inventoryController@inventory_cancel');

// SAP Inventory WH
Route::get('/inventory_wh', 'sap_inventoryController_wh@index');
Route::get('/inventory_scan_wh', 'sap_inventoryController_wh@index_scan');
Route::get('/import_inventory_wh', 'sap_inventoryController_wh@import');
// Route::post('import_post_wh', 'sap_inventoryController_wh@import_post');
Route::post('import_post_wh', 'ImportController@import_post_wh');

Route::post('insert_temp_su_wh', 'sap_inventoryController_wh@insert_temp_su');
Route::post('update_su_wh/{id}', 'sap_inventoryController_wh@update_su');
Route::get('/inventory_stop_wh', 'sap_inventoryController_wh@inventory_stop');
Route::get('/inventory_cancel_wh', 'sap_inventoryController_wh@inventory_cancel');

// SAP Inventory CUT
Route::get('/inventory_cut', 'sap_inventoryController_cut@index');
Route::get('/inventory_scan_cut', 'sap_inventoryController_cut@index_scan');
Route::get('/import_inventory_cut', 'sap_inventoryController_cut@import');
// Route::post('import_post_cut', 'sap_inventoryController_cut@import_post');
Route::post('import_post_cut', 'ImportController@import_post_cut');

Route::post('insert_temp_su_cut', 'sap_inventoryController_cut@insert_temp_su');
Route::post('update_su_cut/{id}', 'sap_inventoryController_cut@update_su');
Route::get('/inventory_stop_cut', 'sap_inventoryController_cut@inventory_stop');
Route::get('/inventory_cancel_cut', 'sap_inventoryController_cut@inventory_cancel');

// SAP Inventory SENTA
Route::get('/inventory_senta', 'sap_inventoryController_senta@index');
Route::get('/inventory_scan_senta', 'sap_inventoryController_senta@index_scan');
Route::get('/import_inventory_senta', 'sap_inventoryController_senta@import');
// Route::post('import_post_senta', 'sap_inventoryController_senta@import_post');
Route::post('import_post_senta', 'ImportController@import_post_senta');

Route::post('insert_temp_su_senta', 'sap_inventoryController_senta@insert_temp_su');
Route::post('update_su_senta/{id}', 'sap_inventoryController_senta@update_su');
Route::get('/inventory_stop_senta', 'sap_inventoryController_senta@inventory_stop');
Route::get('/inventory_cancel_senta', 'sap_inventoryController_senta@inventory_cancel');

// SAP Inventory P
Route::get('/inventory_p', 'sap_inventoryController_p@index');
Route::get('/inventory_scan_p', 'sap_inventoryController_p@index_scan');
Route::get('/import_inventory_p', 'sap_inventoryController_p@import');
// Route::post('import_post_p', 'sap_inventoryController_p@import_post');
Route::post('import_post_p', 'ImportController@import_post_p');

Route::post('insert_temp_su_p', 'sap_inventoryController_p@insert_temp_su');
Route::post('update_su_p/{id}', 'sap_inventoryController_p@update_su');
Route::get('/inventory_stop_p', 'sap_inventoryController_p@inventory_stop');
Route::get('/inventory_cancel_p/', 'sap_inventoryController_p@inventory_cancel');

// SAP Inventory Pal
Route::get('/inventory_pal', 'sap_inventoryController_pal@index');
Route::get('/inventory_scan_pal', 'sap_inventoryController_pal@index_scan');
Route::get('/import_inventory_pal', 'sap_inventoryController_pal@import');
// Route::post('import_post_pal', 'sap_inventoryController_pal@import_post');
Route::post('import_post_pal', 'ImportController@import_post_pal');

Route::post('insert_temp_su_pal', 'sap_inventoryController_pal@insert_temp_su');
Route::post('update_su_pal/{id}', 'sap_inventoryController_pal@update_su');
Route::get('/inventory_stop_pal', 'sap_inventoryController_pal@inventory_stop');
Route::get('/inventory_cancel_pal/', 'sap_inventoryController_pal@inventory_cancel');

// SAP Inventory BB
Route::get('/inventory_bb', 'sap_inventoryController_bb@index');
Route::get('/inventory_scan_bb', 'sap_inventoryController_bb@index_scan');
Route::get('/import_inventory_bb', 'sap_inventoryController_bb@import');
// Route::post('import_post_bb', 'sap_inventoryController_bb@import_post');
Route::post('import_post_bb', 'ImportController@import_post_bb');

Route::post('insert_temp_su_bb', 'sap_inventoryController_bb@insert_temp_su');
Route::post('update_su_bb/{id}', 'sap_inventoryController_bb@update_su');
Route::get('/inventory_stop_bb', 'sap_inventoryController_bb@inventory_stop');
Route::get('/inventory_cancel_bb', 'sap_inventoryController_bb@inventory_cancel');

// SAP Inventory BB 2 
Route::get('/inventory_bb_2', 'sap_inventoryController_bb_2@index');
Route::get('/inventory_scan_bb_2', 'sap_inventoryController_bb_2@index_scan');
Route::get('/import_inventory_bb_2', 'sap_inventoryController_bb_2@import');
// Route::post('import_post_bb_2', 'sap_inventoryController_bb_2@import_post');
Route::post('import_post_bb_2', 'ImportController@import_post_bb_2');

Route::post('insert_temp_su_bb_2', 'sap_inventoryController_bb_2@insert_temp_su');
Route::post('update_su_bb_2/{id}', 'sap_inventoryController_bb_2@update_su');
Route::get('/inventory_stop_bb_2', 'sap_inventoryController_bb_2@inventory_stop');
Route::get('/inventory_cancel_bb_2', 'sap_inventoryController_bb_2@inventory_cancel');

// SAP Inventory BB 3 
Route::get('/inventory_bb_3', 'sap_inventoryController_bb_3@index');
Route::get('/inventory_scan_bb_3', 'sap_inventoryController_bb_3@index_scan');
Route::get('/import_inventory_bb_3', 'sap_inventoryController_bb_3@import');
// Route::post('import_post_bb_3', 'sap_inventoryController_bb_3@import_post');
Route::post('import_post_bb_3', 'ImportController@import_post_bb_3');

Route::post('insert_temp_su_bb_3', 'sap_inventoryController_bb_3@insert_temp_su');
Route::post('update_su_bb_3/{id}', 'sap_inventoryController_bb_3@update_su');
Route::get('/inventory_stop_bb_3', 'sap_inventoryController_bb_3@inventory_stop');
Route::get('/inventory_cancel_bb_3', 'sap_inventoryController_bb_3@inventory_cancel');

// SAP Inventory BB 4 
Route::get('/inventory_bb_4', 'sap_inventoryController_bb_4@index');
Route::get('/inventory_scan_bb_4', 'sap_inventoryController_bb_4@index_scan');
Route::get('/import_inventory_bb_4', 'sap_inventoryController_bb_4@import');
// Route::post('import_post_bb_4', 'sap_inventoryController_bb_4@import_post');
Route::post('import_post_bb_4', 'ImportController@import_post_bb_4');

Route::post('insert_temp_su_bb_4', 'sap_inventoryController_bb_4@insert_temp_su');
Route::post('update_su_bb_4/{id}', 'sap_inventoryController_bb_4@update_su');
Route::get('/inventory_stop_bb_4', 'sap_inventoryController_bb_4@inventory_stop');
Route::get('/inventory_cancel_bb_4', 'sap_inventoryController_bb_4@inventory_cancel');

// SAP Inventory log
Route::get('/inventory_log', 'sap_inventoryController_log@index');
Route::get('/inventory_scan_log', 'sap_inventoryController_log@index_scan');
Route::get('/import_inventory_log', 'sap_inventoryController_log@import');
// Route::post('import_post_log', 'sap_inventoryController_log@import_post');
Route::post('import_post_log', 'ImportController@import_post_log');

Route::post('insert_temp_su_log', 'sap_inventoryController_log@insert_temp_su');
Route::post('update_su_log/{id}', 'sap_inventoryController_log@update_su');
Route::get('/inventory_stop_log', 'sap_inventoryController_log@inventory_stop');
Route::get('/inventory_cancel_log', 'sap_inventoryController_log@inventory_cancel');

Route::get('/inventory_issue/{id}', 'sap_inventoryController_log@inventory_issue');
Route::post('inventory_issue_next', 'sap_inventoryController_log@inventory_issue_next');
Route::post('inventory_issue_qty', 'sap_inventoryController_log@inventory_issue_qty');

// Insepction rolls
Route::get('inspection_rolls', 'inspection_roll_controller@index');
// Route::get('inspection_rolls', 'inspection_roll_controller@index_scan');

Route::post('import_inspection_rolls', 'ImportController@import_inspection_rolls');

Route::get('inspection_rolls_scan_r', 'inspection_roll_controller@index_scan_r');
Route::post('insert_inspection_roll_r', 'inspection_roll_controller@insert_inspection_roll_r');
// Route::get('inspection_rolls_scan', 'inspection_roll_controller@index_scan');
Route::post('insert_inspection_roll', 'inspection_roll_controller@insert_inspection_roll');
Route::post('confirm_inspection_roll', 'inspection_roll_controller@confirm_inspection_roll');
Route::get('remove_inspection_roll/{id}/{session}', 'inspection_roll_controller@remove_inspection_roll');
Route::get('log_out_i', 'inspection_roll_controller@log_out_i');
Route::get('/import_inspection_roll', 'sap_inventoryController_wh@import');

Route::get('inspection_rolls_history', 'inspection_roll_controller@inspection_rolls_history');

// Relaxation rolls
Route::get('relaxation_rolls', 'relaxation_roll_controller@index');
// Route::get('relaxation_rolls', 'relaxation_roll_controller@index_scan');

Route::post('import_relaxation_rolls', 'ImportController@import_relaxation_rolls');

Route::get('relaxation_rolls_scan_r', 'relaxation_roll_controller@index_scan_r');
Route::post('insert_relaxation_roll_r', 'relaxation_roll_controller@insert_relaxation_roll_r');
// Route::get('relaxation_rolls_scan', 'relaxation_roll_controller@index_scan');
Route::post('insert_relaxation_roll', 'relaxation_roll_controller@insert_relaxation_roll');
Route::post('confirm_relaxation_roll', 'relaxation_roll_controller@confirm_relaxation_roll');
Route::get('remove_relaxation_roll/{id}/{session}', 'relaxation_roll_controller@remove_relaxation_roll');
Route::get('log_out_r', 'relaxation_roll_controller@log_out_r');
Route::get('/import_relaxation_roll', 'sap_inventoryController_wh@import');

Route::get('relaxation_rolls_history', 'relaxation_roll_controller@relaxation_rolls_history');

// Paspul rolls
Route::get('paspul_rolls_scan_r', 'paspul_roll_controller@index_scan_r');
Route::post('insert_paspul_roll', 'paspul_roll_controller@insert_paspul_roll');


// s_quality
Route::get('second_q', 'second_q@index');
// Route::post('import_post_second_q', 'second_q@import_post_second_q');

// SAP Materials
Route::get('sap_materials', 'sap_materialsController@index');
Route::get('sap_spare', 'sap_materialsController@sap_spare');
Route::get('sap_cons', 'sap_materialsController@sap_cons');
Route::get('sap_spare_all', 'sap_materialsController@sap_spare_all');
Route::get('sap_cons_all', 'sap_materialsController@sap_cons_all');
Route::get('sap_import', 'sap_materialsController@sap_import');
Route::post('sap_import_post_mm', 'importController@sap_import_post_mm');
Route::post('sap_import_post_s', 'importController@sap_import_post_s');
Route::post('sap_import_post_u', 'importController@sap_import_post_u');

Route::post('postImportDoneSU', 'ImportController@postImportDoneSU');

Route::get('sap_mech', 'sap_materialsController@sap_mech');


// net_weigth
Route::get('net_weight', 'net_weightController@index');
Route::get('net_weight_save', 'net_weightController@save_in_table');
Route::get('net_weight_int', 'net_weightController@index_int');


Route::get('lockers', 'lockersController@lockers');
Route::get('lockers_scan', 'lockersController@lockers_scan');
Route::post('locker_scan_rnumber', 'lockersController@locker_scan_rnumber');
Route::post('locker_scan_locker', 'lockersController@locker_scan_locker');

Route::get('lockers_add', 'lockersController@lockers_add');
Route::post('lockers_add_post', 'lockersController@lockers_add_post');

Route::get('locker_edit/{id}', 'lockersController@locker_edit');
Route::post('locker_edit_post', 'lockersController@locker_edit_post');

Route::get('remove_employee/{id}', 'lockersController@remove_employee');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::any('getstdata', function() {
	$term = Input::get('term');

	$data = DB::connection('sqlsrv3')->select(DB::raw("SELECT distinct(REPLACE(substring(fg,0,9),' ','' )) as st FROM [trebovanje].[dbo].[sap_coois] WHERE fg like '".$term."%'"));
	// var_dump($data);
	foreach ($data as $v) {
		$retun_array[] = array('value' => $v->st);
	}
return Response::json($retun_array);
});

Route::any('getcodata', function() {
	$term = Input::get('term');

	$data = DB::connection('sqlsrv3')->select(DB::raw("SELECT distinct(REPLACE(substring(fg,10,4),' ','' )) as co FROM [trebovanje].[dbo].[sap_coois] WHERE substring(fg,10,4) like '%".$term."%'"));
	// var_dump($data);
	foreach ($data as $v) {
		$retun_array[] = array('value' => $v->co);
	}
return Response::json($retun_array);
});

Route::any('getsidata', function() {
	$term = Input::get('term');

	$data = DB::connection('sqlsrv3')->select(DB::raw("SELECT distinct(REPLACE(substring(fg,14,5),' ','' )) as si FROM [trebovanje].[dbo].[sap_coois] WHERE substring(fg,14,5) like '%".$term."%'"));
	// var_dump($data);
	foreach ($data as $v) {
		$retun_array[] = array('value' => $v->si);
	}
return Response::json($retun_array);
});


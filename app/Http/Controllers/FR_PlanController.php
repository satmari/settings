<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Requests;
use Illuminate\Http\Request; // for uptdate
// use Request; // for import

use App\FR_Plan;
use DB;

use Session;

class FR_PlanController extends Controller {

	public function index()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM fr_plan ORDER BY id desc"));
		return view('FR_Plan.index', compact('data'));
	}

	public function fr_plan_import()
	{
		//
		// dd("Testss");
		return view('FR_Plan.fr_plan_import');
	}

	public function add_fr_plan () {
		//
		return view('FR_Plan.add_fr_plan');
	}

	public function insert_fr_plan (Request $request) {
		
		//
		$this->validate($request, [
			// 'plan_key' => 'required', 
			'module'=> 'required', 
			'order'=> 'required',
			'sku' => 'required',
			'plan_date' => 'required',
			'qty' => 'required',
			
		]);

		$input = $request->all();

		try {
			$table = new FR_Plan;

			// $table->plan_key = $input['plan_key'];
			$table->plan_key = $input['module']." ".$input['order']." ".$input['sku']." ".$input['plan_date'];
			$table->module = $input['module'];
			$table->order = $input['order'];
			$table->sku = $input['sku'];
			$table->plan_date = $input['plan_date'];
			$table->qty = intval($input['qty']);
												
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in fr_plan table, probably plan key alredy exist in table.";
			return view('FR_Plan.error',compact('msg'));
		}

		return Redirect::to('/fr_plan');
	}

	public function edit_fr_plan ($id) {
		
		//
		$data = FR_Plan::findOrFail($id);		
		return view('FR_Plan.edit_fr_plan', compact('data'));
	}

	public function update_fr_plan ($id, Request $request) {

		//
		$this->validate($request, [
			// 'plan_key' => 'required', 
			// 'module'=> 'required', 
			// 'order'=> 'required',
			// 'sku' => 'required',
			// 'plan_date' => 'required',
			'qty' => 'required',
			
		]);
		$input = $request->all();

		$table = FR_Plan::findOrFail($id);

		try {

			// $table->plan_key = $input['plan_key'];
			$table->plan_key = $input['module']." ".$input['order']." ".$input['sku']." ".$input['plan_date'];
			$table->module = $input['module'];
			$table->order = $input['order'];
			$table->sku = $input['sku'];
			$table->plan_date = $input['plan_date'];
			$table->qty = intval($input['qty']);
			
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in fr_plan table, probably plan key alredy exist in table.";
			return view('FR_Plan.error',compact('msg'));
		}

		return Redirect::to('/fr_plan');
	}



}

<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Requests;
use Illuminate\Http\Request; // for uptdate
// use Request; // for import

use App\Budget;
use DB;

use Session;

class BudgetController extends Controller {


	public function index()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM budgets ORDER BY ymw desc"));
		return view('Budget.index', compact('data'));
	}

	public function budget_import()
	{
		//
		// dd("Testss");
		return view('Budget.budget_import');
	}

	

	public function add_budget () {
		//
		return view('Budget.add_budget');
	}

	public function insert_budget (Request $request) {
		
		//
		$this->validate($request, [
			'ymw' => 'required', 
			'year'=> 'required', 
			'month'=> 'required',
			'week' => 'required',
			'worked_days' => 'required',
			'new_modules' => 'required',
			'modules_total' => 'required',
			'operators' => 'required',
			'available_minutes' => 'required',
			'absenteeism' => 'required',
			'turnover_gap' => 'required',
			'available_minutes_abs_gap' => 'required',
			'budget_eff' => 'required',
			'worked_minutes' => 'required',
			'pieces_produced' => 'required',
			'prod_cap_new_modules' => 'required',
			'prod_cap_flash' => 'required',
			'prod_cap_fashion' => 'required',
			'prod_cap_basic' => 'required',
			'eff_new_modules' => 'required',
			'eff_flash' => 'required',
			'eff_fashion' => 'required',
			'eff_basic' => 'required',
			'first_work_day' => 'required',
		]);

		$input = $request->all();

		try {
			$table = new Budget;

			$table->ymw = $input['ymw'];
			$table->year = $input['year'];
			$table->month = $input['month'];
			$table->week = $input['week'];
			$table->worked_days = $input['worked_days'];
			$table->new_modules = $input['new_modules'];
			$table->modules_total = $input['modules_total'];
			$table->operators = $input['operators'];
			$table->available_minutes = $input['available_minutes'];
			$table->absenteeism = $input['absenteeism']/100;
			$table->turnover_gap = $input['turnover_gap']/100;
			$table->available_minutes_abs_gap = $input['available_minutes_abs_gap'];
			$table->budget_eff = $input['budget_eff']/100;
			$table->worked_minutes = $input['worked_minutes'];
			$table->pieces_produced = $input['pieces_produced'];
			$table->prod_cap_new_modules = $input['prod_cap_new_modules']/100;
			$table->prod_cap_flash = $input['prod_cap_flash']/100;
			$table->prod_cap_fashion = $input['prod_cap_fashion']/100;
			$table->prod_cap_basic = $input['prod_cap_basic']/100;
			$table->eff_new_modules = $input['eff_new_modules']/100;
			$table->eff_flash = $input['eff_flash']/100;
			$table->eff_fashion = $input['eff_fashion']/100;
			$table->eff_basic = $input['eff_basic']/100;
			//?
			$table->first_work_day = $input['first_work_day'];
									
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in budget table";
			return view('Budget.error',compact('msg'));
		}

		return Redirect::to('/budget');
	}

	public function edit_budget ($id) {
		
		//
		$data = Budget::findOrFail($id);		
		return view('Budget.edit_budget', compact('data'));
	}

	public function update_budget ($id, Request $request) {

		//
		$this->validate($request, [
			'ymw' => 'required', 
			'year'=> 'required', 
			'month'=> 'required',
			'week' => 'required',
			'worked_days' => 'required',
			'new_modules' => 'required',
			'modules_total' => 'required',
			'operators' => 'required',
			'available_minutes' => 'required',
			'absenteeism' => 'required',
			'turnover_gap' => 'required',
			'available_minutes_abs_gap' => 'required',
			'budget_eff' => 'required',
			'worked_minutes' => 'required',
			'pieces_produced' => 'required',
			'prod_cap_new_modules' => 'required',
			'prod_cap_flash' => 'required',
			'prod_cap_fashion' => 'required',
			'prod_cap_basic' => 'required',
			'eff_new_modules' => 'required',
			'eff_flash' => 'required',
			'eff_fashion' => 'required',
			'eff_basic' => 'required',
			'first_work_day' => 'required',
		]);
		$input = $request->all();

		$table = Budget::findOrFail($id);

		try {

			$table->ymw = $input['ymw'];
			$table->year = $input['year'];
			$table->month = $input['month'];
			$table->week = $input['week'];
			$table->worked_days = $input['worked_days'];
			$table->new_modules = $input['new_modules'];
			$table->modules_total = $input['modules_total'];
			$table->operators = $input['operators'];
			$table->available_minutes = $input['available_minutes'];
			$table->absenteeism = $input['absenteeism']/100;
			$table->turnover_gap = $input['turnover_gap']/100;
			$table->available_minutes_abs_gap = $input['available_minutes_abs_gap'];
			$table->budget_eff = $input['budget_eff']/100;
			$table->worked_minutes = $input['worked_minutes'];
			$table->pieces_produced = $input['pieces_produced'];
			$table->prod_cap_new_modules = $input['prod_cap_new_modules']/100;
			$table->prod_cap_flash = $input['prod_cap_flash']/100;
			$table->prod_cap_fashion = $input['prod_cap_fashion']/100;
			$table->prod_cap_basic = $input['prod_cap_basic']/100;
			$table->eff_new_modules = $input['eff_new_modules']/100;
			$table->eff_flash = $input['eff_flash']/100;
			$table->eff_fashion = $input['eff_fashion']/100;
			$table->eff_basic = $input['eff_basic']/100;
			//?
			$table->first_work_day = $input['first_work_day'];
			
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in budget table";
			return view('Budget.error',compact('msg'));
		}

		return Redirect::to('/budget');
	}

	
}

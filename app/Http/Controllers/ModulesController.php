<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Modules;
use DB;

use Session;

class ModulesController extends Controller {

	public function index()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM modules ORDER BY sort_order asc"));
		return view('Modules.index', compact('data'));
	}

	public function add_module () {
		//
		return view('Modules.add_module');
	}

	public function insert_module (Request $request) {
		
		//
		$this->validate($request, ['module' => 'required' ,'sort_order' => 'required','row' => 'required','column_group' => 'required','sector' => 'required','workstudy' => 'required', 'line_leader' => 'required', 'team' => 'required']);
		// $this->validate($request, ['module' => 'required']);
		$input = $request->all();

		// dd($input['module']);

		try {
			$table = new Modules;

			$table->module = $input['module'];
			$table->sort_order = $input['sort_order'];
			$table->row = $input['row'];
			$table->column_group = $input['column_group'];
			$table->sector = $input['sector'];
			$table->workstudy = $input['workstudy'];
			$table->line_leader = $input['line_leader'];
			$table->team = $input['team'];
			$table->linekey = $input['module']."_".$input['team'];
			
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in modules table";
			return view('Modules.error',compact('msg'));
		}

		return Redirect::to('/modules');
	}

	public function edit_module ($id) {
		
		//
		$data = Modules::findOrFail($id);		
		return view('Modules.edit_module', compact('data'));
	}

	public function update_module ($id, Request $request) {

		//
		$this->validate($request, ['module' => 'required' ,'sort_order' => 'required','row' => 'required','column_group' => 'required','sector' => 'required','workstudy' => 'required', 'line_leader' => 'required', 'team' => 'required']);
		// $this->validate($request, ['module' => 'required']);
		$input = $request->all();

		$table = Modules::findOrFail($id);

		try {

			$table->module = $input['module'];
			$table->sort_order = $input['sort_order'];
			$table->row = $input['row'];
			$table->column_group = $input['column_group'];
			$table->sector = $input['sector'];
			$table->workstudy = $input['workstudy'];
			$table->line_leader = $input['line_leader'];
			$table->team = $input['team'];
			$table->linekey = $input['module']."_".$input['team'];
			
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in modules table";
			return view('Modules.error',compact('msg'));
		}

		return Redirect::to('/modules');
	}

	
}

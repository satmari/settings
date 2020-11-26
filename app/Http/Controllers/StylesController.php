<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Styles;
use DB;

use Session;

class StylesController extends Controller {

	public function index()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM styles ORDER BY id asc"));
		return view('Styles.index', compact('data'));
	}

	public function add_style () {
		//
		return view('Styles.add_style');
	}

	public function insert_style (Request $request) {
		
		//
		$this->validate($request, ['style' => 'required' ]);
		$input = $request->all();

		// dd($input['style']);

		try {
			$table = new Styles;

			$table->style = $input['style'];
			$table->brand = $input['brand'];
			$table->cutting_smv = $input['cutting_smv'];
			$table->cluster = $input['cluster'];
			$table->order_type = $input['order_type'];
			
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in style table";
			return view('Styles.error',compact('msg'));
		}

		return Redirect::to('/styles');
	}

	public function edit_style ($id) {
		
		//
		$data = Styles::findOrFail($id);		
		return view('Styles.edit_style', compact('data'));
	}

	public function update_style ($id, Request $request) {

		//
		$this->validate($request, ['style' => 'required' ]);
		$input = $request->all();

		$table = Styles::findOrFail($id);

		try {

			$table->style = $input['style'];
			$table->brand = $input['brand'];
			$table->cutting_smv = $input['cutting_smv'];
			$table->cluster = $input['cluster'];
			$table->order_type = $input['order_type'];
			
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in style table";
			return view('Styles.error',compact('msg'));
		}

		return Redirect::to('/styles');
	}

	public function upload_image($id, Request $request){

		return view('Styles.upload_image', compact('id'));	
	}



}

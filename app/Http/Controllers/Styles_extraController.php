<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Styles_extra;
use DB;

use Session;

class Styles_extraController extends Controller {

	public function index()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM styles_extras ORDER BY id asc"));
		return view('Styles_extra.index', compact('data'));
	}

	public function add_style () {
		//
		return view('Styles_extra.add_style');
	}

	public function insert_style (Request $request) {
		
		//
		$this->validate($request, ['style_extra' => 'required' ]);
		$input = $request->all();

		// dd($input['style']);

		// try {
			$table = new Styles_extra;

			$table->style_extra = $input['style_extra'];
			$table->style = $input['style'];
			$table->color = $input['color'];
			$table->size = $input['size'];

			// $table->brand = $input['brand'];
			// $table->cutting_smv = $input['cutting_smv'];
			// $table->cluster = $input['cluster'];
			// $table->order_type = $input['order_type'];
			
			$table->save();
		// }
		// catch (\Illuminate\Database\QueryException $e) {
		// 	$msg = "Problem to save in style_extra table";
		// 	return view('Styles_extra.error',compact('msg'));
		// }

		return Redirect::to('/styles_extra');
	}

	public function edit_style ($id) {
		
		//
		$data = Styles_extra::findOrFail($id);		
		return view('Styles_extra.edit_style', compact('data'));
	}

	public function update_style ($id, Request $request) {

		//
		$this->validate($request, ['style_extra' => 'required' ]);
		$input = $request->all();

		$table = Styles_extra::findOrFail($id);

		try {

			$table->style_extra = $input['style_extra'];
			$table->style = $input['style'];
			$table->color = $input['color'];
			$table->size = $input['size'];

			// $table->brand = $input['brand'];
			// $table->cutting_smv = $input['cutting_smv'];
			// $table->cluster = $input['cluster'];
			// $table->order_type = $input['order_type'];
			
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in style_extra table";
			return view('Styles_extra.error',compact('msg'));
		}

		return Redirect::to('/styles_extra');
	}

	public function upload_image($id, Request $request){

		return view('Styles_extra.upload_image', compact('id'));	
	}



}

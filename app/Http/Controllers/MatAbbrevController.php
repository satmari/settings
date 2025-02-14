<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\MatAbbrev;
use DB;

use Session;


class MatAbbrevController extends Controller {

	public function index()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM mat_abbrevs ORDER BY id asc"));
		return view('MatAbbrevs.index', compact('data'));
	}

	public function add_matabbrev () {
		//
		return view('MatAbbrevs.add_matabbrev');
	}

	public function insert_matabbrev (Request $request) {
		
		//
		$this->validate($request, ['abbreviation' => 'required']);
		$input = $request->all();

		// dd($input['abbreviation']);

		try {
			$table = new MatAbbrev;

			$table->abbreviation = $input['abbreviation'];
			$table->description = $input['description'];
			$table->description_en = $input['description_en'];
			$table->description_rs = $input['description_rs'];
						
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in MatAbbrev table";
			return view('MatAbbrevs.error',compact('msg'));
		}

		return Redirect::to('/matabbrevs');
	}

	public function edit_matabbrev ($id) {
		
		//
		$data = MatAbbrev::findOrFail($id);		
		return view('MatAbbrevs.edit_matabbrev', compact('data'));
	}

	public function update_matabbrev ($id, Request $request) {

		//
		$this->validate($request, ['abbreviation' => 'required']);
		$input = $request->all();

		$table = MatAbbrev::findOrFail($id);

		try {

			$table->abbreviation = $input['abbreviation'];
			$table->description = $input['description'];
			$table->description_en = $input['description_en'];
			$table->description_rs = $input['description_rs'];
			
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in MatAbbrev table";
			return view('MatAbbrevs.error',compact('msg'));
		}

		return Redirect::to('/matabbrevs');
	}

}

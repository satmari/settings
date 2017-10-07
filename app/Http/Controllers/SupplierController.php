<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Supplier;
use DB;

use Session;

class SupplierController extends Controller {

	public function index()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM suppliers ORDER BY id asc"));
		return view('Suppliers.index', compact('data'));
	}

	public function add_supplier () {
		//
		return view('Suppliers.add_supplier');
	}

	public function insert_supplier (Request $request) {
		
		//
		$this->validate($request, ['supplier' => 'required']);
		$input = $request->all();

		try {
			$table = new Supplier;

			$table->supplier = $input['supplier'];
									
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in suppliers table";
			return view('Suppliers.error',compact('msg'));
		}

		return Redirect::to('/suppliers');
	}

	public function edit_supplier ($id) {
		
		//
		$data = Supplier::findOrFail($id);		
		return view('Suppliers.edit_supplier', compact('data'));
	}

	public function update_supplier ($id, Request $request) {

		//
		$this->validate($request, ['supplier' => 'required']);
		$input = $request->all();

		$table = Supplier::findOrFail($id);

		try {

			$table->supplier = $input['supplier'];
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in supplier table";
			return view('Suppliers.error',compact('msg'));
		}

		return Redirect::to('/suppliers');
	}

}

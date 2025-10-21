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
			$table->paspul = $input['paspul'];
			$table->material_2nd = $input['material_2nd'];
			$table->bonding = $input['bonding'];
			$table->preproduction = $input['preproduction'];
			
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
			$table->fg_family = $input['fg_family'];
			$table->spreading_method = $input['spreading_method'];
			$table->standard_bb_qty = $input['standard_bb_qty'];
			$table->pad_print = $input['pad_print'];
			$table->bansek = $input['bansek'];
			$table->adeziv = $input['adeziv'];
			$table->status = $input['status'];
			$table->paspul = $input['paspul'];
			$table->material_2nd = $input['material_2nd'];
			$table->bonding = $input['bonding'];
			$table->preproduction = $input['preproduction'];
			
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


	public function update_status_for_styles () {

		$styles = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM styles ORDER BY id asc"));

		foreach ($styles as $st) {
			

			$open_po = DB::connection('sqlsrv6')->select(DB::raw("SELECT 
				      *
				FROM [posummary].[dbo].[pro]
				WHERE style = '".$st->style."'
				AND status_int = 'Open'
				 "));
			// dd($open_po);

			if (isset($open_po[0]->style)) {
				// dd($open_po[0]->style);

				$table = Styles::where('style', $st->style)->firstOrFail();
				$table->status = 'ACTIVE';
				$table->save();

			} else {

				$table = Styles::where('style', $st->style)->firstOrFail();
				$table->status = 'NOT IN USE';
				$table->save();
			}

		}

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM styles ORDER BY id asc"));
		return view('Styles.index', compact('data'));

	}


}

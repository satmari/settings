<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\box_settings;
use DB;

use Session;

class boxController extends Controller {

	public function index()
	{
		//
		$style = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT style FROM box_settings ORDER BY style asc"));
		// dd($style);
		return view('Box.index', compact('style'));
	}

	public function table()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM box_settings ORDER BY style, color asc"));
		return view('Box.table', compact('data'));
	}

	public function add_box()
	{
		//
		$data = DB::connection('sqlsrv3')->select(DB::raw("SELECT distinct fg FROM [trebovanje].[dbo].[sap_coois]"));
		return view('Box.add_box');
	}

	public function box_search_by_style(Request $request) {
		
		$this->validate($request, [	'style'=> 'required' ]);

		$input = $request->all();
		$style = $input['style'];
		// dd($style);

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT * FROM box_settings WHERE style = '".$style."' ORDER BY style, color asc"));
		// dd($style);
		return view('Box.table', compact('data'));
	}

	public function insert_box(Request $request) {
		
		// dd("Test");
		//
		$this->validate($request, [
			// 'plan_key' => 'required', 
			'style'=> 'required', 
			'color'=> 'required',
			'size' => 'required'
		]);

		$input = $request->all();

		$style = trim(strtoupper($input['style']));
		$color = trim(strtoupper($input['color']));
		$size = trim(strtoupper($input['size']));

		$sap_style = str_pad($style, 9);
		$sap_color = str_pad($color,4);

		$material = $sap_style.$sap_color.$size;
		// dd($material);

		$brand = $input['brand'];

		$pcs_per_polybag = (int)$input['pcs_per_polybag'];
		
		$weight_of_polybag = round((float)$input['weight_of_polybag'],3);
		$pcs_per_box = (int)$input['pcs_per_box'];
		$pcs_per_box_2 = (int)$input['pcs_per_box_2'];

		// $weight_of_pcs = round((float)$input['weight_of_pcs'],3);
		if ($pcs_per_polybag == 0 OR is_null($pcs_per_polybag) ) {
			$weight_of_pcs = NULL;
		} else {
			$weight_of_pcs = round((float)($weight_of_polybag/$pcs_per_polybag),3);	
		}
		
		$status = $input['status'];

		// try {
			$table = new box_settings;

			$table->material = $material;
			$table->style = $style;
			$table->color = $color;
			$table->size = $size;
			$table->brand = $brand;

			$table->pcs_per_polybag = $pcs_per_polybag;
			$table->weight_of_polybag = $weight_of_polybag;
			$table->weight_of_pcs = $weight_of_pcs;
			$table->pcs_per_box = $pcs_per_box;
			$table->pcs_per_box_2 = $pcs_per_box_2;

			$table->status = $status;
									
			$table->save();
		// }
		// catch (\Illuminate\Database\QueryException $e) {
		// 	$msg = "Problem to save in table";
		// 	return view('Box.error',compact('msg'));
		// }
		return Redirect::to('/box');
	}

	public function edit_box ($id) {
		
		//
		$data = box_settings::findOrFail($id);		
		return view('Box.edit_box', compact('data'));
	}

	public function update_box ($id, Request $request) {

		//
		$this->validate($request, [
			'style' => 'required', 
			'color'=> 'required', 
			'size'=> 'required',
		]);
		$input = $request->all();

		$style = trim(strtoupper($input['style']));
		$color = trim(strtoupper($input['color']));
		$size = trim(strtoupper($input['size']));

		$sap_style = str_pad($style, 9);
		$sap_color = str_pad($color,4);

		$material = $sap_style.$sap_color.$size;
		// dd($material);

		$brand = $input['brand'];

		$pcs_per_polybag = (int)$input['pcs_per_polybag'];
		$weight_of_polybag = round((float)$input['weight_of_polybag'],3);
		$pcs_per_box = (int)$input['pcs_per_box'];
		$pcs_per_box_2 = (int)$input['pcs_per_box_2'];

		// $weight_of_pcs = round((float)$input['weight_of_pcs'],3);
		if ($pcs_per_polybag == 0 OR is_null($pcs_per_polybag) ) {
			$weight_of_pcs = NULL;
		} else {
			$weight_of_pcs = round((float)($weight_of_polybag/$pcs_per_polybag),3);	
		}
		
		$status = $input['status'];

		// try {
			$table = box_settings::findOrFail($id);

			$table->material = $material;
			$table->style = $style;
			$table->color = $color;
			$table->size = $size;
			$table->brand = $brand;

			$table->pcs_per_polybag = $pcs_per_polybag;
			$table->weight_of_polybag = $weight_of_polybag;
			$table->weight_of_pcs = $weight_of_pcs;
			$table->pcs_per_box = $pcs_per_box;
			$table->pcs_per_box_2 = $pcs_per_box_2;

			$table->status = $status;
									
			$table->save();
		// }
		// catch (\Illuminate\Database\QueryException $e) {
		// 	$msg = "Problem to update table";
		// 	return view('Box.error',compact('msg'));
		// }

		return Redirect::to('/box');
	}
	

}

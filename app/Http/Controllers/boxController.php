<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\box_settings;
use DB;

use Session;

class boxController extends Controller {

	public function index() {
		//
		$style = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT style FROM box_settings ORDER BY style asc"));
		$style_2 = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT style_2 FROM box_settings ORDER BY style_2 asc"));
		// dd($style);
		return view('Box.index', compact('style', 'style_2'));
	}

	public function table() {
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT [id]
			  ,[sku]
		      ,[brand]
		      ,[style]
		      ,[color]
		      ,[size]
		      ,[pcs_per_polybag]
		      ,[weight_of_polybag]
		      ,[weight_of_pcs]
		      ,[pcs_per_box]
		      ,[status]
		      ,[created_at]
		      ,[updated_at]
		      ,REPLACE(LEFT(ISNULL(style_2,'')+'____',9), '_', ' ')+ REPLACE(LEFT(ISNULL(color_2,'')+'____',4), '_', ' ')+ REPLACE(LEFT(ISNULL(size_2,'')+	'____',5), '_', ' ') as sku_2
		      ,[pcs_per_box_2]
		      ,[pcs_per_polybag_2]
		      ,[ean_2]
		      ,[barcode_type]
		  FROM [settings].[dbo].[box_settings]"));

		return view('Box.table', compact('data'));
	}

	public function add_box() {
		//
		$data = DB::connection('sqlsrv3')->select(DB::raw("SELECT distinct fg FROM [trebovanje].[dbo].[sap_coois]"));
		return view('Box.add_box');
	}

	public function box_search_by_style(Request $request) {
		
		$this->validate($request, [	'style'=> 'required' ]);

		$input = $request->all();
		$style = $input['style'];
		// dd($style);

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT 
				[id]
			  ,[sku]
		      ,[brand]
		      ,[style]
		      ,[color]
		      ,[size]
		      ,[pcs_per_polybag]
		      ,[weight_of_polybag]
		      ,[weight_of_pcs]
		      ,[pcs_per_box]
		      ,[status]
		      ,[created_at]
		      ,[updated_at]
		      ,REPLACE(LEFT(ISNULL(style_2,'')+'____',9), '_', ' ')+ REPLACE(LEFT(ISNULL(color_2,'')+'____',4), '_', ' ')+ REPLACE(LEFT(ISNULL(size_2,'')+	'____',5), '_', ' ') as sku_2
		      ,[pcs_per_box_2]
		      ,[pcs_per_polybag_2]
		      ,[ean_2]
		      ,[barcode_type]
		      ,(SELECT bq.[Barcode] FROM [172.27.161.200].[preparation].[dbo].[Barcode Table Quality] as bq
		      	WHERE 	bq.[Item No_] = [style] COLLATE Latin1_General_CI_AS and 
		      			bq.[Color] = [color] COLLATE Latin1_General_CI_AS and 
		      			bq.[TG] = [size] COLLATE Latin1_General_CI_AS
		      		) as ean_1
		    FROM box_settings WHERE style = '".$style."' ORDER BY style, color asc"));
		// dd($data);
		return view('Box.table', compact('data'));
	}

	public function box_search_by_style_2(Request $request) {
		
		$this->validate($request, [	'style_2'=> 'required' ]);

		$input = $request->all();
		$style_2 = $input['style_2'];
		// dd($style_2);

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT 
			[id]
			  ,[sku]
		      ,[brand]
		      ,[style]
		      ,[style_2]
		      ,[color]
		      ,[color_2]
		      ,[size]
		      ,[pcs_per_polybag]
		      ,[weight_of_polybag]
		      ,[weight_of_pcs]
		      ,[pcs_per_box]
		      ,[status]
		      ,[created_at]
		      ,[updated_at]
		      ,REPLACE(LEFT(ISNULL(style_2,'')+'____',9), '_', ' ')+ REPLACE(LEFT(ISNULL(color_2,'')+'____',4), '_', ' ')+ REPLACE(LEFT(ISNULL(size_2,'')+	'____',5), '_', ' ') as sku_2
		      ,[pcs_per_box_2]
		      ,[pcs_per_polybag_2]
		      ,[ean_2]
		      ,[barcode_type]
		       FROM box_settings WHERE style_2 = '".$style_2."' ORDER BY style_2, color_2 asc"));
		// dd($style_2);
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
		$style_sap = str_pad($style, 9);
		$color_sap = str_pad($color, 4);
		$size_sap = str_pad($size, 5);
		$sku = $style_sap.$color_sap.$size_sap;

		$brand = $input['brand'];

		$pcs_per_polybag = (int)$input['pcs_per_polybag'];
		
		$weight_of_polybag = round((float)$input['weight_of_polybag'],3);
		
		$pcs_per_box = (int)$input['pcs_per_box'];

		if ($pcs_per_box == 0 OR is_null($pcs_per_box) ) {
			$pcs_per_box = NULL;
		}

		$pcs_per_polybag_2 = (int)$input['pcs_per_polybag_2'];

		if ($pcs_per_polybag_2 == 0 OR is_null($pcs_per_polybag_2) ) {
			$pcs_per_polybag_2 = NULL;
		}

		$pcs_per_box_2 = (int)$input['pcs_per_box_2'];

		if ($pcs_per_box_2 == 0 OR is_null($pcs_per_box_2) ) {
			$pcs_per_box_2 = NULL;
		}

		// $weight_of_pcs = round((float)$input['weight_of_pcs'],3);
		if ($pcs_per_polybag == 0 OR is_null($pcs_per_polybag) ) {
			$weight_of_pcs = NULL;
			$pcs_per_polybag = NULL;
		} else {
			$weight_of_pcs = round((float)($weight_of_polybag/$pcs_per_polybag),3);	
		}

		$status = $input['status'];

		// try {
			$table = new box_settings;

			$table->material = $material;
			$table->sku = $sku;

			$table->style = $style;
			$table->color = $color;
			$table->size = $size;
			$table->brand = $brand;

			$table->pcs_per_polybag = $pcs_per_polybag;
			$table->weight_of_polybag = $weight_of_polybag;
			$table->weight_of_pcs = $weight_of_pcs;
			$table->pcs_per_box = $pcs_per_box;

			$table->pcs_per_box_2 = $pcs_per_box_2;
			$table->pcs_per_polybag_2 = $pcs_per_polybag_2;

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

	public function edit_box2 (Request $request) {
		
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

		// dd($style);

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM box_settings WHERE style = '".$style."' AND color = '".$color."' AND size = '".$size."'"));
		if (isset($data[0]->id)) {
				

			if (!isset($data[0]->style_2) OR (!isset($data[0]->color_2)) OR (!isset($data[0]->size_2))) {
				
				$data = $data[0];
				return view('Box.edit_box2', compact('data'));
			}

			$style_2 = $data[0]->style_2;
			$color_2 = $data[0]->color_2;
			$size_2 = $data[0]->size_2;

			// dd($data[0]->brand);
			$data_2 = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM box_settings WHERE style_2 = '".$style_2."' AND color_2 = '".$color_2."' AND size = '".$size_2."'"));
			
			// dd($data_2);

			$data = $data[0];
			return view('Box.edit_box2', compact('data','data_2'));
		} 

		// $data = box_settings::findOrFail($id);		
		// return view('Box.edit_box', compact('data'));
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

		if ($pcs_per_box == 0 OR is_null($pcs_per_box) ) {
			$pcs_per_box = NULL;
		}

		// $pcs_per_polybag_2 = (int)$input['pcs_per_polybag_2'];

		// if ($pcs_per_polybag_2 == 0 OR is_null($pcs_per_polybag_2) ) {
		// 	$pcs_per_polybag_2 = NULL;
		// }

		// $pcs_per_box_2 = (int)$input['pcs_per_box_2'];

		// if ($pcs_per_box_2 == 0 OR is_null($pcs_per_box_2) ) {
		// 	$pcs_per_box_2 = NULL;
		// }

		// $weight_of_pcs = round((float)$input['weight_of_pcs'],3);
		if ($pcs_per_polybag == 0 OR is_null($pcs_per_polybag) ) {
			$weight_of_pcs = NULL;
			$pcs_per_polybag = NULL;
		} else {
			$weight_of_pcs = round((float)($weight_of_polybag/$pcs_per_polybag),3);	
		}

		$style_sap = str_pad($style, 9);
		$color_sap = str_pad($color, 4);
		$size_sap = str_pad($size, 5);
		$sku = $style_sap.$color_sap.$size_sap;

		$status = $input['status'];

		// try {
			$table = box_settings::findOrFail($id);

			$table->material = $material;
			$table->sku = $sku;
			$table->style = $style;
			$table->color = $color;
			$table->size = $size;
			$table->brand = $brand;

			$table->pcs_per_polybag = $pcs_per_polybag;
			$table->weight_of_polybag = $weight_of_polybag;
			$table->weight_of_pcs = $weight_of_pcs;
			$table->pcs_per_box = $pcs_per_box;

			// $table->pcs_per_box_2 = $pcs_per_box_2;
			// $table->pcs_per_polybag_2 = $pcs_per_polybag_2;

			$table->status = $status;
									
			$table->save();
		// }
		// catch (\Illuminate\Database\QueryException $e) {
		// 	$msg = "Problem to update table";
		// 	return view('Box.error',compact('msg'));
		// }

		return Redirect::to('/box');
	}

	public function update_box2 ($id, Request $request) {

		//
		$input = $request->all();
		// dd($input);

		$pcs_per_polybag_2 = (int)$input['pcs_per_polybag_2'];
		if ($pcs_per_polybag_2 == 0 OR is_null($pcs_per_polybag_2) ) {
			$pcs_per_polybag_2 = NULL;
		}
		// dd($pcs_per_polybag_2);

		$pcs_per_box_2 = (int)$input['pcs_per_box_2'];
		if ($pcs_per_box_2 == 0 OR is_null($pcs_per_box_2) ) {
			$pcs_per_box_2 = NULL;
		}

		//
		$select = DB::connection('sqlsrv')->select(DB::raw("SELECT style_2, color_2, size_2 FROM box_settings WHERE id = '".$id."' "));
		// dd($select);

		if (!isset($select[0]->style_2) OR (!isset($select[0]->color_2)) OR (!isset($select[0]->size_2))) {
				
			dd('Information of second quality are mising, try tu update from Umesa table, or if still missing call IT');
		}

		$style_2 = $select[0]->style_2;
		$color_2 = $select[0]->color_2;
		$size_2 = $select[0]->size_2;


		$data = DB::connection('sqlsrv')->update(DB::raw("SET NOCOUNT ON; UPDATE box_settings 
			SET pcs_per_polybag_2 = '".$pcs_per_polybag_2."',
				pcs_per_box_2 = '".$pcs_per_box_2."'
			WHERE style_2 = '".$style_2."' AND color_2 = '".$color_2."' AND size_2 = '".$size_2."';
			SELECT TOP 1 * FROM box_settings "));

		return Redirect::to('/box');
	}
	
	public function update_second_q_info() {

		// dd('update from 2q info');
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT id, style, color, size, barcode_type FROM box_settings order by id asc"));
		// dd($data);

		foreach ($data as $line ) {
			// dd($line->size);
			
			$style = $line->style;
			$color = $line->color;
			$size = $line->size;
						
			$search_umesa = DB::connection('sqlsrv4')->select(DB::raw("SELECT 
		      --[Item No_] as style
		      --,[Color] as color
		      --,[TG] as size
		      
		      [Materiale] as style_2
		      ,[Commersial Color code] as color_2
		      ,[TG2] as size_2
		      
		      --,[Commersial Color code]
		      --,[Color decstionption]
		      ,[Commersial Color code] + ' ' + [Color decstionption] as col_desc_2
		      ,[Barcode] as ean_2
		      ,[Serie] as barcode_type
			  --,*
			  FROM [preparation].[dbo].[Barcode Table Quality]
			  
			  --WHERE [Item No_] = 'CMU12G' and [Color] = '031' and [TG] = 'L'
			  --WHERE [Item No_] = '1MT779AT' and [Color] = '196U' and [TG] = 'M'
			  --WHERE [Item No_] = 'MODC1713' and [Color] = '303C' and [TG] = 'S'

			  WHERE [Item No_] = '".$style."' AND [Color] = '".$color."' AND [TG] = '".$size."' "));
			// dd($search_umesa);

			if (!isset($search_umesa[0]->style_2)) {
				// $msg = 'Second Quality informarion does not exist in Umesa table';
				// return view('magacin.error', compact('msg'));
				continue;
			}
			// dd($search_umesa);

			$barcode_type = $line->barcode_type;



			$table = box_settings::findOrFail($line->id);
			// dd($table);

			$table->style_2 = $search_umesa[0]->style_2;
			$table->color_2 = $search_umesa[0]->color_2;
			$table->size_2 =  $search_umesa[0]->size_2;

			$table->col_desc_2 = $search_umesa[0]->col_desc_2;
			$table->ean_2 = $search_umesa[0]->ean_2;
			$table->barcode_type = $search_umesa[0]->barcode_type;

			if ($barcode_type == '1_to_1') {
				
				$table->pcs_per_box_2 = $table->pcs_per_box;
				$table->pcs_per_polybag_2 = $table->pcs_per_polybag;				
				
			}
									
			$table->save();
		}

		return Redirect::to('/box');
	}
}

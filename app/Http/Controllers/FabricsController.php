<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Fabrics;
use App\Supplier;
use App\MatAbbrevs;
use DB;

use Session;

class FabricsController extends Controller {

	public function index()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM fabrics ORDER BY id asc"));
		return view('Fabrics.index', compact('data'));
	}

	public function add_fabric () {
		//

		// $suppliers = Supplier::orderBy('id')->lists('supplier','id'); //pluck
		// dd($suppliers);

		$suppliers = DB::connection('sqlsrv')->select(DB::raw("SELECT supplier FROM suppliers ORDER BY id asc"));
		$suppliers = (object) $suppliers;
		// dd($suppliers);

		$materials = DB::connection('sqlsrv')->select(DB::raw("SELECT abbreviation FROM mat_abbrevs ORDER BY id asc"));
		$materials = (object) $materials;
		// dd($materials);



		return view('Fabrics.add_fabric', compact('suppliers','materials'));
	}

	public function insert_fabric (Request $request) {
		
		//
		$this->validate($request, ['fabric' => 'required' ]);
		$input = $request->all();

		// dd($input['fabric']);

		try {

			$table = new Fabrics;

			$table->fabric = $input['fabric'];
			$table->supplier = $input['supplier'];
			$table->material_description = $input['material_description'];
			$table->mat1 = $input['mat1'];
			$table->mat1_p = $input['mat1_p']/100;
			$table->mat2 = $input['mat2'];
			$table->mat2_p = $input['mat2_p']/100;
			$table->mat3 = $input['mat3'];
			$table->mat3_p = $input['mat3_p']/100;
			$table->mat4 = $input['mat4'];
			$table->mat4_p = $input['mat4_p']/100;
			$table->tot_width = $input['tot_width'];
			$table->usable_width = $input['usable_width'];
			$table->shrinkage_dry_o = $input['shrinkage_dry_o']/100;
			$table->shrinkage_dry_w = $input['shrinkage_dry_w']/100;
			$table->shrinkage_dry_tol = $input['shrinkage_dry_tol'];
			$table->shrinkage_steam_o = $input['shrinkage_steam_o']/100;
			$table->shrinkage_steam_w = $input['shrinkage_steam_w']/100;
			$table->shrinkage_steam_tol = $input['shrinkage_steam_tol'];
			$table->relaxation = $input['relaxation'];
			$table->to_be_checked_on_qc_p = $input['to_be_checked_on_qc_p']/100;
			$table->date_of_update_qc_p = $input['date_of_update_qc_p'];
			$table->supplier_truck = $input['supplier_truck'];
			$table->labels_to_genetate = $input['labels_to_genetate'];

			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in Fabrics table";
			return view('Fabrics.error',compact('msg'));
		}

		return Redirect::to('/fabrics');
	}

	public function edit_fabric ($id) {
		
		//
		$data = Fabrics::findOrFail($id);

		$suppliers = DB::connection('sqlsrv')->select(DB::raw("SELECT supplier FROM suppliers ORDER BY id asc"));
		$suppliers = (object) $suppliers;

		$materials = DB::connection('sqlsrv')->select(DB::raw("SELECT abbreviation FROM mat_abbrevs ORDER BY id asc"));
		$materials = (object) $materials;
		
		return view('Fabrics.edit_fabric', compact('data','suppliers','materials'));
	}

	public function update_fabric ($id, Request $request) {

		//
		$this->validate($request, ['fabric' => 'required']);
		$input = $request->all();

		$table = Fabrics::findOrFail($id);

		try {

			$table->fabric = $input['fabric'];
			$table->supplier = $input['supplier'];
			$table->material_description = $input['material_description'];
			$table->mat1 = $input['mat1'];
			$table->mat1_p = $input['mat1_p']/100;
			$table->mat2 = $input['mat2'];
			$table->mat2_p = $input['mat2_p']/100;
			$table->mat3 = $input['mat3'];
			$table->mat3_p = $input['mat3_p']/100;
			$table->mat4 = $input['mat4'];
			$table->mat4_p = $input['mat4_p']/100;
			$table->tot_width = $input['tot_width'];
			$table->usable_width = $input['usable_width'];
			$table->shrinkage_dry_o = $input['shrinkage_dry_o']/100;
			$table->shrinkage_dry_w = $input['shrinkage_dry_w']/100;
			$table->shrinkage_dry_tol = $input['shrinkage_dry_tol'];
			$table->shrinkage_steam_o = $input['shrinkage_steam_o']/100;
			$table->shrinkage_steam_w = $input['shrinkage_steam_w']/100;
			$table->shrinkage_steam_tol = $input['shrinkage_steam_tol'];
			$table->relaxation = $input['relaxation'];
			$table->to_be_checked_on_qc_p = $input['to_be_checked_on_qc_p']/100;
			$table->date_of_update_qc_p = $input['date_of_update_qc_p'];
			$table->supplier_truck = $input['supplier_truck'];
			$table->labels_to_genetate = $input['labels_to_genetate'];
			
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in Fabrics table";
			return view('Fabrics.error',compact('msg'));
		}

		return Redirect::to('/fabrics');
	}

	public function refreshfabrics()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM fabrics ORDER BY id asc"));

		// dd($data);

		foreach ($data as $line) {

			// update material descriprion for all materials
			
			if ($line->mat1 <> "") {
				$desc = DB::connection('sqlsrv')->select(DB::raw("SELECT description FROM mat_abbrevs WHERE abbreviation = '".$line->mat1."' "));

				// dd($desc[0]->description);
				if ($desc[0]->description <> "") {

					$table = Fabrics::findOrFail($line->id);
					$table->mat1_description = $desc[0]->description;
					$table->save();

				}
			} else {
				$table = Fabrics::findOrFail($line->id);
				$table->mat1_description = "";
				$table->save();
			}

			if ($line->mat2 <> "") {
				$desc = DB::connection('sqlsrv')->select(DB::raw("SELECT description FROM mat_abbrevs WHERE abbreviation = '".$line->mat2."' "));

				// dd($desc[0]->description);
				if ($desc[0]->description <> "") {

					$table = Fabrics::findOrFail($line->id);
					$table->mat2_description = $desc[0]->description;
					$table->save();

				}
			} else {
				$table = Fabrics::findOrFail($line->id);
				$table->mat2_description = "";
				$table->save();
			}

			if ($line->mat3 <> "") {
				$desc = DB::connection('sqlsrv')->select(DB::raw("SELECT description FROM mat_abbrevs WHERE abbreviation = '".$line->mat3."' "));

				// dd($desc[0]->description);
				if ($desc[0]->description <> "") {

					$table = Fabrics::findOrFail($line->id);
					$table->mat3_description = $desc[0]->description;
					$table->save();

				}
			} else {
				$table = Fabrics::findOrFail($line->id);
				$table->mat3_description = "";
				$table->save();
			}

			if ($line->mat4 <> "") {
				$desc = DB::connection('sqlsrv')->select(DB::raw("SELECT description FROM mat_abbrevs WHERE abbreviation = '".$line->mat4."' "));

				// dd($desc[0]->description);
				if ($desc[0]->description <> "") {

					$table = Fabrics::findOrFail($line->id);
					$table->mat4_description = $desc[0]->description;
					$table->save();

				}
			} else {
				$table = Fabrics::findOrFail($line->id);
				$table->mat4_description = "";
				$table->save();
			}

			// update composition

			/*
			=IF([@Mat1]="";"";IF([@[Mat2 '[%']]]="";CONCATENATE(TEXT([@[Mat1 '[%']]];"#%");[@Mat1]);IF([@[Mat3 '[%']]]="";CONCATENATE(TEXT([@[Mat1 '[%']]];"#%");[@Mat1];" ; ";TEXT([@[Mat2 '[%']]];"#%");[@Mat2]);
			IF([@[Mat4 '[%']]]="";CONCATENATE(TEXT([@[Mat1 '[%']]];"#%");[@Mat1];" ; ";TEXT([@[Mat2 '[%']]];"#%");[@Mat2];" ; ";TEXT([@[Mat3 '[%']]];"#%");[@Mat3]);CONCATENATE(TEXT([@[Mat1 '[%']]];"#%");[@Mat1];" ; ";TEXT([@[Mat2 '[%']]];"#%");[@Mat2];" ; ";TEXT([@[Mat3 '[%']]];"#%");[@Mat3];" ; ";TEXT([@[Mat4 '[%']]];"#%");[@Mat4])))))
			*/
		
			$table = Fabrics::findOrFail($line->id);

			// $test= $line->mat1_p*100;
			// dd( $test.' test');

			if ($line->mat1 == "") {
				
				$table->composition = "";
				$table->save();
			}	else {
				if ($line->mat2_p == 0) {
					$mat1_p = $line->mat1_p*100;
					$table->composition = $mat1_p."%".$line->mat1;
					$table->save();
				} else {
					if ($line->mat3_p == 0) {
						
						$mat1_p = $line->mat1_p*100;
						$mat2_p = $line->mat2_p*100;
						$table->composition = $mat1_p."%".$line->mat1." ; ".$mat2_p."%".$line->mat2;
						$table->save();
					} else {
						if ($line->mat4_p == 0) {
							
							$mat1_p = $line->mat1_p*100;
							$mat2_p = $line->mat2_p*100;	
							$mat3_p = $line->mat3_p*100;	
							$table->composition = $mat1_p."%".$line->mat1." ; ".$mat2_p."%".$line->mat2." ; ".$mat3_p."%".$line->mat3;
							$table->save();
						} else {
							
							$mat1_p = $line->mat1_p*100;
							$mat2_p = $line->mat2_p*100;	
							$mat3_p = $line->mat3_p*100;	
							$mat4_p = $line->mat4_p*100;	
							$table->composition = $mat1_p."%".$line->mat1." ; ".$mat2_p."%".$line->mat2." ; ".$mat3_p."%".$line->mat3." ; ".$mat4_p."%".$line->mat4;
							$table->save();
						}
					}
				}
			}

			// update main_material

			/*
			=IF([@[Mat1 '[%']]]>=80%;VLOOKUP([@Mat1];Mat.Abbrev.[#All];2;FALSE);CONCATENATE(VLOOKUP([@Mat1];Mat.Abbrev.[#All];2;FALSE);" / ";VLOOKUP([@Mat2];Mat.Abbrev.[#All];2;FALSE)))
			*/

			if ($line->mat1_p*100 >= 80 ) {
				$table->main_material = $table->mat1_description;
				$table->save();
			} else {
				$table->main_material = $table->mat1_description." / ".$table->mat2_description;
				$table->save();
			}
				
			// update daying_type

			/*
			=IF(MID([@[Fabric Code]];2;1)="F";"Printed";"Solid")
			*/

			// dd(substr($line->fabric, 1, 1));
			
			if (substr($line->fabric, 1, 1) == "F") {
				$table->daying_type = "Printed";
				$table->save();
			} else {
				$table->daying_type = "Solid";
				$table->save();
			}

		}



		return Redirect::to('/fabrics');
	}

}

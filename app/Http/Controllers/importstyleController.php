<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Maatwebsite\Excel\Facades\Excel;

use Request; // for import
// use Illuminate\Http\Request; // for image

use App\Styles;

use DB;

class ImportstyleController extends Controller {

	
	public function index()
	{
		
		return view('Styles.import');
	}

	public function postImportStyle(Request $request) {

	    $getSheetName = Excel::load(Request::file('file'))->getSheetNames();
	    
	    foreach($getSheetName as $sheetName)
	    {
	        //if ($sheetName === 'Product-General-Table')  {
	    	//selectSheetsByIndex(0)
	           	// DB::statement('SET FOREIGN_KEY_CHECKS=0;');
	            // DB::table('users')->truncate();
				// DB::statement('SET FOREIGN_KEY_CHECKS=1;');

	            //Excel::selectSheets($sheetName)->load($request->file('file'), function ($reader)
	            //Excel::selectSheets($sheetName)->load(Input::file('file'), function ($reader)
	            
	            Excel::filter('chunk')->selectSheets($sheetName)->load(Request::file('file'))->chunk(5000, function ($reader)
	            
	            {
	                $readerarray = $reader->toArray();
	                // dd($readerarray);

	                foreach($readerarray as $row) {

	                	// dd($row);
	                	$style = $row['style'];

	                	$existing = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM styles WHERE style = '".$style."' "));
	                	
	                	if (isset($existing[0]->id)) {
	                		// UPDATE

	                		$table = Styles::findOrFail($existing[0]->id);

							try {

								$table->style = trim(strtoupper($row['style']));
								$table->brand = $row['brand'];
								$table->cutting_smv = (float)$row['cutting_smv'];
								$table->cluster = trim($row['cluster']);
								$table->order_type = $row['order_type'];

								$table->fg_family = $row['fg_family'];
								$table->spreading_method = $row['spreading_method'];
								$table->standard_bb_qty = (int)$row['standard_bb_qty'];
								$table->pad_print = $row['pad_print'];
								$table->bansek = $row['bansek'];
								$table->adeziv = $row['adeziv'];

								$table->save();
							}
							catch (\Illuminate\Database\QueryException $e) {
								$msg = "Problem to save in style table";
								return view('Styles.error',compact('msg'));
							}

	                	} else {
	                		// continue;
	                		// exit foreach if not exist
	                		// ADD new

	                		$table = new Styles;

							$table->style = trim(strtoupper($row['style']));
							$table->brand = $row['brand'];
							$table->cutting_smv = (float)$row['cutting_smv'];
							$table->cluster = trim($row['cluster']);
							$table->order_type = $row['order_type'];

							$table->fg_family = $row['fg_family'];
							$table->spreading_method = $row['spreading_method'];
							$table->standard_bb_qty = (int)$row['standard_bb_qty'];
							$table->pad_print = $row['pad_print'];
							$table->bansek = $row['bansek'];
							$table->adeziv = $row['adeziv'];

							$table->save();

	                	}

		
	                }
	            });
	    }
		return redirect('/styles');
	}

	
}

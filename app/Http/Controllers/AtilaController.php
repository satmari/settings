<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\cctabela;
use App\cctabela_log;
use App\inventory_bin_to_loc;
use DB;

use Session;

class AtilaController extends Controller {

	
	public function index() {
		//

		$data = DB::connection('sqlsrv1')->select(DB::raw("SELECT [No_] as no, [Value Posting] as value_posting FROM [GORDON\$Default Dimension] WHERE [No_] like '5%' "));
		$data1 = DB::connection('sqlsrv')->select(DB::raw("SELECT no,value_posting FROM cctabelas ORDER BY id"));

		return view('atila.index', compact('data', 'data1'));
	}

	public function close_po() {
		//

		return view('atila.close_po');
	}

	public function copy_cc_from_nav() {
		//

		$data = DB::connection('sqlsrv1')->select(DB::raw("SELECT [No_] as no, [Value Posting] as value_posting FROM [GORDON\$Default Dimension] WHERE [No_] like '5%' "));
		// dd($data);

		foreach ($data as $line) {

			// dd($line->No_);
			// dd(intval($line->value_posting));
			
			try {

				$table = new cctabela;

				$table->no = intval($line->no);
				$table->value_posting = intval($line->value_posting);

				$table->save();
			}
			catch (\Illuminate\Database\QueryException $e) {
				$msg = "Problem to save table";
				return view('Atila.error',compact('msg'));
			}

			try {

				$table = new cctabela_log;

				$table->no = intval($line->no);
				$table->value_posting = intval($line->value_posting);

				$table->save();
			}
			catch (\Illuminate\Database\QueryException $e) {
				$msg = "Problem to save table";
				return view('Atila.error',compact('msg'));
			}
			

		}

		return redirect('/atila');
		// return view('atila.index');
	}

	public function truncate_local_cc() {
		//

		// $data = DB::connection('sqlsrv')->select(DB::raw("truncate table [settings].[dbo].[cctabelas]"));
		$data = DB::connection('sqlsrv')->select(DB::raw("
			SET NOCOUNT ON;
			DELETE FROM [settings].[dbo].[cctabelas];
			SELECT * FROM [settings].[dbo].[cctabelas]
		"));
		
		return redirect('/atila');
		// return view('atila.index');
	}

	public function copy_cc_from_local() {
		//

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT no,value_posting FROM cctabelas ORDER BY id"));
		// dd($data);

		foreach ($data as $line) {

			// dd($line->no);

				$find = DB::connection('sqlsrv1')->select(DB::raw("SELECT 
				  [No_] as no, [Value Posting] as value_posting
				  FROM [GORDON\$Default Dimension]
  				  WHERE [No_] = '".intval($line->no)."'
				"));


				// dd($find);
				// dd($find[0]->no);

				
				// if (isset($find[0]->no)) {
					
					// dd("do");

					// dd(intval($line->value_posting));
					// dd(intval($find[0]->no));
					
					DB::connection('sqlsrv1')->select(DB::raw("
						SET NOCOUNT ON;
						UPDATE [GORDON\$Default Dimension]
						SET [Value Posting] = '".intval($line->value_posting)."' 
						WHERE [No_] = '".intval($find[0]->no)."'
						SELECT * FROM [GORDON\$Default Dimension] WHERE [No_] = '".intval($find[0]->no)."'
					"));
				// }
				
		}

		return redirect('/atila');
		// return view('atila.index');
	}

	public function delete_nav_cc() {

		$update = DB::connection('sqlsrv1')->select(DB::raw("
			SET NOCOUNT ON;
			UPDATE [GORDON\$Default Dimension]
			SET [Value Posting] = '0' 
			WHERE [No_] like '5%'
			SELECT * FROM [GORDON\$Default Dimension] WHERE [No_] like '5%'
		"));

		return redirect('/atila');
		// return view('atila.index');
	}

	public function bbstatus() {

		$data = DB::connection('sqlsrv2')->select(DB::raw("SELECT 
			  po.INTKEY as intkey
		      ,po.[POnum] as pon
		      ,sku.Variant as variant
		      ,po.[BoxComplete] as bbstatus
		      ,po.[POClosed] as poclose
		      
		  FROM [BdkCLZG].[dbo].[CNF_PO] as po
		  JOIN [BdkCLZG].[dbo].[CNF_SKU] as sku on sku.INTKEY = po.SKUKEY
		  
		  WHERE po.CREATEDATE > '06-01-2018' ORDER BY po.[POnum] desc "));

		return view('atila.bbstatus', compact('data'));
	}

	public function edit_po_bbstatus($pon) {
		// dd($pon);
		return view('atila.bbstatus_change', compact('pon'));
	}

	public function update_bbstatus(Request $request) {

		$this->validate($request, ['new_status' => 'required', 'pon' => 'required' ]);
		$input = $request->all();

		$new_status = $input['new_status'];
		$pon = $input['pon'];

		// dd($new_status);
		
		$data = DB::connection('sqlsrv2')->select(DB::raw("SET NOCOUNT ON;
		UPDATE [BdkCLZG].[dbo].[CNF_PO] 
		SET [BoxComplete] = ".$new_status."
		WHERE [POnum] = '".$pon."';
		SELECT TOP 1 [POnum] FROM [BdkCLZG].[dbo].[CNF_PO] WHERE [POnum] = '".$pon."';"));
		
		
		return redirect('/bbstatus');
	}

	public function it_dezurstva() {
		
		return view('atila.it');
	}

	public function inventory_bintoloc() {

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_bin_to_locs ORDER BY id asc"));
		return view('Inventory_bintoloc.index', compact('data'));
	}

	public function inventory_bintoloc_scan() {
		//
		$session = Session::getId();
		$msg = "Please scan BIN";
		return view('Inventory_bintoloc.scan', compact('msg'));
	}

	public function inventory_bintoloc_post(Request $request) {

		$this->validate($request, ['bin' => 'required']);
		$input = $request->all();

		$bin = $input['bin'];
		if (strlen($bin) !== 20) {
	        $msge = "BIN must be 20 chars";
	        // $msge = ;
			return view('Inventory_bintoloc.scan', compact('msg', 'msge'));
	    }

		$msg = "Please scan LOCATION";
		return view('Inventory_bintoloc.scan_loc', compact('bin','msg'));
	}

	public function inventory_bintoloc_post_loc(Request $request) {

		$this->validate($request, ['bin' => 'required', 'location' => 'required']);
		$input = $request->all();

		$bin = $input['bin'];
		$location = $input['location'];

		$code = substr($bin, 9, 3);
		// dd($code);

		if ($code == '117') {
		    $bin_type = 'WOOD';
		} elseif ($code == '116') {
		    $bin_type = 'KAS';
		} elseif ($code == '115') {
		    $bin_type = 'PAL';
		} else {
		    $bin_type = 'UNKNOWN';
		}
		// dd($bin_type);

		$check = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_bin_to_locs 
			WHERE bin = '".$bin."' "));

		if (isset($check[0]->id)) {
			// var_dump(" and exist");	

			$table1 = inventory_bin_to_loc::findOrFail($check[0]->id);
			$table1->location = $location;
			$table1->bin_type = $bin_type;
			$table1->ses = Session::getId();
			$table1->save();

		} else {
			// var_dump(" and not exist in main");

			$table = new inventory_bin_to_loc;
			$table->bin = $bin;
			$table->location = $location;
			$table->bin_type = $bin_type;
			$table->ses =  Session::getId();
			$table->save();

			
		}

		$msg = 'BIN and LOCATION saved in table';
		$msgs = 1;
		return view('Inventory_bintoloc.scan', compact('msg', 'msgs'));
		
	}
	
	
}

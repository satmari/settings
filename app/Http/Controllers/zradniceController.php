<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\zradnice;
use DB;

use Session;

use Carbon\Carbon;

class zradniceController extends Controller {

	public function zradnice() {

	    // Get data from Inteos (two sources)
	    $z_data_from_inteos = DB::connection('sqlsrv2')->select("
	        SELECT [BadgeNum], [Name], [FlgAct]
	        FROM [WEA_PersData]
	        WHERE BadgeNum != '' AND BadgeNum LIKE 'Z%'
	        
	        UNION
	        
	        SELECT [BadgeNum], [Name], [FlgAct]
	        FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[WEA_PersData]
	        WHERE BadgeNum != '' AND BadgeNum LIKE 'Z%'
	        
	        ORDER BY BadgeNum DESC
	    ");

	    $inteos = collect($z_data_from_inteos);

	    // Get local data
	    $data_local = DB::select("SELECT * FROM zradnices ORDER BY z_number desc");
	    $local = [];
	    foreach ($data_local as $row) {
	        $local[$row->z_number] = $row; // key by z_number
	    }

	    $newRows = [];
	    $updatedCount = 0;

	    foreach ($inteos as $row) {
	        if (!array_key_exists($row->BadgeNum, $local)) {
	            // Missing → insert
	            $newRows[] = [
	                'z_number'   => $row->BadgeNum,
	                'z_name'     => $row->Name,
	                'z_status'   => $row->FlgAct,
	                'created_at' => Carbon::now(),
	                'updated_at' => Carbon::now(),
	            ];
	        } else {
	            // Exists → check if name/status differ → update
	            $localRow = $local[$row->BadgeNum];
	            if ($localRow->z_name != $row->Name || $localRow->z_status != $row->FlgAct) {
	                DB::table('zradnices')
	                    ->where('z_number', $row->BadgeNum)
	                    ->update([
	                        'z_name'     => $row->Name,
	                        'z_status'   => $row->FlgAct,
	                        'updated_at' => Carbon::now(),
	                    ]);
	                $updatedCount++;
	            }
	        }
	    }

	    // Bulk insert missing
	    if (!empty($newRows)) {
	        DB::table('zradnices')->insert($newRows);
	    }

	    // JSON response if there were changes
	    if (count($newRows) > 0 || $updatedCount > 0) {
	        return response()->json([
	            'added'   => count($newRows),
	            'updated' => $updatedCount,
	            'message' => count($newRows) . ' new employees added, ' . $updatedCount . ' updated',
	        ]);
	    }

	    // Default view
	    $data = DB::connection('sqlsrv')->select("SELECT * FROM zradnices ORDER BY z_number desc");
	    return view('zradnice.index', compact('data'));
	}

	public function update_status_radnice() {

		$data_local = DB::select("SELECT * FROM zradnices ORDER BY z_number desc");


		foreach ($data_local as $row) {

			if (!is_null($row->r_number)) {
				$rnumber = $row->r_number;
				$id = $row->id;

				$z_data_from_inteos = DB::connection('sqlsrv2')->select("
			        SELECT [BadgeNum], [Name] as r_name, [FlgAct] as r_status
			        FROM [WEA_PersData]
			        WHERE BadgeNum = '".$rnumber."' 
			    ");

			    if (!isset($z_data_from_inteos[0]->r_name)) {
			    	dd($z_data_from_inteos[0]->r_name);	
			    }
			    

				$r_status = $z_data_from_inteos[0]->r_status;
				$r_name = $z_data_from_inteos[0]->r_name;

				$table = zradnice::where('id', $id)->firstOrFail();
				// $table->z_name = $z_number.' ('.$r_name.')';
				$table->r_name = $r_name;
				$table->r_status = $r_status;
				$table->save();

			}
	    }

	    // Default view
	    $data = DB::connection('sqlsrv')->select("SELECT * FROM zradnices ORDER BY z_number desc");
	    return view('zradnice.index', compact('data'));
	}

	public function edit_zradnica($id) {

		$data = DB::connection('sqlsrv')->select("SELECT * FROM zradnices 
			WHERE id = '".$id."' ");

		$operators = DB::connection('sqlsrv2')->select(DB::raw("SELECT [BadgeNum] as r_number,
			[Name] as r_name,[FlgAct] as r_status
		  FROM [BdkCLZG].[dbo].[WEA_PersData]
		  WHERE [BadgeNum] like 'R%' --and [FlgAct] = '1'
		  ORDER BY BadgeNum asc "));
		// dd($operators);

	    return view('zradnice.edit_zradnica', compact('data','operators'));
	}


	public function edit_zradnica_post(Request $request) {

		$input = $request->all();
		// dd($input);

		$id = $input['id'];
		$z_number = $input['z_number'];
		$z_name = $input['z_name'];
		
		$r_number_new = $input['r_number_new'];
		$comment = $input['comment'];
		$fromDate = (isset($input['fromDate']) && $input['fromDate'] !== '') 
		    ? $input['fromDate'] 
		    : null;

		$toDate = (isset($input['toDate']) && $input['toDate'] !== '') 
		    ? $input['toDate'] 
		    : null;

		$final_status = $input['final_status'];
		// dd($z_name);

		$input_employee = isset($input['r_number_new']) ? $input['r_number_new'] : null;

		if (!$input_employee) {
		    dd('Nije izabrana radnica!');
		}

		$parts = explode("-", $input_employee);

		// Make sure we have both number and name
		if (count($parts) >= 2) {
		    $r_number = trim($parts[0]);
		    $r_name   = trim($parts[1]);
		} else {
		    dd('Nije izabrana radnica!');
		}
		

		
		$input_z_employee = $input['z_name'];
		$zparts = explode(" ", $input_z_employee);
		$z_number_radnica  = trim($zparts[0]);
		// $z_name  = trim($zparts[1]);
		//dd($z_number);

		$new_r = DB::connection('sqlsrv2')->select(DB::raw("SELECT [BadgeNum] as r_number,
			[Name] as r_name, [FlgAct] as r_status
		  FROM [BdkCLZG].[dbo].[WEA_PersData]
		  WHERE [BadgeNum]  = '".$r_number."'
		  ORDER BY BadgeNum asc "));
		// dd($new_r[0]);

		
		$r_name = $new_r[0]->r_name;
		$r_status = $new_r[0]->r_status;

		$z_name_new = $z_number_radnica.' ('.$r_name.')';
		// dd($z_name_new);

		$table = zradnice::where('id', $id)->firstOrFail();

		$table->z_name = $z_name_new;	// new name
		$table->z_status = $r_status;  					// status from R 
		$table->r_number = $r_number;
		$table->r_name = $r_name;
		$table->r_status = $r_status;

		$table->comment = $comment;
		$table->fromDate = $fromDate;
		$table->toDate = $toDate;
		$table->final_status = $final_status;
		$table->save();


		// update inteos subotica Z
		// Update on first server

		// dd('z_name_new '. $z_name_new);
		// dd($z_number);


		// Debug check first
		$exists = DB::connection('sqlsrv2')->select("
		    SELECT BadgeNum, Name 
		    FROM [BdkCLZG].[dbo].[WEA_PersData]
		    WHERE BadgeNum = ?
		", [$z_number]);

		if (empty($exists)) {
		    dd("BadgeNum {$z_number} not found in first DB");
		}

		// Update on first server
		$new_r = DB::connection('sqlsrv2')->update("
		    UPDATE [BdkCLZG].[dbo].[WEA_PersData]
		    SET Name = ?
		    WHERE [BadgeNum] = ?
		", [$z_name_new, $z_number]);

		// Update on second server
		$new_r_k = DB::connection('sqlsrv2')->update("
		    UPDATE [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[WEA_PersData]
		    SET Name = ?
		    WHERE [BadgeNum] = ?
		", [$z_name_new, $z_number]);

		if ($new_r === 0 && $new_r_k === 0) {
		    dd('No rows updated – maybe Name already has this value');
		}

		// Default view
	    $data = DB::connection('sqlsrv')->select("SELECT * FROM zradnices ORDER BY z_number desc");
	    return view('zradnice.index', compact('data'));

	}

}
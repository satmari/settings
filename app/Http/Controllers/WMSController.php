<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

use Request;

/*
namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
*/


use App\WMS_nothu;
use App\WMS_hu;
use DB;

use Session;

class WMSController extends Controller {

	public function index()
	{
		//
		return view('WMS.index');
	}

	public function remove_nothu()
	{
		//
		return view('WMS.remove_nothu');
	}

	public function remove_hu()
	{
		//
		return view('WMS.remove_hu');
	}

	public function removed_nothu()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM w_m_s_nothus ORDER BY id desc"));
		return view('WMS.removed_nothu', compact('data'));
	}

	public function removed_hu()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM w_m_s_hus ORDER BY id desc"));
		return view('WMS.removed_hu', compact('data'));
	}

	public function postImportNOTHU(Request $request) {

	    $getSheetName = Excel::load(Request::file('file1'))->getSheetNames();

	    foreach($getSheetName as $sheetName)
	    {
	        //if ($sheetName === 'Product-General-Table')  {
	    	//selectSheetsByIndex(0)
	           	// DB::statement('SET FOREIGN_KEY_CHECKS=0;');
	            // DB::table('users')->truncate();
				// DB::statement('SET FOREIGN_KEY_CHECKS=1;');

	            //Excel::selectSheets($sheetName)->load($request->file('file'), function ($reader)
	            //Excel::selectSheets($sheetName)->load(Input::file('file'), function ($reader)
	            //Excel::filter('chunk')->selectSheetsByIndex(0)->load(Request::file('file'))->chunk(50, function ($reader)
	            Excel::filter('chunk')->selectSheets($sheetName)->load(Request::file('file1'))->chunk(50, function ($reader)
	            
	            {
	                $readerarray = $reader->toArray();
	                // var_dump($readerarray);

	                foreach($readerarray as $row)
	                {
	                	try {

	                	$table = new WMS_nothu;

						$table->nothu = $row['nothu'];
						$table->qty = $row['qty'];
						$table->status = "imported";
												
						$table->save();

						}
						catch (\Illuminate\Database\QueryException $e) {
							$msg = "Problem to save in WMS_nothu table";
							return view('WMS.error',compact('msg'));
						}
	                }
	            });
	    }
		return redirect('/removed_nothu');
	}

	public function postImportHU(Request $request) {

	    $getSheetName = Excel::load(Request::file('file2'))->getSheetNames();
	    
	    foreach($getSheetName as $sheetName)
	    {

	    	//if ($sheetName === 'Product-General-Table')  {
	    	//selectSheetsByIndex(0)
	           	// DB::statement('SET FOREIGN_KEY_CHECKS=0;');
	            // DB::table('users')->truncate();
				// DB::statement('SET FOREIGN_KEY_CHECKS=1;');

	            //Excel::selectSheets($sheetName)->load($request->file('file'), function ($reader)
	            //Excel::selectSheets($sheetName)->load(Input::file('file'), function ($reader)
	            //Excel::filter('chunk')->selectSheetsByIndex(0)->load(Request::file('file'))->chunk(50, function ($reader)
	            Excel::filter('chunk')->selectSheets($sheetName)->load(Request::file('file2'))->chunk(50, function ($reader)
	            
	            {
	                $readerarray = $reader->toArray();
	                //var_dump($readerarray);

	                foreach($readerarray as $row)
	                {
	                	try {

	                	$table = new WMS_hu;

						$table->hu = $row['hu'];
						$table->status = "imported";
												
						$table->save();
			
						}
						catch (\Illuminate\Database\QueryException $e) {
							$msg = "Problem to save in WMS_hu table";
							return view('WMS.error',compact('msg'));
						}
	                }
	            });
	    }
		return redirect('/removed_hu');
	}

	public function delete_nothu() {

		// dd("delete not hu");
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT id, nothu, qty FROM w_m_s_nothus WHERE status = 'imported' ORDER BY id desc"));
		// dd($data);


		if (isset($data[0])) {
			// dd($data);

			foreach ($data as $line) {
				// dd($line->nothu);


				$find = DB::connection('sqlsrv1')->select(DB::raw("SELECT 
				  [Entry No_] as line
				  FROM [Gordon_Live].[dbo].[GORDON\$Handling Unit]
  				  WHERE [HU No_] = '".$line->nothu."' AND Status = '0'  AND Balance >= '".$line->qty."' AND Quantity >= '".$line->qty."'
				  ORDER BY [Entry No_] ASC
				"));

				// dd($find[0]->line);

				if (isset($find[0]->line)) {

					$delete = DB::connection('sqlsrv1')->select(DB::raw("SET NOCOUNT ON;
																		DECLARE @RowCount1 INTEGER

						UPDATE [Gordon_Live].[dbo].[GORDON\$Handling Unit]
						SET Adjusted = '1', [Adjust Date] = CONVERT(VARCHAR(10),GETDATE(),101), [USER ID] = 'WMS_app' ,Balance = Balance - ".$line->qty." , Quantity = Quantity - ".$line->qty."
						WHERE [Entry No_] = '".$find[0]->line."' 

						SELECT @RowCount1 = @@ROWCOUNT
						SELECT @RowCount1 AS Table1"));

					// dd($delete[0]->Table1);

					if ($delete[0]->Table1 == "1") {
						$status = "updated";
					} elseif ($delete[0]->Table1 == "0") {
						$status = "not found";
					}

					try {

	            	$table = WMS_nothu::findOrFail($line->id);
					$table->status = $status;
					$table->save();
		
					}
					catch (\Illuminate\Database\QueryException $e) {
						$msg = "Problem to update in WMS_nothu table";
						return view('WMS.error',compact('msg'));
					}

				} else {
					try {

	            	$table = WMS_nothu::findOrFail($line->id);
					$table->status = "not found";
					$table->save();
		
					}
					catch (\Illuminate\Database\QueryException $e) {
						$msg = "Problem to update in WMS_nothu table";
						return view('WMS.error',compact('msg'));
					}

				}
			}

		} else {
			// dd("there is no hu with status imported");
			$msg = "There is no hu with status imported";
			return view('WMS.error',compact('msg'));
		}

		return redirect('/removed_nothu');
	}

	public function delete_hu() {

		// dd("delete hu");
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT id, hu FROM w_m_s_hus WHERE status = 'imported' ORDER BY id desc"));
		// dd($data);


		if (isset($data[0])) {
			// dd($data);

			foreach ($data as $line) {
				// dd($line->hu);

				$delete = DB::connection('sqlsrv1')->select(DB::raw("SET NOCOUNT ON;
																	DECLARE @RowCount1 INTEGER;

					UPDATE [Gordon_Live].[dbo].[GORDON\$Handling Unit]
					SET Adjusted = '1', [Adjust Date] = CONVERT(VARCHAR(10),GETDATE(),101), [USER ID] = 'WMS_app' ,Balance = '0' , Quantity = '0'
					WHERE [HU No_] = '".$line->hu."' and Balance > 0 and Status = 0

					SELECT @RowCount1 = @@ROWCOUNT
					SELECT @RowCount1 AS Table1"));		

				// dd($delete[0]->Table1);

				if ($delete[0]->Table1 == "1") {
					$status = "updated";
				} elseif ($delete[0]->Table1 == "0") {
					$status = "not found";
				}

				try {

            	$table = WMS_hu::findOrFail($line->id);
				$table->status = $status;
				$table->save();
	
				}
				catch (\Illuminate\Database\QueryException $e) {
					$msg = "Problem to update in WMS_hu table";
					return view('WMS.error',compact('msg'));
				}
			}

		} else {
			// dd("there is no hu with status imported");
			$msg = "There is no hu with status imported";
			return view('WMS.error',compact('msg'));
		}

		return redirect('/removed_hu');
	}
}	

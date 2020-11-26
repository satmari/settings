<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\temp_machines;
use App\log_machine;
use DB;

use Session;

class machinesController extends Controller {

	public function index()
	{
		//
		return view('Machines.index');
	}

	public function transferg_k_get() {

		$path = 'S_K';
		$osarray = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM  temp_machines WHERE path = '".$path."' "));

		if (isset($osarray[0]->os)) {
			// dd($osarray);
		}


		return view('Machines.transferg_k', compact('osarray'));
	}

	public function transferg_k(Request $request) {
		//
		// $this->validate($request, ['rnumber'=>'required','activity'=>'required']);

		$input = $request->all(); 
		// dd($input);

		$path = 'S_K';

		if (isset($input['osnumber'])) {
			$osnumber = strtoupper($input['osnumber']);
			// dd($osnumber);


			// if already exist in temp db
			$temp = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM temp_machines WHERE os = '".$osnumber."' AND path = '".$path."' "));
			if (!isset($temp[0]->os)) {
				// dd('ne postoji u temp bazi');

				$machine =  DB::connection('sqlsrv2')->select(DB::raw("SELECT MachNum FROM [BdkCLZG].[dbo].[CNF_MachPool]
				  WHERE MachNum = '".$osnumber."'
				  UNION
				  SELECT MachNum FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_MachPool]
				  WHERE MachNum =  '".$osnumber."'
				  "));

				if (isset($machine[0]->MachNum) AND ($machine[0]->MachNum != '')) {
					// dd($machine);

					try {
						$table = new temp_machines;

						$table->os = $machine[0]->MachNum;
						$table->path = $path;
												
						$table->save();
					}
					catch (\Illuminate\Database\QueryException $e) {
						$msg = "Problem to save in table";
						return view('Machines.error',compact('msg'));
					}			

				} else {

					$msg1 = 'Nije pronadjen OS broj u Inteosu!';
					$osarray = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM  temp_machines WHERE path = '".$path."' "));

					return view('Machines.transferg_k', compact('osarray', 'msg1'));

				}

			}


		}
		
		$osarray = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM  temp_machines WHERE path = '".$path."' "));

		if (isset($osarray[0]->os)) {
			// dd($osarray);
		}


		// $osarray = [['os']['test']];
		return view('Machines.transferg_k', compact('osarray'));
	}

	public function transferg_k_post(Request $request) {


		$path = 'S_K';
		$osarray = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM  temp_machines WHERE path = '".$path."' "));

		if (isset($osarray[0]->os)) {
			// dd($osarray);

			foreach ($osarray as $os) {
				// var_dump($os);
				// dd($os->os);

				// Unlink machine from line in Gordon 
				$sql = DB::connection('sqlsrv2')->select(DB::raw("SET NOCOUNT ON;
	        		  UPDATE [BdkCLZG].[dbo].[CNF_ModMach]
					  SET [MaStat] = 0, [MdCod] = NULL WHERE [MdCod] IN
					  (SELECT [Cod] FROM [BdkCLZG].[dbo].[CNF_MachPool] WHERE [MachNum] IN ('".$os->os."'))
					  SELECT TOP 1 [Cod] FROM [BdkCLZG].[dbo].[CNF_MachPool];
			   "));
				
				
				// Deactivate machine in Gordon
				$sql = DB::connection('sqlsrv2')->select(DB::raw("SET NOCOUNT ON;
	        		  UPDATE [BdkCLZG].[dbo].[CNF_MachPool] SET [NotAct] = 1, [InRepair] = NULL WHERE [MachNum] IN ('".$os->os."');
					  SELECT TOP 1 [Cod] FROM [BdkCLZG].[dbo].[CNF_MachPool];
			   "));
				
				
				// Unlink machine from line in Kikinda
				$sql = DB::connection('sqlsrv2')->select(DB::raw("SET NOCOUNT ON;
	        		  UPDATE [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_ModMach]
					  SET [MaStat] = 0, [MdCod] = NULL WHERE [MdCod] IN
					  (SELECT [Cod] FROM  [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_MachPool] WHERE [MachNum] IN ('".$os->os."'))
					  SELECT TOP 1 [Cod] FROM  [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_MachPool];
			   "));


				// Activate machine in Kikida
				$sql = DB::connection('sqlsrv2')->select(DB::raw("SET NOCOUNT ON;
	        		  UPDATE [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_MachPool] SET [NotAct] = NULL, [InRepair] = NULL WHERE [MachNum] IN ('".$os->os."');
					  SELECT TOP 1 [Cod] FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_MachPool];
			   "));
				
				//Delete from temp rable
				$sql = DB::connection('sqlsrv')->select(DB::raw("SET NOCOUNT ON;
						DELETE
						FROM temp_machines
						WHERE os = '".$os->os."' AND path = '".$path."';
						SELECT TOP 1 id FROM temp_machines;
    			"));

				// Add to Log table
				$table = new log_machine;
				$table->os = $os->os;
				$table->path = $path;
				$table->save();

			}


		} else {
			$msg1 = 'Lista za transfer je prazna!';
			$osarray = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM  temp_machines WHERE path = '".$path."' "));

			return view('Machines.transferg_k', compact('osarray', 'msg1'));

		}

		
		$osarray = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM  temp_machines WHERE path = '".$path."' "));
		$msg4 = 'Transferovanje masina uspesno izvrseno iz Subotice u Kikindu';
		return view('Machines.transferg_k', compact('osarray', 'msg4'));

	}

	public function transferg_k_delete($os) {
		
		// dd($os);
		$path = 'S_K';
		$delete = DB::connection('sqlsrv')->select(DB::raw("SET NOCOUNT ON;DELETE FROM temp_machines WHERE os = '".$os."' AND path = '".$path."'; SELECT TOP 1 id FROM temp_machines"));
		

		$osarray = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM  temp_machines WHERE path = '".$path."' "));
		return view('Machines.transferg_k', compact('osarray'));
	}

	//--------------------------

	public function transferk_g_get() {

		$path = 'K_S';
		$osarray = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM  temp_machines WHERE path = '".$path."' "));

		if (isset($osarray[0]->os)) {
			// dd($osarray);
		}


		return view('Machines.transferk_g', compact('osarray'));
	}

	public function transferk_g(Request $request) {
		//
		// $this->validate($request, ['rnumber'=>'required','activity'=>'required']);

		$input = $request->all(); 
		// dd($input);

		$path = 'K_S';

		if (isset($input['osnumber'])) {
			$osnumber = strtoupper($input['osnumber']);
			// dd($osnumber);


			// if already exist in temp db
			$temp = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM temp_machines WHERE os = '".$osnumber."' AND path = '".$path."' "));
			if (!isset($temp[0]->os)) {
				// dd('ne postoji u temp bazi');

				$machine =  DB::connection('sqlsrv2')->select(DB::raw("SELECT MachNum FROM [BdkCLZG].[dbo].[CNF_MachPool]
				  WHERE MachNum = '".$osnumber."'
				  UNION
				  SELECT MachNum FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_MachPool]
				  WHERE MachNum =  '".$osnumber."'
				  "));

				if (isset($machine[0]->MachNum) AND ($machine[0]->MachNum != '')) {
					// dd($machine);

					try {
						$table = new temp_machines;

						$table->os = $machine[0]->MachNum;
						$table->path = $path;
												
						$table->save();
					}
					catch (\Illuminate\Database\QueryException $e) {
						$msg = "Problem to save in table";
						return view('Machines.error',compact('msg'));
					}			

				} else {

					$msg1 = 'Nije pronadjen OS broj u Inteosu!';
					$osarray = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM  temp_machines WHERE path = '".$path."' "));

					return view('Machines.transferk_g', compact('osarray', 'msg1'));

				}

			}


		}
		
		$osarray = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM  temp_machines WHERE path = '".$path."' "));

		if (isset($osarray[0]->os)) {
			// dd($osarray);
		}


		// $osarray = [['os']['test']];
		return view('Machines.transferk_g', compact('osarray'));
	}

	public function transferk_g_post(Request $request) {


		$path = 'K_S';
		$osarray = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM  temp_machines WHERE path = '".$path."' "));

		if (isset($osarray[0]->os)) {
			// dd($osarray);

			foreach ($osarray as $os) {
				// var_dump($os);
				// dd($os->os);

				// Unlink machine from line in Kikinda
				$sql = DB::connection('sqlsrv2')->select(DB::raw("SET NOCOUNT ON;
	        		  UPDATE [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_ModMach]
					  SET [MaStat] = 0, [MdCod] = NULL WHERE [MdCod] IN
					  (SELECT [Cod] FROM  [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_MachPool] WHERE [MachNum] IN ('".$os->os."'))
					  SELECT TOP 1 [Cod] FROM  [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_MachPool];
			   "));

				// Deactivate machine in Kikida
				$sql = DB::connection('sqlsrv2')->select(DB::raw("SET NOCOUNT ON;
	        		  UPDATE [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_MachPool] SET [NotAct] = 1, [InRepair] = NULL WHERE [MachNum] IN ('".$os->os."');
					  SELECT TOP 1 [Cod] FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_MachPool];
			   "));
				
				
				// Unlink machine from line in Gordon 
				$sql = DB::connection('sqlsrv2')->select(DB::raw("SET NOCOUNT ON;
	        		  UPDATE [BdkCLZG].[dbo].[CNF_ModMach]
					  SET [MaStat] = 0, [MdCod] = NULL WHERE [MdCod] IN
					  (SELECT [Cod] FROM [BdkCLZG].[dbo].[CNF_MachPool] WHERE [MachNum] IN ('".$os->os."'))
					  SELECT TOP 1 [Cod] FROM [BdkCLZG].[dbo].[CNF_MachPool];
			   "));

				// Activate machine in Gordon
				$sql = DB::connection('sqlsrv2')->select(DB::raw("SET NOCOUNT ON;
	        		  UPDATE [BdkCLZG].[dbo].[CNF_MachPool] SET [NotAct] = NULL, [InRepair] = NULL WHERE [MachNum] IN ('".$os->os."');
					  SELECT TOP 1 [Cod] FROM [BdkCLZG].[dbo].[CNF_MachPool];
			   "));

								
				//Delete from temp rable
				$sql = DB::connection('sqlsrv')->select(DB::raw("SET NOCOUNT ON;
						DELETE
						FROM temp_machines
						WHERE os = '".$os->os."' AND path = '".$path."';
						SELECT TOP 1 id FROM temp_machines;
    			"));

    			// Add to Log table
				$table = new log_machine;
				$table->os = $os->os;
				$table->path = $path;
				$table->save();

			}


		} else {
			$msg1 = 'Lista za transfer je prazna!';
			$osarray = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM  temp_machines WHERE path = '".$path."' "));

			return view('Machines.transferk_g', compact('osarray', 'msg1'));

		}

		
		$osarray = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM  temp_machines WHERE path = '".$path."' "));
		$msg4 = 'Transferovanje masina uspesno izvrseno iz Kikinde u Suboticu';
		return view('Machines.transferk_g', compact('osarray', 'msg4'));

	}

	public function transferk_g_delete($os) {
		
		// dd($os);
		$path = 'K_S';
		$delete = DB::connection('sqlsrv')->select(DB::raw("SET NOCOUNT ON;DELETE FROM temp_machines WHERE os = '".$os."' AND path = '".$path."'; SELECT TOP 1 id FROM temp_machines"));
		

		$osarray = DB::connection('sqlsrv')->select(DB::raw("SELECT os, path FROM  temp_machines WHERE path = '".$path."' "));
		return view('Machines.transferk_g', compact('osarray'));
	}

	//----------------------------------

	public function machines_table() {

		
		$os = DB::connection('sqlsrv2')->select(DB::raw("SELECT mp.MachNum
		
		,mt.Brand
		,mt.MaTyp
		,mt.MaCod
		
		--,mp.NotAct
		,(CASE WHEN mp.NotAct = 1 THEN 'OFF' ELSE 'ON' END) as Subotica_main_status
		--,(SELECT NotAct FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_MachPool] WHERE MachNum = mp.MachNum) as KikNotAct
		,(CASE WHEN (SELECT NotAct FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_MachPool] WHERE MachNum = mp.MachNum) = 1 THEN 'OFF' ELSE 'ON' END) as Kikinda_main_status
		
		--,(SELECT [MaStat] FROM [BdkCLZG].[dbo].[CNF_ModMach] WHERE MdCod = mp.Cod) as Subotica_status1
		,(CASE 
			
			WHEN (SELECT [MaStat] FROM [BdkCLZG].[dbo].[CNF_ModMach] WHERE MdCod = mp.Cod) is null THEN --'test'
			
				( 
				CASE
				WHEN  (SELECT [InRepair] FROM [BdkCLZG].[dbo].[CNF_MachPool] WHERE [Cod] = mp.Cod) IS NOT NULL THEN 'In Repair'
				WHEN  (SELECT [InRepair] FROM [BdkCLZG].[dbo].[CNF_MachPool] WHERE [Cod] = mp.Cod) IS NULL THEN 'Available' 
				END
				 ) 
			
			WHEN (SELECT [MaStat] FROM [BdkCLZG].[dbo].[CNF_ModMach] WHERE MdCod = mp.Cod) = 0 THEN 'Spare'
			WHEN (SELECT [MaStat] FROM [BdkCLZG].[dbo].[CNF_ModMach] WHERE MdCod = mp.Cod) = 1 THEN 'Needed'
			WHEN (SELECT [MaStat] FROM [BdkCLZG].[dbo].[CNF_ModMach] WHERE MdCod = mp.Cod) = 4 THEN 'Ready for next change'
			WHEN (SELECT [MaStat] FROM [BdkCLZG].[dbo].[CNF_ModMach] WHERE MdCod = mp.Cod) = 5 THEN 'On stock'
			WHEN (SELECT [MaStat] FROM [BdkCLZG].[dbo].[CNF_ModMach] WHERE MdCod = mp.Cod) = 6 THEN 'To be repaired'
			
		 END) as Subotica_status
		 
		 ,(CASE 
			
			WHEN (SELECT [MaStat] FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_ModMach] WHERE MdCod = mp.Cod) is null THEN --'test'
			
				( 
				CASE
				WHEN  (SELECT [InRepair] FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_MachPool] WHERE [Cod] = mp.Cod) IS NOT NULL THEN 'In Repair'
				WHEN  (SELECT [InRepair] FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_MachPool] WHERE [Cod] = mp.Cod) IS NULL THEN 'Available' 
				END
				 ) 
			
			WHEN (SELECT [MaStat] FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_ModMach] WHERE MdCod = mp.Cod) = 0 THEN 'Spare'
			WHEN (SELECT [MaStat] FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_ModMach] WHERE MdCod = mp.Cod) = 1 THEN 'Needed'
			WHEN (SELECT [MaStat] FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_ModMach] WHERE MdCod = mp.Cod) = 4 THEN 'Ready for next change'
			WHEN (SELECT [MaStat] FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_ModMach] WHERE MdCod = mp.Cod) = 5 THEN 'On stock'
			WHEN (SELECT [MaStat] FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_ModMach] WHERE MdCod = mp.Cod) = 6 THEN 'To be repaired'
			
		 END) as Kikinda_status
		 
		 ,(SELECT m.[ModNam] FROM [BdkCLZG].[dbo].[CNF_ModMach] as mm 
			RIGHT JOIN [BdkCLZG].[dbo].[CNF_Modules] as m ON m.[Module] = mm.Module
			WHERE mm.MdCod = mp.Cod) as Subotica_line
		 
		 ,(SELECT m.[ModNam] FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_ModMach] as mm 
			RIGHT JOIN [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_Modules] as m ON m.[Module] = mm.Module
			WHERE mm.MdCod = mp.Cod) as Kikinda_line
		 
		 ,(SELECT Pos FROM [BdkCLZG].[dbo].[CNF_ModMach] as mm WHERE mm.MdCod = mp.Cod) as Subotica_pos
		 ,(SELECT Pos FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_ModMach] as mm WHERE mm.MdCod = mp.Cod) as Kikinda_pos
		 
		
  FROM [BdkCLZG].[dbo].[CNF_MachPool] as mp
  LEFT JOIN [BdkCLZG].[dbo].[CNF_MaTypes] as mt ON mp.MaTyCod = mt.IntKey
  WHERE MachNum != ''
  ORDER BY MachNum ASC

			"));

		// dd($os);
		return view('Machines.machines_table', compact('os'));

	}
	

	


}

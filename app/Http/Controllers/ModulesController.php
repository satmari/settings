<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Modules;
use DB;

use Session;

class ModulesController extends Controller {

	public function index()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM modules ORDER BY sort_order asc"));
		return view('Modules.index', compact('data'));
	}

	public function add_module () {
		//

		$operators = DB::connection('sqlsrv2')->select(DB::raw("SELECT [BadgeNum] as rnumber,[Name] as name
		  FROM [BdkCLZG].[dbo].[WEA_PersData]
		  WHERE [FlgAct] = '1'
		  ORDER BY BadgeNum asc "));


		return view('Modules.add_module', compact('operators'));
	}

	public function insert_module (Request $request) {
		
		//
		$this->validate($request, ['module' => 'required' ,'sort_order' => 'required','row' => 'required','column_group' => 'required','sector' => 'required','workstudy' => 'required', 'line_leader' => 'required', 'supervisor' => 'required' ,'team' => 'required']);
		// $this->validate($request, ['module' => 'required']);
		$input = $request->all();

		// WORKSTUDY
		if (!empty($input['workstudy']) && strtolower($input['workstudy']) !== 'no') {
		    $work = explode(' ', $input['workstudy'], 2);
		    $workstudy_r = trim($work[0]);
		    $workstudy = isset($work[1]) ? trim($work[1]) : '';
		} else {
		    $workstudy_r = 'no';
		    $workstudy = 'no';
		}

		// LINE LEADER
		if (!empty($input['line_leader']) && strtolower($input['line_leader']) !== 'no') {
		    $leader = explode(' ', $input['line_leader'], 2);
		    $line_leader_r = trim($leader[0]);
		    $line_leader = isset($leader[1]) ? trim($leader[1]) : '';
		} else {
		    $line_leader_r = 'no';
		    $line_leader = 'no';
		}

		// SUPERVISOR
		if (!empty($input['supervisor']) && strtolower($input['supervisor']) !== 'no') {
		    $super = explode(' ', $input['supervisor'], 2);
		    $supervisor_r = trim($super[0]);
		    $supervisor = isset($super[1]) ? trim($super[1]) : '';
		} else {
		    $supervisor_r = 'no';
		    $supervisor = 'no';
		}

		// dd($supervisor);


		try {
			$table = new Modules;

			$table->module = $input['module'];
			$table->sort_order = $input['sort_order'];
			$table->row = $input['row'];
			$table->column_group = $input['column_group'];
			$table->sector = $input['sector'];
			$table->workstudy = $workstudy;
			$table->workstudy_r = $workstudy_r;
			$table->line_leader = $line_leader;
			$table->line_leader_r = $line_leader_r;
			$table->supervisor = $supervisor;
			$table->supervisor_r = $supervisor_r;
			$table->team = $input['team'];
			$table->linekey = $input['module']."_".$input['team'];
			
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in modules table";
			return view('Modules.error',compact('msg'));
		}

		return Redirect::to('/modules');
	}

	public function edit_module ($id) {
		
		//
		$operators = DB::connection('sqlsrv2')->select(DB::raw("SELECT [BadgeNum] as rnumber,[Name] as name
		  FROM [BdkCLZG].[dbo].[WEA_PersData]
		  WHERE [FlgAct] = '1'
		  ORDER BY BadgeNum asc "));

		$data = Modules::findOrFail($id);	
		// dd($data);


		return view('Modules.edit_module', compact('data', 'operators'));
	}

	public function update_module ($id, Request $request) {

		//
		$this->validate($request, ['module' => 'required' ,'sort_order' => 'required','row' => 'required','column_group' => 'required','sector' => 'required','workstudy' => 'required', 'line_leader' => 'required', 'supervisor'=> 'required', 'team' => 'required']);
		// $this->validate($request, ['module' => 'required']);
		$input = $request->all();

		// WORKSTUDY
		if (!empty($input['workstudy']) && strtolower($input['workstudy']) !== 'no') {
		    if ($input['workstudy'] == 'Replacement') {
		        $workstudy_r = 'Replacement';
		        $workstudy = 'Replacement';
		    } elseif (strpos($input['workstudy'], ' ') !== false) {
		        $work = explode(' ', $input['workstudy'], 2);
		        $workstudy_r = trim($work[0]);
		        $workstudy = isset($work[1]) ? trim($work[1]) : '';
		    } else {
		        $workstudy_r = $input['workstudy'];
		        $workstudy = '';
		    }
		} else {
		    $workstudy_r = 'no';
		    $workstudy = 'no';
		}

		// LINE LEADER
		if (!empty($input['line_leader']) && strtolower($input['line_leader']) !== 'no') {
		    if ($input['line_leader'] == 'Replacement') {
		        $line_leader_r = 'Replacement';
		        $line_leader = 'Replacement';
		    } elseif (strpos($input['line_leader'], ' ') !== false) {
		        $leader = explode(' ', $input['line_leader'], 2);
		        $line_leader_r = trim($leader[0]);
		        $line_leader = isset($leader[1]) ? trim($leader[1]) : '';
		    } else {
		        $line_leader_r = $input['line_leader'];
		        $line_leader = '';
		    }
		} else {
		    $line_leader_r = 'no';
		    $line_leader = 'no';
		}


		// SUPERVISOR
		if (!empty($input['supervisor']) && strtolower($input['supervisor']) !== 'no') {
		    if ($input['supervisor'] == 'Replacement') {
		        $supervisor_r = 'Replacement';
		        $supervisor = 'Replacement';
		    } elseif (strpos($input['supervisor'], ' ') !== false) {
		        $super = explode(' ', $input['supervisor'], 2);
		        $supervisor_r = trim($super[0]);
		        $supervisor = isset($super[1]) ? trim($super[1]) : '';
		    } else {
		        // no space, and not 'Replacment', so assign all to supervisor_r and empty supervisor
		        $supervisor_r = $input['supervisor'];
		        $supervisor = '';
		    }
		} else {
		    $supervisor_r = 'no';
		    $supervisor = 'no';
		}

		$table = Modules::findOrFail($id);

		try {

			$table->module = $input['module'];
			$table->sort_order = $input['sort_order'];
			$table->row = $input['row'];
			$table->column_group = $input['column_group'];
			$table->sector = $input['sector'];
			$table->workstudy = $workstudy;
			$table->workstudy_r = $workstudy_r;
			$table->line_leader = $line_leader;
			$table->line_leader_r = $line_leader_r;
			$table->supervisor = $supervisor;
			$table->supervisor_r = $supervisor_r;
			$table->team = $input['team'];
			$table->linekey = $input['module']."_".$input['team'];
			
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save in modules table";
			return view('Modules.error',compact('msg'));
		}

		return Redirect::to('/modules');
	}

	
}

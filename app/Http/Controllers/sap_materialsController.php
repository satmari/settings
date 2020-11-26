<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;		// for scaning
// use Request;						// for import db 
use Illuminate\Support\Facades\Redirect;

use Session;
use Maatwebsite\Excel\Facades\Excel;

use App\sap_material;
use App\sap_material_stock;

use DB;
// use Carbon;

class sap_materialsController extends Controller {

	public function index() {

		return view('SAP_materials.index');
	}

	public function sap_import() {

		return view('SAP_materials.sap_import');	
	}

	public function sap_spare_all() {

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sap_materials WHERE material_type = 'RSSP' ORDER BY id asc"));
		return view('SAP_materials.sap_spare_all',compact('data'));
	}

	public function sap_cons_all() {

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sap_materials WHERE material_type = 'RSCM' ORDER BY id asc"));
		return view('SAP_materials.sap_cons_all',compact('data'));
	}

	public function sap_spare() {

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT 
			   mm.[material]
		      --,mm.[material_type]
		      ,(SELECT material_type FROM [settings].[dbo].[sap_materials] WHERE mm.material = material) as material_type
		      --,mm.[material_desc]
		      ,(SELECT material_desc FROM [settings].[dbo].[sap_materials] WHERE mm.material = material) as material_desc
		      --,mm.[material_res]
		      ,(SELECT material_res FROM [settings].[dbo].[sap_materials] WHERE mm.material = material) as material_res
		      
		      --,(SELECT SUM(qty) FROM [settings].[dbo].[sap_material_stocks] WHERE mm.material = material and storage_loc = '0102') as Subotica --_cons
		      ,(SELECT SUM(qty) FROM [settings].[dbo].[sap_material_stocks] WHERE mm.material = material and storage_loc = '0301') as Subotica --_spare
		      --,(SELECT SUM(qty) FROM [settings].[dbo].[sap_material_stocks] WHERE mm.material = material and storage_loc = '0112') as Kikinda --_cons
		      ,(SELECT SUM(qty) FROM [settings].[dbo].[sap_material_stocks] WHERE mm.material = material and storage_loc = '0311') as Kikinda --_spare

		      ,(SELECT TOP 1 uom FROM [settings].[dbo].[sap_materials] WHERE mm.material = material) as uom
		      
		      ,(SELECT COUNT(sn) FROM [settings].[dbo].[sap_material_useds] WHERE mm.material = material and status = 'AVLB' ) as spare_used
		      ,(SELECT COUNT(sn) FROM [settings].[dbo].[sap_material_useds] WHERE mm.material = material and status = 'ESTO' ) as spare_new
		      
		  FROM [settings].[dbo].[sap_materials] as mm
		  LEFT JOIN [settings].[dbo].[sap_material_stocks] as ms ON ms.material = mm.material
		  WHERE mm.material_type = 'RSSP'
		  GROUP BY 
			mm.[material]"));

		$update = DB::connection('sqlsrv')->select(DB::raw("SELECT TOP 1 updated_at FROM sap_material_stocks  ORDER BY updated_at desc"));		
		// dd($update);

		if (isset($update[0]->updated_at)) {
			$updatedat = $update[0]->updated_at;
		} else {
			$updatedat = 'no info';
		}

		return view('SAP_materials.sap_spare',compact('data','updatedat'));
	}

	public function sap_cons() {

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT 
			   mm.[material]
		      --,mm.[material_type]
		      ,(SELECT material_type FROM [settings].[dbo].[sap_materials] WHERE mm.material = material) as material_type
		      --,mm.[material_desc]
		      ,(SELECT material_desc FROM [settings].[dbo].[sap_materials] WHERE mm.material = material) as material_desc
		      --,mm.[material_res]
		      ,(SELECT material_res FROM [settings].[dbo].[sap_materials] WHERE mm.material = material) as material_res
		      
		      ,(SELECT SUM(qty) FROM [settings].[dbo].[sap_material_stocks] WHERE mm.material = material and storage_loc = '0102') as Subotica --_cons
		      --,(SELECT SUM(qty) FROM [settings].[dbo].[sap_material_stocks] WHERE mm.material = material and storage_loc = '0301') as Subotica --_spare
		      ,(SELECT SUM(qty) FROM [settings].[dbo].[sap_material_stocks] WHERE mm.material = material and storage_loc = '0112') as Kikinda --_cons
		      --,(SELECT SUM(qty) FROM [settings].[dbo].[sap_material_stocks] WHERE mm.material = material and storage_loc = '0311') as Kikinda --_spare

		      ,(SELECT TOP 1 uom FROM [settings].[dbo].[sap_materials] WHERE mm.material = material) as uom
		      
		  FROM [settings].[dbo].[sap_materials] as mm
		  LEFT JOIN [settings].[dbo].[sap_material_stocks] as ms ON ms.material = mm.material
		  WHERE mm.material_type = 'RSCM'
		  GROUP BY 
			mm.[material]"));

		$update = DB::connection('sqlsrv')->select(DB::raw("SELECT TOP 1 updated_at FROM sap_material_stocks  ORDER BY updated_at desc"));		
		// dd($update);

		if (isset($update[0]->updated_at)) {
			$updatedat = $update[0]->updated_at;
		} else {
			$updatedat = 'no info';
		}

		return view('SAP_materials.sap_cons',compact('data','updatedat'));
	}

	public function sap_mech() {

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT 
			   mm.[material]
		      --,mm.[material_type]
		      ,(SELECT material_type FROM [settings].[dbo].[sap_materials] WHERE mm.material = material) as material_type
		      --,mm.[material_desc]
		      ,(SELECT material_desc FROM [settings].[dbo].[sap_materials] WHERE mm.material = material) as material_desc
		      --,mm.[material_res]
		      ,(SELECT material_res FROM [settings].[dbo].[sap_materials] WHERE mm.material = material) as material_res
		      
		      --,(SELECT SUM(qty) FROM [settings].[dbo].[sap_material_stocks] WHERE mm.material = material and storage_loc = '0102') as Subotica --_cons
		      --,(SELECT SUM(qty) FROM [settings].[dbo].[sap_material_stocks] WHERE mm.material = material and storage_loc = '0301') as Subotica --_spare
		      --,(SELECT SUM(qty) FROM [settings].[dbo].[sap_material_stocks] WHERE mm.material = material and storage_loc = '0112') as Kikinda --_cons
		      --,(SELECT SUM(qty) FROM [settings].[dbo].[sap_material_stocks] WHERE mm.material = material and storage_loc = '0311') as Kikinda --_spare
			
			  ,(CASE mm.[material_type]
				WHEN  'RSCM' THEN (SELECT SUM(qty) FROM [settings].[dbo].[sap_material_stocks] WHERE mm.material = material) 
				WHEN  'RSSP' THEN (SELECT count(material) FROM [settings].[dbo].[sap_material_useds] WHERE mm.material = material)
				END) as qty
				
			  --,(SELECT SUM(qty) FROM [settings].[dbo].[sap_material_stocks] WHERE mm.material = material) as Cons_Qty
			  
			  --,(SELECT count(material) FROM [settings].[dbo].[sap_material_useds] WHERE mm.material = material) as Spare_Qty
			  
			  
		      ,(SELECT TOP 1 uom FROM [settings].[dbo].[sap_materials] WHERE mm.material = material) as uom
		      
		  FROM [settings].[dbo].[sap_materials] as mm
		  LEFT JOIN [settings].[dbo].[sap_material_stocks] as ms ON ms.material = mm.material
		  --WHERE mm.material_type = 'RSCM'
		  GROUP BY 
			mm.[material]
			,mm.[material_type]

			"));

		$update = DB::connection('sqlsrv')->select(DB::raw("SELECT TOP 1 updated_at FROM sap_material_stocks  ORDER BY updated_at desc"));		
		// dd($update);

		if (isset($update[0]->updated_at)) {
			$updatedat = $update[0]->updated_at;
		} else {
			$updatedat = 'no info';
		}

		return view('SAP_materials.sap_mech',compact('data','updatedat'));

	}




}

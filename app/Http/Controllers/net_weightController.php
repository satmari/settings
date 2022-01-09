<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;		// for scaning
// use Request;						// for import db 
use Illuminate\Support\Facades\Redirect;

use Session;
use Maatwebsite\Excel\Facades\Excel;

use App\net_weight_comparison;
// use App\sap_material_stock;

use DB;

class net_weightController extends Controller {

	public function index()
	{
		//
		$data = DB::connection('sqlsrv2')->select(DB::raw("SELECT 
		s.StyCod
		,sku.Variant
		--,sku.NetWeight
		,REPLACE(LEFT(ISNULL(s.StyCod,'')+'____',9), '_', ' ')+REPLACE(LEFT(ISNULL(LEFT(sku.[Variant], CHARINDEX('-', sku.[Variant]) - 1),'')+'____',4), '_', ' ')+REPLACE(LEFT(ISNULL(SUBSTRING(sku.Variant,CHARINDEX('-',sku.Variant)+1,LEN(sku.Variant)),'')+ '____',5), '_', ' ') as int_sku
		,sku.NetWeight as int_weight
		,snw.material as sap_material
		,snw.net_weight as sap_net_weight
		,box.[material] as box_sku
		,box.[weight_of_pcs] as box_weight
	    ,box.[weight_of_polybag]as box_weight_poly
	    ,box.brand
		
		  FROM [BdkCLZG].[dbo].[CNF_SKU] as sku
		  JOIN [BdkCLZG].[dbo].[CNF_STYLE] as s ON s.INTKEY = sku.STYKEY
		  LEFT JOIN [SBT-SQLDB01Q].[settings].[dbo].[box_settings] as box ON box.style = s.StyCod COLLATE Latin1_General_CI_AS AND (box.color+'-'+box.size) = sku.Variant COLLATE Latin1_General_CI_AS
		  LEFT JOIN [SBT-SQLDB01Q].[settings].[dbo].[net_weight_sap] as snw ON snw.material = REPLACE(LEFT(ISNULL(s.StyCod,'')+'____',9), '_', ' ')+REPLACE(LEFT(ISNULL(LEFT(sku.[Variant], CHARINDEX('-', sku.[Variant]) - 1),'')+'____',4), '_', ' ')+REPLACE(LEFT(ISNULL(SUBSTRING(sku.Variant,CHARINDEX('-',sku.Variant)+1,LEN(sku.Variant)),'')+ '____',5), '_', ' ') COLLATE Latin1_General_CI_AS
		  WHERE s.StyCod <> '00000'
		  
		  UNION 
		  
		  SELECT 
		sk.StyCod
		,skuk.Variant
		--,skuk.NetWeight
		,REPLACE(LEFT(ISNULL(sk.StyCod,'')+'____',9), '_', ' ')+REPLACE(LEFT(ISNULL(LEFT(skuk.[Variant], CHARINDEX('-', skuk.[Variant]) - 1),'')+'____',4), '_', ' ')+REPLACE(LEFT(ISNULL(SUBSTRING(skuk.Variant,CHARINDEX('-',skuk.Variant)+1,LEN(skuk.Variant)),'')+ '____',5), '_', ' ') as int_sku
		,skuk.NetWeight as int_weight
		,snw.material as sap_material
		,snw.net_weight as sap_net_weight
		,box.[material] as box_sku
		,box.[weight_of_pcs] as box_weight
	    ,box.[weight_of_polybag]as box_weight_poly
	    ,box.brand
	   
		
		  FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_SKU] as skuk
		  JOIN [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_STYLE] as sk ON sk.INTKEY = skuk.STYKEY
		  LEFT JOIN [SBT-SQLDB01Q].[settings].[dbo].[box_settings] as box ON box.style = sk.StyCod COLLATE Latin1_General_CI_AS AND (box.color+'-'+box.size) = skuk.Variant COLLATE Latin1_General_CI_AS
		  LEFT JOIN [SBT-SQLDB01Q].[settings].[dbo].[net_weight_sap] as snw ON snw.material = REPLACE(LEFT(ISNULL(sk.StyCod,'')+'____',9), '_', ' ')+REPLACE(LEFT(ISNULL(LEFT(skuk.[Variant], CHARINDEX('-', skuk.[Variant]) - 1),'')+'____',4), '_', ' ')+REPLACE(LEFT(ISNULL(SUBSTRING(skuk.Variant,CHARINDEX('-',skuk.Variant)+1,LEN(skuk.Variant)),'')+ '____',5), '_', ' ') COLLATE Latin1_General_CI_AS
		  WHERE sk.StyCod <> '00000'
		"));
	
		// dd($data);

		return view('net_weight.index', compact('data'));
	}

	public function index_int()
	{
		//
		$data = DB::connection('sqlsrv2')->select(DB::raw("SELECT 
		--s.StyCod
		--,sku.Variant
		--,sku.NetWeight
		REPLACE(LEFT(ISNULL(s.StyCod,'')+'____',9), '_', ' ')+REPLACE(LEFT(ISNULL(LEFT(sku.[Variant], CHARINDEX('-', sku.[Variant]) - 1),'')+'____',4), '_', ' ')+REPLACE(LEFT(ISNULL(SUBSTRING(sku.Variant,CHARINDEX('-',sku.Variant)+1,LEN(sku.Variant)),'')+ '____',5), '_', ' ') as int_sku
		,sku.NetWeight as int_weight
		,snw.material as sap_material
		,snw.net_weight as sap_net_weight
		,box.[material] as box_sku
		,box.[weight_of_pcs] as box_weight
	    ,box.[weight_of_polybag]as box_weight_poly
	    ,box.brand
		
		  FROM [BdkCLZG].[dbo].[CNF_SKU] as sku
		  JOIN [BdkCLZG].[dbo].[CNF_STYLE] as s ON s.INTKEY = sku.STYKEY
		  LEFT JOIN [SBT-SQLDB01Q].[settings].[dbo].[box_settings] as box ON box.style = s.StyCod COLLATE Latin1_General_CI_AS AND (box.color+'-'+box.size) = sku.Variant COLLATE Latin1_General_CI_AS
		  LEFT JOIN [SBT-SQLDB01Q].[settings].[dbo].[net_weight_sap] as snw ON snw.material = REPLACE(LEFT(ISNULL(s.StyCod,'')+'____',9), '_', ' ')+REPLACE(LEFT(ISNULL(LEFT(sku.[Variant], CHARINDEX('-', sku.[Variant]) - 1),'')+'____',4), '_', ' ')+REPLACE(LEFT(ISNULL(SUBSTRING(sku.Variant,CHARINDEX('-',sku.Variant)+1,LEN(sku.Variant)),'')+ '____',5), '_', ' ') COLLATE Latin1_General_CI_AS
		  WHERE s.StyCod <> '00000'
		  
		  UNION 
		  
		  SELECT 
		--s.StyCod
		--,sku.Variant
		--,sku.NetWeight
		REPLACE(LEFT(ISNULL(sk.StyCod,'')+'____',9), '_', ' ')+REPLACE(LEFT(ISNULL(LEFT(skuk.[Variant], CHARINDEX('-', skuk.[Variant]) - 1),'')+'____',4), '_', ' ')+REPLACE(LEFT(ISNULL(SUBSTRING(skuk.Variant,CHARINDEX('-',skuk.Variant)+1,LEN(skuk.Variant)),'')+ '____',5), '_', ' ') as int_sku
		,skuk.NetWeight as int_weight
		,snw.material as sap_material
		,snw.net_weight as sap_net_weight
		,box.[material] as box_sku
		,box.[weight_of_pcs] as box_weight
	    ,box.[weight_of_polybag]as box_weight_poly
	    ,box.brand
	   
		
		  FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_SKU] as skuk
		  JOIN [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_STYLE] as sk ON sk.INTKEY = skuk.STYKEY
		  LEFT JOIN [SBT-SQLDB01Q].[settings].[dbo].[box_settings] as box ON box.style = sk.StyCod COLLATE Latin1_General_CI_AS AND (box.color+'-'+box.size) = skuk.Variant COLLATE Latin1_General_CI_AS
		  LEFT JOIN [SBT-SQLDB01Q].[settings].[dbo].[net_weight_sap] as snw ON snw.material = REPLACE(LEFT(ISNULL(sk.StyCod,'')+'____',9), '_', ' ')+REPLACE(LEFT(ISNULL(LEFT(skuk.[Variant], CHARINDEX('-', skuk.[Variant]) - 1),'')+'____',4), '_', ' ')+REPLACE(LEFT(ISNULL(SUBSTRING(skuk.Variant,CHARINDEX('-',skuk.Variant)+1,LEN(skuk.Variant)),'')+ '____',5), '_', ' ') COLLATE Latin1_General_CI_AS
		  WHERE sk.StyCod <> '00000'
		"));
	
		// dd($data);

		return view('net_weight.index_int', compact('data'));
	}

	public function save_in_table()	{

		

		$data = DB::connection('sqlsrv2')->select(DB::raw("SELECT 
		--s.StyCod
		--,sku.Variant
		--,sku.NetWeight
		REPLACE(LEFT(ISNULL(s.StyCod,'')+'____',9), '_', ' ')+REPLACE(LEFT(ISNULL(LEFT(sku.[Variant], CHARINDEX('-', sku.[Variant]) - 1),'')+'____',4), '_', ' ')+REPLACE(LEFT(ISNULL(SUBSTRING(sku.Variant,CHARINDEX('-',sku.Variant)+1,LEN(sku.Variant)),'')+ '____',5), '_', ' ') as int_sku
		,sku.NetWeight as int_weight
		,snw.material as sap_sku
		,snw.net_weight as sap_net_weight
		,box.[material] as box_sku
		,box.[weight_of_pcs] as box_weight
	    ,box.[weight_of_polybag]as box_weight_poly
	    ,box.brand
		
		  FROM [BdkCLZG].[dbo].[CNF_SKU] as sku
		  JOIN [BdkCLZG].[dbo].[CNF_STYLE] as s ON s.INTKEY = sku.STYKEY
		  LEFT JOIN [SBT-SQLDB01Q].[settings].[dbo].[box_settings] as box ON box.style = s.StyCod COLLATE Latin1_General_CI_AS AND (box.color+'-'+box.size) = sku.Variant COLLATE Latin1_General_CI_AS
		  LEFT JOIN [SBT-SQLDB01Q].[settings].[dbo].[net_weight_sap] as snw ON snw.material = REPLACE(LEFT(ISNULL(s.StyCod,'')+'____',9), '_', ' ')+REPLACE(LEFT(ISNULL(LEFT(sku.[Variant], CHARINDEX('-', sku.[Variant]) - 1),'')+'____',4), '_', ' ')+REPLACE(LEFT(ISNULL(SUBSTRING(sku.Variant,CHARINDEX('-',sku.Variant)+1,LEN(sku.Variant)),'')+ '____',5), '_', ' ') COLLATE Latin1_General_CI_AS
		  WHERE s.StyCod <> '00000'
		  
		  UNION 
		  
		  SELECT 
		--s.StyCod
		--,sku.Variant
		--,sku.NetWeight
		REPLACE(LEFT(ISNULL(sk.StyCod,'')+'____',9), '_', ' ')+REPLACE(LEFT(ISNULL(LEFT(skuk.[Variant], CHARINDEX('-', skuk.[Variant]) - 1),'')+'____',4), '_', ' ')+REPLACE(LEFT(ISNULL(SUBSTRING(skuk.Variant,CHARINDEX('-',skuk.Variant)+1,LEN(skuk.Variant)),'')+ '____',5), '_', ' ') as int_sku
		,skuk.NetWeight as int_weight
		,snw.material as sap_sku
		,snw.net_weight as sap_net_weight
		,box.[material] as box_sku
		,box.[weight_of_pcs] as box_weight
	    ,box.[weight_of_polybag]as box_weight_poly
	    ,box.brand
	   
		
		  FROM [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_SKU] as skuk
		  JOIN [172.27.161.221\INTEOSKKA].[BdkCLZKKA].[dbo].[CNF_STYLE] as sk ON sk.INTKEY = skuk.STYKEY
		  LEFT JOIN [SBT-SQLDB01Q].[settings].[dbo].[box_settings] as box ON box.style = sk.StyCod COLLATE Latin1_General_CI_AS AND (box.color+'-'+box.size) = skuk.Variant COLLATE Latin1_General_CI_AS
		  LEFT JOIN [SBT-SQLDB01Q].[settings].[dbo].[net_weight_sap] as snw ON snw.material = REPLACE(LEFT(ISNULL(sk.StyCod,'')+'____',9), '_', ' ')+REPLACE(LEFT(ISNULL(LEFT(skuk.[Variant], CHARINDEX('-', skuk.[Variant]) - 1),'')+'____',4), '_', ' ')+REPLACE(LEFT(ISNULL(SUBSTRING(skuk.Variant,CHARINDEX('-',skuk.Variant)+1,LEN(skuk.Variant)),'')+ '____',5), '_', ' ') COLLATE Latin1_General_CI_AS
		  WHERE sk.StyCod <> '00000'
		"));
		// dd($data);

		$data1 = DB::connection('sqlsrv')->select(DB::raw("
			SET NOCOUNT ON;
			TRUNCATE TABLE [settings].[dbo].[net_weight_comparisons];
			SELECT TOP 1 id FROM [settings].[dbo].[net_weight_comparisons];
		"));
	

		foreach ($data as $line) {
			
			$int_sku = $line->int_sku;
			$int_weight = $line->int_weight;
			$sap_sku = $line->sap_sku;
			$sap_weight = $line->sap_net_weight;
			$box_sku = $line->box_sku;
			$box_weight = $line->box_weight;
			$box_weight_poly = $line->box_weight_poly;
			$brand = $line->brand;

			// dd($brand);

			$table = new net_weight_comparison;
			$table->int_sku = $int_sku;
			$table->int_weight = round((float)$int_weight,3);
			$table->sap_sku = $sap_sku;
			$table->sap_weight = round((float)$sap_weight,3);
			$table->box_sku = $box_sku;
			$table->box_weight = round((float)$box_weight,3);
			$table->box_weight_poly = round((float)$box_weight_poly,3);
			$table->brand = $brand;

			$table->save();
		}


		return Redirect::to('/net_weight');



	}


	public function index_old()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT bs.[id]
      --,bs.[material]
      --,bs.[style]
      --,bs.[color]
      --,bs.[size]
      ,bs.[brand]
      ,bs.[weight_of_polybag]
      ,bs.[weight_of_pcs]
	 
	 --,REPLACE(LEFT(ISNULL(bs.style,'')+'____',9), '_', ' ') as sap_style
	 --,REPLACE(LEFT(ISNULL(bs.color,'')+'____',4), '_', ' ') as sap_color
	 --,REPLACE(LEFT(ISNULL(bs.size,'')+ '____',5), '_', ' ') as sap_size
	 
	  ,REPLACE(LEFT(ISNULL(bs.style,'')+'____',9), '_', ' ')+REPLACE(LEFT(ISNULL(bs.color,'')+'____',4), '_', ' ')+REPLACE(LEFT(ISNULL(bs.size,'')+ '____',5), '_', ' ') as sku_box
	 
	  --,s.StyCod as int_style
	  --,LEFT(sku.[Variant], CHARINDEX('-', sku.[Variant]) - 1) AS int_color
      --,SUBSTRING(sku.Variant,CHARINDEX('-',sku.Variant)+1,LEN(sku.Variant)) AS int_size
      ,REPLACE(LEFT(ISNULL(s.StyCod,'')+'____',9), '_', ' ')+REPLACE(LEFT(ISNULL(LEFT(sku.[Variant], CHARINDEX('-', sku.[Variant]) - 1),'')+'____',4), '_', ' ')+REPLACE(LEFT(ISNULL(SUBSTRING(sku.Variant,CHARINDEX('-',sku.Variant)+1,LEN(sku.Variant)),'')+ '____',5), '_', ' ') as sku_int
	  ,sku.NetWeight as int_net_weigth
	  
	  ,snw.material as sap_material
	  ,snw.net_weight as sap_net_weigth
		FROM [settings].[dbo].[box_settings] as bs
		RIGHT JOIN [SBT-SQLDB01P\INTEOS].[BdkCLZG].[dbo].[CNF_SKU] as sku ON sku.Variant COLLATE Latin1_General_CI_AS = bs.color+'-'+bs.size 
		RIGHT JOIN [SBT-SQLDB01P\INTEOS].[BdkCLZG].[dbo].[CNF_STYLE] as s ON s.INTKEY = sku.STYKEY AND s.StyCod COLLATE Latin1_General_CI_AS = bs.style
		RIGHT JOIN [settings].[dbo].[net_weight_sap] as snw ON snw.material = bs.material
		"));
	
		// dd($data);

		return view('net_weight.index', compact('data'));
	}



}

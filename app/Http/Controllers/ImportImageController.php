<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Maatwebsite\Excel\Facades\Excel;

// use Request; // for import
use Illuminate\Http\Request; // for image

use App\Ecommerce;
use App\Sizeset;
use App\User;
use App\Budget;
use App\FR_plan;
use App\Styles;
use App\Styles_extra;

use App\inventory;
use App\inventory_temp;

use App\inventory_wh;
use App\inventory_temp_wh;

use App\inventory_cut;
use App\inventory_temp_cut;

use App\inventory_p;
use App\inventory_temp_p;

use DB;
// use Carbon;

class ImportImageController extends Controller {

	public function upload_style_image(Request $request){


	  // dd('test');

      // $this->validate($request, [
      //   'file' => 'required|image:jpeg,png,jpg,bmp',
      // ]);

	 // dd($request);

	  $input = $request->all();
  	  $id = $input['id'];
	  
	  // dd($id);

      if ($request->hasFile('file')) {
        $image = $request->file('file');
        
        $old_name = $image->getClientOriginalName();
        $filename = pathinfo($old_name, PATHINFO_FILENAME);
        // dd($filename);
        // $old = str_replace($old_namel)

        // $name = $filename.'_'.time().'.'.$image->getClientOriginalExtension();
        $name = $filename.'_'.date("Y-m-d_his").'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/storage/StyleImages/');
        $image->move($destinationPath, $name);
        // $this->save();
        // return back()->with('success','Image Upload successfully');

        

		try {
			$table = Styles::findOrFail($id);
			$table->image = $name;
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			dd("Problem to save");
		}



        // dd('Upload successfully, file is:'.$name.' and style_id: '.$id);
        return redirect('/styles');

      }

    }

    public function upload_style_extra_image(Request $request){


	  // dd('test');

      // $this->validate($request, [
      //   'file' => 'required|image:jpeg,png,jpg,bmp',
      // ]);

	 // dd($request);

	  $input = $request->all();
  	  $id = $input['id'];
	  
	  // dd($id);

      if ($request->hasFile('file')) {
        $image = $request->file('file');
        
        $old_name = $image->getClientOriginalName();
        $filename = pathinfo($old_name, PATHINFO_FILENAME);
        // dd($filename);
        // $old = str_replace($old_namel)

        // $name = $filename.'_'.time().'.'.$image->getClientOriginalExtension();
        $name = $filename.'_'.date("Y-m-d_his").'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/storage/StyleImages/');
        $image->move($destinationPath, $name);
        // $this->save();
        // return back()->with('success','Image Upload successfully');

        

		try {
			$table = Styles_extra::findOrFail($id);
			$table->image = $name;
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			dd("Problem to save");
		}

        // dd('Upload successfully, file is:'.$name.' and style_id: '.$id);
        return redirect('/styles_extra');


      }

    }

}

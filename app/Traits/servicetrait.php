<?php
namespace App\Traits;

use App\Service;
use App\Traits\imagetrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;

trait servicetrait
{
	use imagetrait;
	public function addservice(){
		return view('cd-admin.service.addservice');
	}
	
	 public function view(){
    	$services = DB::table('services')->get()->all();
    	$er = Service::all();
    	return view('cd-admin.service.service',compact('services','er'));
    }

	public function store(){
		$a=[];
		$data = $this->insertcontrol();
		$test = $this->insertimage($data['image']);
		$a['image'] = $test;
        $a['created_at'] =Carbon::now('Asia/Kathmandu');
        $replace = array_replace($data,$a);
        DB::table('services')->Insert($replace);
        Session::flash('success');
        return redirect('/service-view');
	}
	public function updateservice($id){
		$data = $this->UpdateRequest();
		 if(isset($img))
        {
         $test = DB::table('services')->where('id',$id)->get()->first();
         if (file_exists('imageupload/'.$test->image)) 
         {
             unlink('imageupload/'.$test->image);
         }
         
         $img = $this->insertimage($data['image']);
         $a['image'] = $test ;
         
         $a['updated_at'] =Carbon::now('Asia/Kathmandu');
         $replace = array_replace($data,$a);
         $data = DB::table('services')->where('id',$id)->update($replace);
    	 }
    	 else
    	 {
         $a['updated_at'] =Carbon::now('Asia/Kathmandu');
         $replace = array_replace($data,$a);
         
        DB::table('services')->where('id',$id)->update($replace);
   		 }
   		 Session::flash('updatesuccess');
   		 return redirect('/service-view');
	}
	

	public function statusupdate($id)
    {
        $a = [];
        $test = DB::table('services')->where('id',$id)->get()->first();
        if($test->status=='active')
        {
            $a['status'] = 'inactive';
        }
        else
        {
            $a['status'] = 'active'; 
        }
        DB::table('services')->where('id',$id)->update($a);
        return redirect('/service-view');
    }

     public function delete($id){
    	$test = DB::table('services')->where('id',$id)->get()->first();
      if (file_exists('imageupload/'.$test->image)) 
      {
        unlink('imageupload/'.$test->image);
       }
      DB::table('services')->where('id',$id)->delete();
      Session::flash('deletesuccess');
      return redirect('/service-view');
    }	


	public function insertcontrol()
	{
  		
  		$data =  Request()->validate([
    	'name' => 'required',
    	'description' => 'required',
    	'image' => 'required|image',
    	'alt' => 'required',
    	'status' => 'required',
		]);
  		return $data;
	}

	public function UpdateRequest(){
		$data =  Request()->validate([
    	'name' => 'required',
    	'description' => 'required',
    	'alt' => 'required',
    	'status' => 'required',
		]);
  		return $data;

	}
}
?>
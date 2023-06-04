<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $edu= new Education();
        $education=$edu->get();
        return view('crud')->with(['education'=>$education]);
    }

    public function Create(Request $request)
    {
        $User=new User();
        if(isset($request->id)&& $request->id!='0' && !empty($request->id))
        {
            $user=$User->update_records($request);
        }
        else{
            $user=$User->insert_records($request);
        }
        // dd($user);
        if($user['status']==false)
        {
            return response()->json(['status'=>false, 'error'=>'something went wrong'],200);
        }
        if($user['status']==true){
            if($request->id=='0')
            {
                return response()->json(['status' => true, 'success' => 'Data inserted successfully'], 200);
            }
            return response()->json(['status'=>true, 'success' => 'Data Updated successfully'], 200);
        }
        // return redirect('/')->withInput($request->input())->withErrors($user['validator_error']);
    }

    public function getuserdata(Request $request){
        try{
            $user=(new User)->getdata($request);
            
            return response()->json(['status'=>true,'data'=>$user],200);
        }catch (\Exception $e) {
            return response()->json(['status'=>false,'error'=>'error'],500);
        }
    }

    public function getImage(Request $request){
        if (Storage::disk('public')->exists($request->path)) {
            $file = Storage::disk('public')->get($request->path);
            return  response($file);
        }
    }

    public function deleteUser(Request $request){
        if(!empty($request->id)){
        $user=User::find($request->id)->delete();
            return response()->json(['status'=>true, 'User'=>$user, 'Success'=>'User Deleted Successfully']);
        }
        return response()->json(['status'=>false,'error'=>"Something Went Wrong"]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function Login(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'username' => 'required',
            'password' =>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }else{
            
            $user=DB::table('e_info')
            ->where('username',$req->input('username'))
            ->where('details',1)
            ->first();
            
            if($user){

                if($user->password == $req->password){

                    return response()->json($user, 200);

                }else{

                    return response()->json(['code'=>401, 'message' => 'Not found']);

                }
            }else{
                return response()->json(['code'=>401, 'message' => 'Not Found']);
            }
        }
    }

      public function CreateEmp(Request $req){
        $validator = Validator::make($req->all(),
            [
                'name' => 'required',
                'company_name' => 'required',
                'contact' => 'required',
                'username' => 'required',
                'password' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }else{

            $data=array();
            $data['name']=$req->name;
            $data['company_name']=$req->name;
            $data['contact']=$req->name;
            $data['username']=$req->username;
            $data['password']=$req->password;
            $data['type']=2;

            $available=DB::table('e_info')
                    ->where('username',$req->username)
                    ->first();

            if($available){
                return response()->json(['code'=>401, 'message' => 'Username already taken!']);
            }else{
  
                $user=DB::table('e_info')->insert($data);
                if($user){
                    return response()->json(['code'=>200, 'message' => 'OK']);
                }else{
                    return response()->json(['code'=>401, 'message' => 'Something going wrong!']);
                }
            }
        }
    }
    public function Employee(Request $req){

        $data=DB::table('e_info')->where('details',1)->get();
        if($data){
            return response()->json($data, 200);
        }else{
            return response()->json(['code'=>401, 'message' => 'No Product Found!']);
        }
    }

  
    public function Edit(Request $req){
        $validator = Validator::make($req->all(),
            [
                'user_id'    => 'required',
                'name' => 'required',
                'company_name' => 'required',
                'contact' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }else{

            $data=array();
            $data['name']=$req->name;
            $data['company_name']=$req->company_name;
            $data['contact']=$req->contact;

            $update= DB::table('e_info')->where('id',$req->user_id)->update($data);

            if($update){

                return response()->json(['code'=>200, 'message' => 'OK']);
                
            }else{

                return response()->json(['code'=>401, 'message' => 'Not found']);
            }
        }
    }

    public function Delete(Request $req){
        $validator = Validator::make($req->all(),
            [
                'user_id'=> 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }else{

            $data=array();
            $data['details']=0;

            $delete= DB::table('e_info')->where('id',$req->user_id)->destroy()($data);

            if($delete){

                return response()->json(['code'=>200, 'message' => 'OK']);
                
            }else{

                return response()->json(['code'=>401, 'message' => 'No data found']);
            }
        }
    }

}

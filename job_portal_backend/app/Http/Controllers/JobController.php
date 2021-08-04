<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function Job(Request $req){

        $data=DB::table('job')
            ->where('details',1)
            ->get();
            
        if($data){
            return response()->json($data, 200);
        }else{
            return response()->json(['code'=>401, 'message' => 'No Job Found!']);
        }
    }

    public function Create(Request $req){
        $validator = Validator::make($req->all(),
            [
                'company' => 'required',
                'title' => 'required',
                'location' => 'required',
                'salary' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }else{

            $data=array();
            $data['company']=$req->company;
            $data['title']=$req->title;
            $data['location']=$req->location;
            $data['salary']=$req->salary;

            $user=DB::table('job')->insert($data);

            if($user){
                return response()->json(['code'=>200, 'message' => 'OK']);
            }else{
                return response()->json(['code'=>401, 'message' => 'Something going wrong!']);
            }
        }
    }

    public function Update(Request $req){
        $validator = Validator::make($req->all(),
            [
                'id' => 'required',
                'company' => 'required',
                'title' => 'required',
                'location' => 'required',
                'salary' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }else{

            $data=array();
            $data['company']=$req->company;
            $data['title']=$req->title;
            $data['location']=$req->location;
            $data['salary']=$req->salary;

            $update= DB::table('job') ->where('id',$req->id)->update($data);
                

            if($update){

                return response()->json(['code'=>200, 'message' => 'OK']);
                
            }else{

                return response()->json(['code'=>401, 'message' => 'Something going wrong!']);
            }
        }
    }
    public function Delete(Request $req){
        $validator = Validator::make($req->all(),
            [
                'id' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }else{
            $data=array();
            $data['details']=0;
            $delete= DB::table('job')->where('id',$req->id)->destroy($data);

            if($delete){

                return response()->json(['code'=>200, 'message' => 'Done']);
                
            }else{

                return response()->json(['code'=>401, 'message' => 'error!']);
            }
        }
    }
}

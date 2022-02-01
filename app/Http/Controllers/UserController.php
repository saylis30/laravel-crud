<?php

namespace App\Http\Controllers;
use App\Models\User;
use DB;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function getuserlist(){
        $users = User::join('statuses', 'statuses.id', '=', 'users.status')->select(['users.*','statuses.status as statusname'])->get();
        return view('userlist', compact('users'));
    }

    public function reload(){
        $users = User::join('statuses', 'statuses.id', '=', 'users.status')->select(['users.*','statuses.status as statusname'])->get();
        return view('usertable', compact('users'));
    }

    public function add(Request $request){

        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'mobileno'=>'required|min:11|max:11',
            'profilepic'=>'required|image|mimes:png,jpeg',
            'status'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $fileOgName = $request->file('profilepic')->getClientOriginalName();
            $path = $request->file('profilepic')->move('assets/images', $fileOgName);

            $values = [
                'name'=> $request->name,
                'email'=> $request->email,
                'mobileno'=> $request->mobileno,
                'profilepic'=> $fileOgName,
                'status'=> $request->status,
            ];

            $query = DB::table('users')->insert($values);
            if($query){
                return response()->json(['status'=>1, 'msg'=>'User added successfully.']);
            }
        }
    }

    public function edit(Request $request){
        if(isset($request->id) && $request->id != 0){
            $userData = User::find($request->id);
            if ($userData === null) {
                return response()->json(['status'=>0, 'msg'=>'Unable to edit, please try again later.']);
            }else{
                return response()->json(['status'=>1, 'msg'=>'Edit user', 'data'=>$userData]);
            }
        }
    }

    public function update(Request $request){
        $postData = $request->all();

        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'mobileno'=>'required|min:11|max:11',
            'status'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            if(!empty($postData)){
                if(isset($postData['profilepic'])){
                    $fileOgName = $request->file('profilepic')->getClientOriginalName();
                    $path = $request->file('profilepic')->move('assets/images', $fileOgName);
                    $postData['profilepic'] = $fileOgName;
                }

                $update = DB::table('users')->where('id', $postData['id'])->update($postData);
                if($update == true){
                    return response()->json(['status'=>1, 'msg'=>'User updated successfully.']);
                }else{
                    return response()->json(['status'=>0, 'msg'=>'Record not updated.']);
                }
            }
        }
    }

    public function delete(Request $request){
        if(isset($request->id) && $request->id != 0){
            if(User::find($request->id)->delete() == true){
                return response()->json(['status'=>1, 'msg'=>'User deleted successfully.']);
            }else{
                return response()->json(['status'=>0, 'msg'=>'Unable to delete, please try again later.']);
            }
        }
    }
}

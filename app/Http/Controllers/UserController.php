<?php

namespace App\Http\Controllers;
use App\Models\User;
use DB;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Validator;
use Excel;
use App\Exports\UserExport;

class UserController extends Controller
{
    // Get user list
    public function getuserlist(){
        $users = User::join('statuses', 'statuses.id', '=', 'users.status')->select(['users.*','statuses.status as statusname'])->get();
        return view('userlist', compact('users'));
    }

    //Reload table data after add/edit/delete operations
    public function reload(){
        $users = User::join('statuses', 'statuses.id', '=', 'users.status')->select(['users.*','statuses.status as statusname'])->get();
        return view('usertable', compact('users'));
    }

    // Add record if validation passes
    public function add(Request $request){

        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'mobileno'=>'required|regex:/(09)[0-9]{9}/|min:11|max:11|unique:users,mobileno,NULL,id,deleted_at,NULL',
            'profilepic'=>'required|image|mimes:png,jpeg',
            'status'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $fileOgName = time()."_".$request->file('profilepic')->getClientOriginalName();
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
                return response()->json(['status'=>1, 'action'=>'add', 'msg'=>'User added successfully.']);
            }
        }
    }

    //Get record details to show on edit form
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

    //Update record - edit action
    public function update(Request $request){
        $postData = $request->all();

        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$postData['id'].',id,deleted_at,NULL',
            'mobileno'=>'required|regex:/(09)[0-9]{9}/|min:11|max:11|unique:users,mobileno,'.$postData['id'].',id,deleted_at,NULL',
            'profilepic'=>'image|mimes:png,jpeg',
            'status'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            if(!empty($postData)){
                if(isset($postData['profilepic'])){
                    $fileOgName = time()."_".$request->file('profilepic')->getClientOriginalName();
                    $path = $request->file('profilepic')->move('assets/images', $fileOgName);
                    $postData['profilepic'] = $fileOgName;
                }

                $update = DB::table('users')->where('id', $postData['id'])->update($postData);
                if($update == true){
                    return response()->json(['status'=>1, 'action'=>'update', 'msg'=>'User updated successfully.']);
                }else{
                    return response()->json(['status'=>0, 'action'=>'update', 'msg'=>'Record not updated.']);
                }
            }
        }
    }

    //Delete record
    public function delete(Request $request){
        if(isset($request->id) && $request->id != 0){
            if(User::find($request->id)->delete() == true){
                return response()->json(['status'=>1, 'msg'=>'User deleted successfully.']);
            }else{
                return response()->json(['status'=>0, 'msg'=>'Unable to delete, please try again later.']);
            }
        }
    }

    //Export user data
    public function export(){
        return Excel::download(new UserExport, 'users.xlsx');
    }
}

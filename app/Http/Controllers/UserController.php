<?php
  
namespace App\Http\Controllers;
  
use App\User;
use App\UserData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
  
  
class UserController extends Controller{  
    public function index(){
        $Users = User::all();

        $users_json = [];
        foreach($Users as $key => $value) {
            $users_json[$key]['id'] = $value->id;
            $users_json[$key]['name'] = $value->name;
            $users_json[$key]['birth'] = (isset($value->data->birth)) ? $value->data->birth : null;
            $users_json[$key]['phone'] = (isset($value->data->phone)) ? $value->data->phone : null;
            $users_json[$key]['email'] = (isset($value->data->email)) ? $value->data->email : null;
        }

        return response()->json($users_json);
    }
  
    public function getUser($id){
        
        $User = User::find($id);

        if($User) {
            return response()->json([
                'id' => $User->id,
                'name' => $User->name,
                'birth' => $User->data->birth,
                'phone' => $User->data->phone,
                'email' => $User->data->email
                ]);
        }else {
            return response()->json('User not found');
        }
    }
  
    public function createUser(Request $request){
  
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users_data',
            'birth' => 'date_format:Y-m-d',
            'phone' => 'max:24'
        ]);   

        $User = User::create(['name' => $request->input('name')]);

        $User->data()->create([
            'birth' => $request->input('birth'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone')
        ]);

        return response()->json([
            'id' => $User->id,
            'name' => $User->name,
            'birth' => $User->data->birth,
            'phone' => $User->data->phone,
            'email' => $User->data->email
        ]);
  
    }
  
    public function deleteUser($id){
        $User = User::find($id);
        $User->delete();
 
        return response()->json('deleted');
    }
  
    public function updateUser(Request $request,$id){

        $this->validate($request, [
            'name' => 'string|max:255',
            'birth' => 'date_format:Y-m-d',
            'phone' => 'string|max:24'
        ]);

        $User = User::find($id);
        $User->name = $request->input('name');
        $User->data->birth = $request->input('birth');
        $User->data->phone = $request->input('phone');
        $User->save();
  
        return response()->json($User);
    }
}
?>

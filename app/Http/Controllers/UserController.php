<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = User::all();
        return view("manage", compact("users"));
    }
    public function saveUserData(Request $request)
    {
        $name = $request->input("name");
        $phone = $request->input("phone");
        $email = $request->input("email");
        $gender = $request->input("gender");
        $address = $request->input("address");
        $filePath = $request->input("filePath");
        $password = $request->input("password");

        $user = new User();
        $user->username = $name;
        $user->phone = $phone;
        $user->email = $email;
        $user->gender = $gender;
        $user->address = $address;
        $user->photo = $filePath;
        $user->password = $password;
        
        $user->save();
        return "user created successfully...employe id is" . $user->id;
    }

    public function uploadImage(Request $request)
    {

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048'
            ]);
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $filePath = '../images/' . $imageName;
            return response()->json(['filePath' => $filePath]);
        }

        return response()->json(['error' => 'No image found in the request.'], 400);


    }
    public function edit($id){
        $user = User::find($id);
        return view('edit', compact('user'));
			
    }

    public function updateUser(Request $request,$id){
        $user        = User::find($id);
        $user->username = $request->input("name");
        $user->phone = $request->input("phone");
        $user->email = $request->input("email");
        $user->gender = $request->input("gender");
        $user->address = $request->input("address");
        $user->photo = $request->input("filePath");
        $user->password = $request->input("password");


        $user->save();
        return "user updated  successfully...employe id is" . $user->id;
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return redirect('/'); 
    }

    public function validateUser(Request $request){
        $name = $request->input('name');
        $password = $request->input('password');
        $flag = false;
        $users = User::all();
        foreach($users as $user){
            if($name == $user->username && $password == $user->password){
                $flag = true;
            }
        }
        if($flag){
            return redirect('/manage');
        }
        return ('<h4>please give valid credetial</h4> <a href="/">click here to login page</a>');
    }

}

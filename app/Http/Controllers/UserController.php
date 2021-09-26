<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    //Admin update user's role
    public function update_user($id)
    {
        $user = User::findOrFail($id);
        $newRole = 0;
        $name = '';
        if($user->role->id == 1){
            $newRole = 2;
            $name = 'Admin';
        }else{
            $newRole = 1;
            $name = 'Customer';
        }
        $user->update(['role_id' => $newRole]);
        return redirect('dashboard')->withSuccess('User Role Updated to '.$name.' Successfully');
    }

    public function profile(){
        $user = User::where('id',Auth::id())->first();
        return view('profile',compact('user'));
    }

            //Update User's profile
    public function updateProfile(Request $request){

        $user = User::where('id',Auth::id());
       if($request->password ==  $request->confirm_password){

            if(Hash::check($request->old_password, $user->password)){
               $changed_password = Hash::make($request->password);
               $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $changed_password
                ]);

                return redirect()->back()->withSuccess('Profile Updated Successfully');
               }else{
                return redirect()->back()->withError('No wahala');
               }

             }else{
                return redirect()->back()->withError('Please confirm your new password');
             }
   }

   public function usersAtFitty(){

    return view('dashboard.users_age_50', [
        'users' => User::where('dob', '<', date('Y-m-d', strtotime('-50 years')))->get()
    ]);
}
}

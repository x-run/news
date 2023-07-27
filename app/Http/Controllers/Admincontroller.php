<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse; 
use App\Models\User;

class Admincontroller extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }
    //End Method

    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/logout/page');
    }// End Method

    public function AdminLogin(){
        
        return view('admin.admin_login');
    }

    public function AdminLogoutPage(){
        return view('admin.admin_logout');
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view',compact('adminData'));
    }

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        
        if ($request->file('photo')){
            $file = $request->file('photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images/'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        return redirect()->back();
    }
}

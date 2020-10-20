<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;


class DashboardController extends Controller
{
    public function registered()
    {
        $users = User::all();
        return view('admin.register')->with('users',$users);
    }

    public function registeredit(Request $request, $id)
    {
        $users = User::findOrFail($id);
        return view('admin.register-edit')->with('users',$users);
    }

    public function registerupdate(Request $request, $id)
    {
        $admin = 'Admin'; //added
        $users = User::find($id);
        $users->name = $request->input('username');
        $users->usertype = $request->input('usertype');
        

        if ($users->name == $admin) 
        {
        return redirect('role-register')->with('status', 'This user cannot be updated!');  
        }
        else
        {
            $users->update(); //orig
            return redirect('role-register')->with('status', 'Your data has been updated.');// orig
        }
        
    }

    public function registerdelete($id)
    {
        $admin = 'Admin';//added
        $users = User::findOrFail($id);

        if ($users->name == $admin)
        {
        return redirect('role-register')->with('status', 'This user cannot be deleted!');
        }
        else
        {
        $users->delete(); //orig
        return redirect('role-register')->with('status', 'Your data has been deleted.');//orig
        }
    }

}

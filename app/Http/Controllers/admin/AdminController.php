<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $superAdminRole = Role::where('name','superadmin')->first();
        $adminRole = Role::where('name','admin')->first();
        $data['admins'] = User::whereIn('role_id',[$superAdminRole->id,$adminRole->id])
        ->orderBy('id','DESC')
        ->paginate(10);

        return view('admin.admins.index',$data);
    }
    public function create()
    {
        $data['roles'] = Role::select('id','name')->whereIn('name',['superadmin','admin'])->get();
        return view('admin.admins.create',$data);
    }

    public function store(Request $request)
    {
        $user = $request->validate([
            'name' => "required|string|max:255",
            'email' => "required|email|max:255",
            'password' => "required|string|max:30|min:5|confirmed",
            'role_id' => 'required|exists:roles,id'
        ]);
        $user['password'] = Hash::make($request->password);
        User::create($user);
        
        return redirect('dashboard/admins');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        session()->flash('msg', $user->role->name." $user->name deleted successfully");
        $user->delete();

        return back();
    }

    public function promote($id)
    {
        $user = User::findOrFail($id);
        $roleId = Role::select('id')->where('name','superadmin')->value('id');
        $user->update(['role_id'=> $roleId]);
        return back();
    }

    public function demote($id)
    {
        $user = User::findOrFail($id);
        $roleId = Role::select('id')->where('name','admin')->value('id');
        $user->update(['role_id'=> $roleId]);
        return back();
    }
}

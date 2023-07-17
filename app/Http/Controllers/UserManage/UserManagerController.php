<?php

namespace App\Http\Controllers\UserManage;


use Illuminate\Support\Facades\Auth;
use App\Models\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Builder\Property;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserManagerController extends Controller
{
    //

    public function UserAllType()
    {
        $types= UserManagement::latest()->get();
        return view('usermanagement.user_all_type',compact('types'));
    }

    

    public function UserAddType()
    {
                return view('usermanagement.user_add_type');
    }

    public function UserStoreType(Request $request)
    {

        $request -> validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:users|min:8',
            'password' => 'required|min:8',
            'role' => 'required'

       ]);

       UserManagement::insert([

        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), 
        'role' => $request->role,

       ]);

       $notification = array(
        'message' => 'User Created successfully',
        'alert-type' => 'success'
        );

        return redirect()->route('userall.type')->with($notification);


    }

    public function UserEditType($id)
    {
        $types = UserManagement::findorFail($id);
        return view('usermanagement.user_edit_type', compact('types'));
    }

    public function UserUpdateType(Request $request)
    {

        

       $pid = $request->id;



       UserManagement::findOrFail($pid)->update([

        'name' => $request->name,
        'email' => $request->email,
        'status' => $request->status,
        'role' => $request->role,
        

       ]);

       $notification = array(
        'message' => 'User Edit was successfull',
        'alert-type' => 'success'
        );

        return redirect()->route('userall.type')->with($notification);


    }

    public function UserDeleteType($id)
    {

        UserManagement::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
    
    }

    public function UserFilterByRole(Request $request)
{
    $filterRole = $request->input('filter_role');
    $filterStatus = $request->input('filter_status');

    $query = UserManagement::query();

    if ($filterRole) {
        $query->where('role', $filterRole);
    }

    if ($filterStatus) {
        $query->where('status', $filterStatus);
    }

    $types = $query->latest()->get();

   return view('usermanagement.user_all_type', compact('types'));

}

public function UserActivationType()
{
    $users = User::where('status', 'disabled')->get();
    return view('usermanagement.disabled_users',compact('users'));
}

}

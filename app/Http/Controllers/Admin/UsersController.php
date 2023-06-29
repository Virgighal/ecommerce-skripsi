<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * List of user
     *
     * @param Request $request
     * 
     */
    public function index(Request $request)
    {
        if(auth()->user()->user_level != 'Admin') {
            return redirect()->route('home');
        }

        $users = User::where('user_level', 'Customer')->orderBy('name', 'ASC');

        if(!empty($request->name)) {
            $users = $users->where('name', 'LIKE', '%'.$request->name.'%');
        }

        $users = $users->paginate(10);

        return view('admin.users.index', [
            'users' => $users
        ]);
    }
    
    /**
     * go to create user page
     *
     * @return void
     */
    public function create()
    {
        if(auth()->user()->user_level != 'Admin') {
            return redirect()->route('home');
        }

        return view('admin.users.create');
    }
    
    /**
     * Save user
     *
     * @param Request $request
     * 
     */
    public function store(Request $request)
    {
        if(auth()->user()->user_level != 'Admin') {
            return redirect()->route('home');
        }

        $validationRules = [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required',
            'password' => 'required|min:8|max:64|confirmed',
        ];

        $this->validate($request, $validationRules);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->user_level = 'Customer';
        $user->save();

        return redirect()->route('admin.users.index')->with('success_message', 'Successfully created new user');
    }

    /**
     * details of user
     * 
     * @param Request $request
     * 
     */
    public function show($id)
    {
        if(auth()->user()->user_level != 'Admin') {
            return redirect()->route('home');
        }

        $user = User::where('user_level', 'Customer')
            ->where('id', $id)
            ->first();
        
        if(empty($user)) {
            return redirect()->back()->with('error_message', 'User is no longer exists!');
        }

        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    /**
     * go to user edit page
     *
     * @param [type] $id
     * 
     */
    public function edit($id)
    {
        abort(404);
    }

    /**
     * update user
     *
     * @param Request $request
     * @param [type] $id
     * 
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->user_level != 'Admin') {
            return redirect()->route('home');
        }

        $user = User::where('user_level', 'Customer')
            ->where('id', $id)
            ->first();
        
        if(empty($user)) {
            return redirect()->back()->with('error_message', 'User is no longer exists!');
        }

        $validationRules = [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required'
        ];

        $this->validate($request, $validationRules);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        if(!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('admin.users.show', [
            'id' => $user->id
        ])->with('success_message', 'Successfully updated users');
    }

    /**
     * delete user
     *
     * @param [type] $id
     * 
     */
    public function destroy(Request $request)
    {
        if(auth()->user()->user_level != 'Admin') {
            return redirect()->route('home');
        }

        $user = User::where('user_level', 'Customer')
            ->where('id', $request->id)
            ->first();
        
        if(empty($user)) {
            return redirect()->back()->with('error_message', 'User is no longer exists!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success_message', 'Successfully deleted user!');
    }
}

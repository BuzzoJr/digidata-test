<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class UserController extends Controller
{
    //
    public function index(){
        return view('login.index');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return redirect("login");
    }

    public function create(){
        return view('login.manage');
    }

    public function store(Request $request){
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $check = User::create($data);
         
        return redirect()->route("dashboard.index");
    }

    public function edit($id){
        abort_if(!Auth::check(), redirect()->route("login.page"));
        $editData = User::where('id', $id)->first();
        $isEdit = true;
        return view('login.manage')->with(compact("isEdit", "editData"));
    }

    public function update(Request $request){
        abort_if(!Auth::check(), redirect()->route("login.page"));

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $check = User::update($data); 

        $editData = User::where('id', $id)->first();
        $isEdit = true;
        return view('dashboard.index')->with(compact("isEdit", "editData"));
    }

    public function destroy($id)
    {
        abort_if(!Auth::check(), redirect()->route("login.page"));
        $user = User::find($id);
        $user->delete();

        return back();
    }

}

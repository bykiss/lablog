<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    //
    public function create(){
        return view('session.create');
    }

    public function store(Request $request){

        $data = $this->validate($request,[
            'email'=>'required|email|max:255',
            'password'=>'required',
        ]);

        if(Auth::attempt($data,$request->has('remember'))){
            session()->flash('success','欢迎回来');
            return redirect()->route('users.show',[Auth::user()]);
        }else{
            session()->flash('danger','账号或密码错误');
            return redirect()->back();
        }

    }

    public function destroy(){
        Auth::logout();
        session()->flash('success','退出成功');
        return redirect('login');
    }
}

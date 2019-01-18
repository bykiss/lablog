<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',[
            'only'=>'create',
        ]);
    }

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
            //可跳转到上个页面，如果没有上一个页面，则跳转到user.show
            return redirect()->intended(route('users.show',[Auth::user()]));
            //return redirect()->route('users.show',[Auth::user()]);
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

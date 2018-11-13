<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登录页面
    public function index() {
    	return view('login.index');
    }
    //登录操作
    public function login() {
        //验证
        $this->validate(request(),[
            'email' => 'required|email',
            'password' => 'required',
            'is_remember' => 'integer',
        ]);
        $email = request('email');
        $password = request('password');
        $is_remember = boolval(request('is_remember'));

        //逻辑
        if (\Auth::attempt(['email' => $email, 'password' => $password], $is_remember)) {
            return redirect('/posts');
        }

        //渲染
        return \Redirect::back()->withErrors('邮箱密码不匹配');
    }
    //登出操作
    public function logout() {
        \Auth::logout();

        return redirect('/login');
    }
}

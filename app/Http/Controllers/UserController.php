<?php

namespace App\Http\Controllers;

use \App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //个人设置页面
    public function setting() {
    	return view('user.setting');
    }
    //个人设置页面操作
    public function settingStore() {

    }

    public function show(User $user) {
    	//这个人信息（关注、粉丝、文章数）
    	$user = User::withCount(['posts','fans','stars'])->find($user->id);

    	//这个人的文章数，取前10条
    	$posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();

    	//这个人关注的用户
    	$stars = $user->stars();
    	$susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['posts','fans','stars'])->get();

    	//这个人的粉丝
    	$fans = $user->fans();
    	$fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['posts','fans','stars'])->get();

    	return view('user.show',compact('user','susers','fusers','posts'));
    }

    public function fan(User $user) {
    	$me = \Auth::user();
    	$me->doFan($user->id);

    	return [
    		'error' => 0,
    		'msg' => '',
    	];
    }

    public function unfan(User $user) {
    	$me = \Auth::user();
    	$me->doUnFan($user->id);

    	return [
    		'error' => 0,
    		'msg' => '',
    	];
    }
}

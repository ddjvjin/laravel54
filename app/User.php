<?php

namespace App;

use App\Model;
use Illuminate\foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    protected $fillable = [
        'name','email','password'
    ];

    //用户的文章列表
    public function posts() {
    	return $this->hasMany(\App\Post::class,'user_id','id');
    }

    //关注我的Fan模型
    public function fans() {
    	return $this->hasMany('\App\fan','star_id','id');
    }

    //我关注的Fan模型
    public function stars() {
    	return $this->hasMany('\App\fan','fan_id','id');
    }

    //关注某人
    public function doFan($uid){
    	$fan = new \App\Fan();
    	$fan->star_id = $uid;

    	return $this->stars()->save($fan);
    }
    //取消关注
    public function doUnFan($uid){
    	$fan = new \App\Fan();
    	$fan->star_id = $uid;
    	return $this->stars()->delete($fan);
    }
    //当前用户是否被Uid关注
    public function hasFan($uid) {
    	return $this->fans()->where("fan_id",$uid)->count();
    }

    //当前用户是否关注
    public function hasStar($uid) {
    	return $this->stars()->where("star_id",$uid)->count();
    }
}

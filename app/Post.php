<?php

namespace App;

use App\Model;

class Post extends Model
{
	public function user() {
		return $this->belongsTo('App\User','user_id','id');
	}
	//评论模型
	public function comments() {
		return $this->hasMany('App\Comment','post_id','id')->orderBy('created_at','desc');
	}
	//和用户进行关联
	public function zan($user_id) {
		return $this->hasOne(\App\Zan::class)->where("user_id",$user_id);
	}
	//该文章的所有赞
	public function zans() {
		return $this->hasMany(\App\Zan::class);
	}
}

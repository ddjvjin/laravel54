<?php

namespace App;

use App\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
	use Searchable;

	//定义索引里面的type
    public function searchableAs()
    {
        return "post";
    }

    //定义有哪些字段需要搜索
    public function toSearchableArray()
    {
        return [
            'title'=>$this->title,
            'content'=>$this->content,
        ];
    }

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

	public function scopeAuthorBy(Builder $query,$user_id){
		return $query->where("user_id",$user_id);
	}

	public function postTopics() {
		return $this->hasMany('\App\PostTopic','post_id','id');
	}

	public function scopeTopicNotBy(Builder $query,$topic_id){
		return $query->doesntHave('postTopics','and',function($q) use ($topic_id){
			$q->where("topic_id",$topic_id);
		});
	}
}

var editor = new wangEditor('content');
if(editor.config){
	editor.config.uploadImgUrl = '/posts/image/upload';
	editor.config.uploadHeaders = {
		'X-CSRF-TOKEN' : $('meta[name="csrf-token"').attr('content')
	}
	editor.create();
}

$('.like-button').click(function(){
	var target = $(this);
	var current_like = target.attr('like-value');
	var user_id = target.attr('like-user');

	if(current_like == 1){
		//取消关注
		$.ajax({
			url:"/user/" + user_id + "/unfan",
			method:"post",
			dataType:"json",
			success:function(response){
				if(response.status != 0){
					alert(response.msg);
					return;
				}
				target.attr('like-value',0);
				target.text('关注');
			}
		});
	}else{
		//关注
		$.ajax({
			url:"/user/" + user_id + "/unfan",
			method:"post",
			dataType:"json",
			success:function(response){
				if(response.status != 0){
					alert(response.msg);
					return;
				}
				target.attr('like-value',0);
				target.text('关注');
			}
		});
	}
});
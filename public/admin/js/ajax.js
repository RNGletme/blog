$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

//审核文章
$('.article-action').click(function (event) {
	let target = $(event.target);
	let articleID = target.attr('article-id');
	let action = target.attr('article-action-status');

	$.ajax({
		url:'/admin/articles/' + articleID,
		method:'POST',
		dataType:'json',
		data:{'status':action},
		success:function (data) {
			if(data.code != 200){
				alert(data.error)
			}else{
				target.parent().parent().remove();
			}
		}
	})
});

//删除专题
$('.resource-delete').click(function (event) {
	let target = $(event.target);
	let url = target.attr('delete-url');

	$.ajax({
		url:url,
		method:'post',
		dataType: 'json',
		success:function (data) {
			if(data.code!=200){
				alert(data.error);
			}else{
				target.parent().parent().remove();
			}
		}
	})
});

//发送通知
$('.notice-action').click(function (event) {
	let target = $(event.target);
	let url = target.attr('notice-url');
	let action = target.attr('notice-action');

	$.ajax({
		url:url,
		method:'get',
		dataType:'json',
		success:function (data) {
			if(data.code !== 200){
				alert(data.error);
			}else{
				if(action === 'send'){
					target.html('已发送').prop('disabled', true);
				}else{
					target.parent().parent().remove();
				}
			}
		}
	})
});




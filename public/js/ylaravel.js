var editor = new wangEditor('content');
if(editor.config){
    editor.config.uploadImgUrl = '/article/image/upload';

    // 设置 headers（举例）
    editor.config.uploadHeaders = {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    };

    editor.create();
}


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.preview_input').change(function () {
    let file = this.files[0];
    let r = new FileReader();
    r.readAsDataURL(file);//发起异步请求
    r.onload = function () {
        //这里进行读取完之后的操作
        $('#preview_img').attr('src', this.result);
    };
});

let $like_button = $('.like-button');
$like_button.click(function () {
   let $like_value = $like_button.attr('like-value');
   let $like_user = $like_button.attr('like-user');
   console.log($like_value)
   if($like_value == 1){
       $.ajax({
           url:'/user/'+ $like_user + '/fan',
           method:'post',
           dataType:'json',
           success:function (msg) {
               if(msg.code === 200){
                   $like_button.attr('like-value', 0).text('取消关注');
               }else{
                   alert(msg.error);
               }
           }
       })
   }else if($like_value == 0){
       $.ajax({
           url:'/user/'+ $like_user + '/unfan ',
           method:'post',
           dataType:'json',
           success:function (msg) {
               if(msg.code == 200){
                   $like_button.attr('like-value', 1).text('关注');
               }else{
                   alert(msg.error);
               }
           }
       })
   }
});


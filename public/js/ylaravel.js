//富文本编辑器
var editor = new wangEditor('content');
if(editor.config){
    editor.config.uploadImgUrl = '/article/image/upload';

    // 设置 headers（举例）
    editor.config.uploadHeaders = {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    };

    editor.create();
}

//ajax请求添加csrf验证
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//图片预览
$('.preview_input').change(function () {
    let file = this.files[0];
    let r = new FileReader();
    r.readAsDataURL(file);//发起异步请求
    r.onload = function () {
        //这里进行读取完之后的操作

        let $image = $('#preview_img');
        $image.attr('src', this.result);

        //图片裁剪
        $image.cropper('destroy');
        $image.cropper({
            aspectRatio: 1,
            crop: function(event) {
            },
            background:false,
            viewMode:2,
            minContainerWidth: 480,
            minContainerHeight: 270
        });
    };
});

let $image = $('#preview_img');
$image.on('cropend',function (e) {
    getBase64();
});

$image.on('ready',function (e) {
    getBase64();
});

function getBase64(){
    let imgData = $image.cropper('getCroppedCanvas');
    let dataurl = imgData.toDataURL('image/png');
    $('#postAvatar').val( dataurl);
}

//关注按钮
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



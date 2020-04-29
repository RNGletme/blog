@extends('layout.main')
@section('content')
<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">

        <div class="col-sm-8 blog-main">
            <form class="form-horizontal" action="/user/me/setting" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="name" type="text" value="{{ Auth::user()->name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">头像</label>
                    <div class="col-sm-2">
                        <input class=" file-loading preview_input" type="file" value="用户名" style="width:200px" name="">
                        <br>
                        <img  id="preview_img" class="preview_img" src="{{ $user->avatar }}" alt="" style="max-width:480px;max-height: 270px;">
                        <input id="postAvatar" type="text" value="" hidden name="avatar">
                    </div>
                </div>
                @include('layout.errorMsg')
                <button type="submit" class="btn btn-default">修改</button>
            </form>
            <br>

        </div>

        @include("layout.sidebar")


    </div>    </div><!-- /.row -->
</div><!-- /.container -->
@endsection
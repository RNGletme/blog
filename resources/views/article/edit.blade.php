@extends('layout.main')

@section('content')
<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">

        <div class="col-sm-8 blog-main">
            <form action="/article/{{$article->id}}" method="POST">
                <!-- <input type="hidden" name="_method" value="PUT"> -->
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="form-group">
                    <label>标题</label>
                    <input name="title" type="text" class="form-control" placeholder="这里是标题" value={{$article['title']}}>
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea id="content" name="content" class="form-control" style="height:400px;max-height:500px;"  placeholder="这里是内容">{{$article['content']}}</textarea>
                </div>
                <button type="submit" class="btn btn-default">提交</button>
            </form>
            <br>
        </div><!-- /.blog-main -->

    </div>    </div><!-- /.row -->
</div><!-- /.container -->
@endsection


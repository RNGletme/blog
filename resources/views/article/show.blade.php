@extends('layout.main')

@section('content')
<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">


        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <div style="display:inline-flex">
                    <h2 class="blog-post-title">{!! $article['title'] !!}</h2>
                    @can('update', $article)
                        <a style="margin: auto 50px"  href="/article/{{$article['id']}}/edit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                    @endcan
                    @can('delete', $article)
                        <a style="margin: auto"  href="/article/{{$article['id']}}/delete">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </a>
                    @endcan
                </div>

                <p class="blog-post-meta">{!! $article['created_at']->toFormattedDateString() !!}<a href="/user/{{ $article->blog_user_id }}" style="margin-left: 20px">{{ $article->blogUser->name }}</a></p>

                <p>{!! $article['content'] !!}<p><p><br></p>
                <div>
                    @if(!Auth::user())
                        <p class="alert alert-danger">评论和点赞功能需登录^_^<a href="/login">&nbsp;点我登录</a></p>
                    @endif
                    @if(!$article->like(Auth::id())->exists())
                    <a href="/article/{{$article['id']}}/like" type="button" class="btn btn-primary btn-lg">赞</a>
                    @else
                        <a href="/article/{{$article['id']}}/unlike" type="button" class="btn btn-primary btn-lg">取消</a>
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">评论</div>

                <!-- List group -->
                <ul class="list-group">
                    @foreach($article->comment as $comment)
                    <li class="list-group-item">
                        <h5>{{ $comment->created_at }} by {{ $comment->blogUser->name }}</h5>
                        <div>
                            {{ $comment->content }}
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">发表评论</div>

                <!-- List group -->
                <ul class="list-group">
                    <form action="/article/{{$article->id}}/comment" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="article_id" value="{{$article->id}}"/>
                        <li class="list-group-item">
                            <textarea name="content" class="form-control" rows="10"></textarea>
                            @include('layout.errorMsg')
                            <button class="btn btn-default" type="submit">提交</button>
                        </li>
                    </form>

                </ul>
            </div>

        </div><!-- /.blog-main -->

        @include("layout.sidebar")

    </div>
</div><!-- /.container -->
@endsection

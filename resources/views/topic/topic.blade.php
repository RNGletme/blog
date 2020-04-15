@extends('layout.main')

@section('content')
<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">

        <div class="col-sm-8">
            <blockquote>
                <p>{{ $topic->name }}</p>
                <span style="margin-right: 20px">文章：{{ $topic->article_topic_count }}</span>
                <button class="btn btn-default topic-submit"  data-toggle="modal" data-target="#topic_submit_modal" topic-id="1" type="button">投稿</button>
            </blockquote>
        </div>
        <div class="modal fade" id="topic_submit_modal" tabindex="-1" role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">我的文章</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/topic/{{ $topic->id }}/submit" method="post">
                            {{ csrf_field() }}
                            @foreach($articlesNoByTopic as $article)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="article_id[]" value="{{ $article->id }}">
                                    {{ $article->title }}
                                </label>
                            </div>
                            @endforeach
                            <button type="submit" class="btn btn-default">投稿</button>
                            @include('layout.errorMsg')
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8 blog-main">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        @foreach($articles as $article)
                        <div class="blog-post" style="margin-top: 30px">

                            <p class=""><a href="/user/{{ $article->blog_user_id }}">{{ $article->blogUser->name }}</a> {{ $article->created_at->toFormattedDateString() }}</p>
                            <p class=""><a href="/article/{{ $article->id }}" >{{ str_limit(strip_tags($article->title), 100, '...') }}</a></p>
                            <p>{{ str_limit(strip_tags($article->content), 100, '...') }}</p>
                        </div>
                        @endforeach
                    </div>

                </div>
                <!-- /.tab-content -->
            </div>


        </div><!-- /.blog-main -->
        @include("layout.sidebar")
    </div><!-- /.row -->
</div><!-- /.container -->


@endsection

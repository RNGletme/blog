@extends('layout.main')
@section('content')
<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">

        <div class="col-sm-8">
            <blockquote>
                <p><img src="{{ $blogUser->avatar}}" alt="" class="img-rounded" style="border-radius:500px; height: 40px"> {{ $blogUser->name }}
                    &nbsp;&nbsp;@include('user.likeButton', ['id'=>$blogUser->id])</p>
                <footer>关注：{{ $blogUser->stars_count }}｜粉丝：{{ $blogUser->fans_count }}｜文章：{{ $blogUser->articles_count }}</footer>
            </blockquote>

        </div>
        <div class="col-sm-8 blog-main">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        @foreach($articles as $article)
                            <div class="blog-post" style="margin-top: 30px">
                                <p class=""><a href="/user/{{ $blogUser->id }}">{{ $blogUser->name }}</a>
                                </p>
                                <p class=""><a href="/article/{{ $article->id }}" >{!! $article->title !!}</a></p>
                                <p><p>{!! str_limit(strip_tags($article->content),100, '...') !!}</p>
                            </div>
                        @endforeach
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        @foreach($starsInfo as $star)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{ $star->name }}</p>
                            <p class="">关注：{{ $star->stars_count }} | 粉丝：{{ $star->fans_count }}｜ 文章：{{ $star->articles_count }}</p>
                        </div>
                        @endforeach

                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        @foreach($fansInfo as $fan)
                            <div class="blog-post" style="margin-top: 30px">
                                <p class="">{{ $fan->name }}</p>
                                <p class="">关注：{{ $fan->stars_count }} | 粉丝：{{ $fan->fans_count }}｜ 文章：{{ $fan->articles_count }}</p>
                            </div>
                        @endforeach
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>

        </div><!-- /.blog-main -->
        @include('layout.sidebar')

    </div>    </div><!-- /.row -->
</div><!-- /.container -->

@endsection

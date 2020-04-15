@extends('layout.main')

@section('content')
<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">
        <div class="col-sm-8 blog-main">
            <div>
                <div id="carousel-example" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example" data-slide-to="1"></li>
                        <li data-target="#carousel-example" data-slide-to="2"></li>
                    </ol><!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="/image/11.jpeg" alt="..." />
                            <div class="carousel-caption">...</div>
                        </div>
                        <div class="item">
                            <img src="/image/22.jpeg" alt="..." />
                            <div class="carousel-caption">...</div>
                        </div>
                        <div class="item">
                            <img src="/image/33.jpeg" alt="..." />
                            <div class="carousel-caption">...</div>
                        </div>
                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span></a>
                    <a class="right carousel-control" href="#carousel-example" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </div>        <div style="height: 20px;">
            </div>
            <div>

                @forelse($list as $value)
                <div class="blog-post">
                    <h3 class="blog-post-title"><a href="/article/{{$value['id']}}" >{!! $value['title'] !!}</a></h3>
                    <p class="blog-post-meta">{{$value['created_at']->toFormattedDateString()}} <a href="/user/{{ $value->blog_user_id }}">{{ $value->blogUser->name }}</a></p>

                    <p>{!! str_limit(strip_tags($value['content']), 100, '...') !!}
                    <p class="blog-post-meta">赞 {{ $value->likes_count }}  | 评论 {{ $value->comment_count }}</p>
                </div>
                @empty
                    <div class="alert-danger" style="margin-bottom:20px">很抱歉，没有找到任何内容</div>
                @endforelse
               {{$list->links()}}

            </div><!-- /.blog-main -->
        </div>


        @include("layout.sidebar")

    </div>    </div><!-- /.row -->
</div><!-- /.container -->

@endsection



<div class="blog-masthead">
    <div class="container">
        <form action="/article/search" method="post">
            {{ csrf_field() }}
        <ul class="nav navbar-nav navbar-left">
            <li>
                <a class="blog-nav-item " href="/article">首页</a>
            </li>
            <li>
                <a class="blog-nav-item" href="/article/create">写文章</a>
            </li>
            <li>
                <a class="blog-nav-item" href="/notices">通知</a>
                @can('hasNotice', Auth::user())
                <div class="notice"></div>
                @endcan
            </li>
                <li>
                    <input name="content" type="text" value="" class="form-control" style="margin-top:10px" placeholder="搜索文章">
                </li>
                <li>
                    <button class="btn btn-default" style="margin-top:10px" type="submit">Search</button>
                </li>
        </ul>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <div>
                    @if(Auth::user())
                    <img src="{{ Auth::user()->avatar }}" alt="" class="img-rounded" style="border-radius:500px; height: 30px;">
                    <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/user/{{ Auth::id() }}">我的主页</a></li>
                            <li><a href="/user/{{Auth::id()}}/setting">个人设置</a></li>
                            <li><a href="/logout">登出</a></li>
                        </ul>
                    @else
                        <a href="/login" class="blog-nav-item">登录</a>
                    @endif
                </div>
            </li>
        </ul>
    </div>
</div>
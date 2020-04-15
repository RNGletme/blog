@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">文章列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 50px">#</th>
                                <th>文章标题</th>
                                <th>操作</th>
                            </tr>
                            @foreach($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td><a href="/article/{{ $article->id }}">{{ $article->title }}</a></td>
                                <td>
                                    <button type="button" class="btn btn-status article-action" article-id="{{ $article->id }}" article-action-status="1"  style="width: 50px;">通过</button>
                                    <button type="button" class="btn btn-status article-action" article-id="{{ $article->id }}" article-action-status="2" style="width: 50px;">拒绝</button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <p>这是测试钩子</p>
    <!-- /.content -->
</div>
@endsection



@extends('admin.layout.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-10 col-xs-6">
                    <div class="box">

                        <div class="box-header with-border">
                            <h3 class="box-title">通知列表</h3>
                        </div>
                        <a type="button" class="btn " href="/admin/notices/create">增加通知</a>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody><tr>
                                    <th style="width: 10px">#</th>
                                    <th>通知名称</th>
                                    <th>内容</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($notices as $notice)
                                <tr>
                                    <td>{{ $notice->id }}</td>
                                    <td>{{ $notice->title }}</td>
                                    <td style="max-width: 800px">{{ $notice->content }}</td>
                                    <td>
                                        @if($notice->status != 0)
                                            <button type="button" class="btn btn-status btn-default notice-action" disabled="disabled">已发送</button>
                                        @else
                                            <button type="button" class="btn btn-status btn-default notice-action" notice-url="/admin/notices/{{ $notice->id }}/send" notice-action="send" style="width: 70px">发送 </button>
                                        @endif
                                        <button type="button" class="btn btn-status btn-default notice-action" notice-url="/admin/notices/{{ $notice->id }}/delete" notice-action="delete" style="width: 70px">删除</button>
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
        <!-- /.content -->
    </div>
@endsection


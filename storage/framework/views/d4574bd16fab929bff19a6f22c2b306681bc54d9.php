<?php $__env->startSection('content'); ?>
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
                            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($article->id); ?></td>
                                <td><a href="/article/<?php echo e($article->id); ?>"><?php echo e($article->title); ?></a></td>
                                <td>
                                    <button type="button" class="btn btn-status article-action" article-id="<?php echo e($article->id); ?>" article-action-status="1"  style="width: 50px;">通过</button>
                                    <button type="button" class="btn btn-status article-action" article-id="<?php echo e($article->id); ?>" article-action-status="2" style="width: 50px;">拒绝</button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
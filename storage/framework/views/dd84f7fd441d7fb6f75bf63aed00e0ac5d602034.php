<?php $__env->startSection('content'); ?>
<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">

        <div class="col-sm-8 blog-main">
            <form class="form-horizontal" action="/user/me/setting" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="name" type="text" value="<?php echo e(Auth::user()->name); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">头像</label>
                    <div class="col-sm-2">
                        <input class=" file-loading preview_input" type="file" value="用户名" style="width:200px" name="avatar">
                        <br>
                        <img  id="preview_img" class="preview_img" src="<?php echo e($user->avatar); ?>" alt="" class="img-rounded" style="border-radius:500px;width:100px;height: 100px">
                    </div>
                </div>
                <?php echo $__env->make('layout.errorMsg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <button type="submit" class="btn btn-default">修改</button>
            </form>
            <br>

        </div>

        <?php echo $__env->make("layout.sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    </div>    </div><!-- /.row -->
</div><!-- /.container -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
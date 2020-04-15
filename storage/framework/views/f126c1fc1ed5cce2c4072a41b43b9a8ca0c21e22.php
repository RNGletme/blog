<?php $__env->startSection('content'); ?>
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
                            <img src="/image/1.jpg" alt="..." />
                            <div class="carousel-caption">...</div>
                        </div>
                        <div class="item">
                            <img src="/image/2.jpg" alt="..." />
                            <div class="carousel-caption">...</div>
                        </div>
                        <div class="item">
                            <img src="/image/3.jpg" alt="..." />
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

                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="blog-post">
                    <h3 class="blog-post-title"><a href="/article/<?php echo e($value['id']); ?>" ><?php echo $value['title']; ?></a></h3>
                    <p class="blog-post-meta"><?php echo e($value['created_at']->toFormattedDateString()); ?> <a href="/user/<?php echo e($value->blog_user_id); ?>"><?php echo e($value->blogUser->name); ?></a></p>

                    <p><?php echo str_limit(strip_tags($value['content']), 100, '...'); ?>

                    <p class="blog-post-meta">赞 <?php echo e($value->likes_count); ?>  | 评论 <?php echo e($value->comment_count); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php echo e($list->links()); ?>


            </div><!-- /.blog-main -->
        </div>


        <?php echo $__env->make("layout.sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>    </div><!-- /.row -->
</div><!-- /.container -->

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
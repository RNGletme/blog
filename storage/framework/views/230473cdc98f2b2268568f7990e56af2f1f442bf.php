<?php $__env->startSection('content'); ?>
<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">

        <div class="col-sm-8">
            <blockquote>
                <p><img src="<?php echo e($blogUser->avatar); ?>" alt="" class="img-rounded" style="border-radius:500px; height: 40px"> <?php echo e($blogUser->name); ?>

                    &nbsp;&nbsp;<?php echo $__env->make('user.likeButton', ['id'=>$blogUser->id], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></p>
                <footer>关注：<?php echo e($blogUser->stars_count); ?>｜粉丝：<?php echo e($blogUser->fans_count); ?>｜文章：<?php echo e($blogUser->articles_count); ?></footer>
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
                        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="blog-post" style="margin-top: 30px">
                                <p class=""><a href="/user/<?php echo e($blogUser->id); ?>"><?php echo e($blogUser->name); ?></a>
                                </p>
                                <p class=""><a href="/article/<?php echo e($article->id); ?>" ><?php echo $article->title; ?></a></p>
                                <p><p><?php echo str_limit(strip_tags($article->content),100, '...'); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <?php $__currentLoopData = $starsInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $star): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="blog-post" style="margin-top: 30px">
                            <p class=""><?php echo e($star->name); ?></p>
                            <p class="">关注：<?php echo e($star->stars_count); ?> | 粉丝：<?php echo e($star->fans_count); ?>｜ 文章：<?php echo e($star->articles_count); ?></p>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        <?php $__currentLoopData = $fansInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="blog-post" style="margin-top: 30px">
                                <p class=""><?php echo e($fan->name); ?></p>
                                <p class="">关注：<?php echo e($fan->stars_count); ?> | 粉丝：<?php echo e($fan->fans_count); ?>｜ 文章：<?php echo e($fan->articles_count); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>

        </div><!-- /.blog-main -->
        <?php echo $__env->make('layout.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>    </div><!-- /.row -->
</div><!-- /.container -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
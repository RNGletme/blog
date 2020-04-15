<?php $__env->startSection('content'); ?>
<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">

        <div class="col-sm-8">
            <blockquote>
                <p><?php echo e($topic->name); ?></p>
                <span style="margin-right: 20px">文章：<?php echo e($topic->article_topic_count); ?></span>
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
                        <form action="/topic/<?php echo e($topic->id); ?>/submit" method="post">
                            <?php echo e(csrf_field()); ?>

                            <?php $__currentLoopData = $articlesNoByTopic; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="article_id[]" value="<?php echo e($article->id); ?>">
                                    <?php echo e($article->title); ?>

                                </label>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <button type="submit" class="btn btn-default">投稿</button>
                            <?php echo $__env->make('layout.errorMsg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="blog-post" style="margin-top: 30px">

                            <p class=""><a href="/user/<?php echo e($article->blog_user_id); ?>"><?php echo e($article->blogUser->name); ?></a> <?php echo e($article->created_at->toFormattedDateString()); ?></p>
                            <p class=""><a href="/article/<?php echo e($article->id); ?>" ><?php echo e(str_limit(strip_tags($article->title), 100, '...')); ?></a></p>
                            <p><?php echo e(str_limit(strip_tags($article->content), 100, '...')); ?></p>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>
                <!-- /.tab-content -->
            </div>


        </div><!-- /.blog-main -->
        <?php echo $__env->make("layout.sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div><!-- /.row -->
</div><!-- /.container -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
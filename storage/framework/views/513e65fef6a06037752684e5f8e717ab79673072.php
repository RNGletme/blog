<?php $__env->startSection('content'); ?>
<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">


        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <div style="display:inline-flex">
                    <h2 class="blog-post-title"><?php echo $article['title']; ?></h2>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $article)): ?>
                        <a style="margin: auto 50px"  href="/article/<?php echo e($article['id']); ?>/edit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $article)): ?>
                        <a style="margin: auto"  href="/article/<?php echo e($article['id']); ?>/delete">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </a>
                    <?php endif; ?>
                </div>

                <p class="blog-post-meta"><?php echo $article['created_at']->toFormattedDateString(); ?><a href="/user/<?php echo e($article->blog_user_id); ?>" style="margin-left: 20px"><?php echo e($article->blogUser->name); ?></a></p>

                <p><?php echo $article['content']; ?><p><p><br></p>
                <div>
                    <?php if(!Auth::user()): ?>
                        <p class="alert alert-danger">评论和点赞功能需登录^_^<a href="/login">&nbsp;点我登录</a></p>
                    <?php endif; ?>
                    <?php if(!$article->like(Auth::id())->exists()): ?>
                    <a href="/article/<?php echo e($article['id']); ?>/like" type="button" class="btn btn-primary btn-lg">赞</a>
                    <?php else: ?>
                        <a href="/article/<?php echo e($article['id']); ?>/unlike" type="button" class="btn btn-primary btn-lg">取消</a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">评论</div>

                <!-- List group -->
                <ul class="list-group">
                    <?php $__currentLoopData = $article->comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item">
                        <h5><?php echo e($comment->created_at); ?> by <?php echo e($comment->blogUser->name); ?></h5>
                        <div>
                            <?php echo e($comment->content); ?>

                        </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">发表评论</div>

                <!-- List group -->
                <ul class="list-group">
                    <form action="/article/<?php echo e($article->id); ?>/comment" method="post">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="article_id" value="<?php echo e($article->id); ?>"/>
                        <li class="list-group-item">
                            <textarea name="content" class="form-control" rows="10"></textarea>
                            <?php echo $__env->make('layout.errorMsg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <button class="btn btn-default" type="submit">提交</button>
                        </li>
                    </form>

                </ul>
            </div>

        </div><!-- /.blog-main -->

        <?php echo $__env->make("layout.sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>
</div><!-- /.container -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
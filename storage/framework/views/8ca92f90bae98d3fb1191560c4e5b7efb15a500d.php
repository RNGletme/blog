<?php if(Auth::id() != $id): ?>
    <?php if(Auth::user()->star($id)->exists()): ?>
    <button class="btn btn-default like-button" like-value="0" like-user="<?php echo e($id); ?>" type="button">取消关注</button>
    <?php else: ?>
    <button class="btn btn-default like-button" like-value="1" like-user="<?php echo e($id); ?>" type="button">关注</button>
    <?php endif; ?>
<?php endif; ?>

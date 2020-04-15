<?php $__env->startSection('content'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-10 col-xs-6">
                    <div class="box">

                        <div class="box-header with-border">
                            <h3 class="box-title">权限列表</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="/admin/roles/<?php echo e($role->id); ?>/permission" method="POST">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]"
                                                   <?php if($hasPermissions->contains($permission)): ?>
                                                   checked
                                                   <?php endif; ?>
                                                   value="<?php echo e($permission->id); ?>">
                                            <?php echo e($permission->name); ?>

                                        </label>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('layout.errorMsg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
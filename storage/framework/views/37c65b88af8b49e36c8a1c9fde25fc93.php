

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h3 class="mb-4">My Applications</h3> <!-- ✅ Keep this heading -->

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($applications->isEmpty()): ?>
        <div class="alert alert-info">You haven't applied for any jobs yet.</div>
    <?php else: ?>
    <table class="table table-striped">
        <thead class="table-light">
            <tr>
                <th>Job Title</th>
                <th>Applied Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($app->JobTitle); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($app->AppliedDate)->format('d M, Y')); ?></td>
                <td>
                    <?php if($app->Status === 'Pending'): ?>
                        <span class="badge bg-warning text-dark"><?php echo e($app->Status); ?></span>
                    <?php elseif($app->Status === 'Approved'): ?>
                        <span class="badge bg-success"><?php echo e($app->Status); ?></span>
                    <?php elseif($app->Status === 'Rejected'): ?>
                        <span class="badge bg-danger"><?php echo e($app->Status); ?></span>
                    <?php else: ?>
                        <span class="badge bg-secondary"><?php echo e($app->Status); ?></span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\job_portal\resources\views/jobseeker/applications/index.blade.php ENDPATH**/ ?>
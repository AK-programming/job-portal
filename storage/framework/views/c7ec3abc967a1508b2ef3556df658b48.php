

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-center mb-8 text-indigo-700">Admin Control Panel</h2>

    <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 text-center">
            <?php echo e(session('success')); ?>

        </div>
    <?php elseif(session('error')): ?>
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 text-center">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <!-- Employer Verification -->
    <div class="bg-white rounded-xl shadow-lg mb-8">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-semibold rounded-t-xl">Unverified Employers</div>
        <div class="p-6">
            <?php if($employers->isEmpty()): ?>
                <p class="text-gray-500 text-center">No unverified employers found.</p>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-center">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="py-2 px-3 font-semibold">User ID</th>
                                <th class="py-2 px-3 font-semibold">Name</th>
                                <th class="py-2 px-3 font-semibold">Email</th>
                                <th class="py-2 px-3 font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $employers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-2 px-3"><?php echo e($emp->UserID); ?></td>
                                    <td class="py-2 px-3"><?php echo e($emp->Name); ?></td>
                                    <td class="py-2 px-3"><?php echo e($emp->Email); ?></td>
                                    <td class="py-2 px-3">
                                        <form method="POST" action="<?php echo e(route('admin.update.employer', $emp->UserID)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="VerifiedStatus" value="1">
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded shadow transition">✔ Verify</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Application Status -->
    <div class="bg-white rounded-xl shadow-lg">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-yellow-400 to-orange-400 text-white font-semibold rounded-t-xl">Pending Job Applications</div>
        <div class="p-6">
            <?php if($applications->isEmpty()): ?>
                <p class="text-gray-500 text-center">No pending applications found.</p>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-center">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="py-2 px-3 font-semibold">Application ID</th>
                                <th class="py-2 px-3 font-semibold">Job ID</th>
                                <th class="py-2 px-3 font-semibold">Seeker ID</th>
                                <th class="py-2 px-3 font-semibold">Date</th>
                                <th class="py-2 px-3 font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-2 px-3"><?php echo e($app->ApplicationID); ?></td>
                                    <td class="py-2 px-3"><?php echo e($app->JobID); ?></td>
                                    <td class="py-2 px-3"><?php echo e($app->SeekerID); ?></td>
                                    <td class="py-2 px-3"><?php echo e($app->AppliedDate); ?></td>
                                    <td class="py-2 px-3 flex flex-col gap-2 items-center justify-center">
                                        <form method="POST" action="<?php echo e(route('admin.update.application', $app->ApplicationID)); ?>" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="status" value="Reviewed">
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded shadow transition">✔ Mark Reviewed</button>
                                        </form>
                                        <form method="POST" action="<?php echo e(route('admin.update.application', $app->ApplicationID)); ?>" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="status" value="Rejected">
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow transition">✖ Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\job_portal\resources\views/admin.blade.php ENDPATH**/ ?>
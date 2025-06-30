

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto px-4 py-10">
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-2xl font-bold text-indigo-700 mb-6 text-center">Post a New Job</h2>

        
        <?php if($errors->any()): ?>
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                <ul class="mb-0 list-disc list-inside">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        
        <form method="POST" action="<?php echo e(route('jobs.store')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>
            <div>
                <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                <input type="text" name="company_name" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
            </div>
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                <input type="text" name="title" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none" value="<?php echo e(old('title')); ?>" required>
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Job Description</label>
                <textarea name="description" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none resize-none" rows="4" required><?php echo e(old('description')); ?></textarea>
            </div>
            <div>
                <label for="requirements" class="block text-sm font-medium text-gray-700 mb-1">Requirements</label>
                <textarea name="requirements" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none resize-none" rows="4" required><?php echo e(old('requirements')); ?></textarea>
            </div>
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <input type="text" name="location" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none" value="<?php echo e(old('location')); ?>" required>
            </div>
            <div>
                <label for="salary" class="block text-sm font-medium text-gray-700 mb-1">Salary Range</label>
                <input type="text" name="salary" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none" value="<?php echo e(old('salary')); ?>" required>
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow transition text-lg">Post Job</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\job_portal\resources\views/jobs/create.blade.php ENDPATH**/ ?>
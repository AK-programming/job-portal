<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Job Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
      body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-blue-50 to-yellow-50">
    <div class="w-full max-w-md mx-auto p-6 bg-white rounded-2xl shadow-xl">
        <div class="flex flex-col items-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.657-2.686-3-6-3s-6 1.343-6 3m12 0c0-1.657 2.686-3 6-3s6 1.343 6 3m-12 0v7m0 0c0 1.657 2.686 3 6 3s6-1.343 6-3m-12 0c0 1.657-2.686 3-6 3s-6-1.343-6-3" /></svg>
            <h1 class="text-2xl font-bold text-indigo-700">Job Sphere Login</h1>
        </div>
        <form method="POST" action="<?php echo e(route('login.submit')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>
            <?php if($errors->any()): ?>
                <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-2 text-center"><?php echo e($errors->first()); ?></div>
            <?php endif; ?>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                <input type="email" name="email" id="email" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none" placeholder="name@example.com" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none" placeholder="Password" required>
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow transition text-lg">Sign in</button>
            <div class="flex flex-col items-center mt-4">
                <a href="<?php echo e(route('register')); ?>" class="text-indigo-500 hover:underline text-sm">Don't have an account? Register here</a>
            </div>
            <p class="text-xs text-gray-400 text-center mt-6">&copy; Job Portal <?php echo e(date('Y')); ?></p>
        </form>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\job_portal\resources\views/auth/login.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page - JobSphere</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .btn-primary {
            background: linear-gradient(to right, #3b82f6, #8b5cf6);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .btn-primary:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        .card-glass {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        .card-glass:hover {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="text-center text-white mb-8">
            <h1 class="text-4xl font-bold mb-4">
                <i class="fas fa-crown mr-2"></i>JobSphere Test Page
            </h1>
            <p class="text-xl">Testing Tailwind CSS and Custom Styles</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="card-glass p-6 text-center">
                <i class="fas fa-users text-4xl text-blue-500 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">500+</h3>
                <p class="text-gray-600">Companies</p>
            </div>
            
            <div class="card-glass p-6 text-center">
                <i class="fas fa-briefcase text-4xl text-green-500 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">10K+</h3>
                <p class="text-gray-600">Jobs</p>
            </div>
            
            <div class="card-glass p-6 text-center">
                <i class="fas fa-user text-4xl text-purple-500 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">50K+</h3>
                <p class="text-gray-600">Users</p>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <button class="btn-primary mr-4">
                <i class="fas fa-search mr-2"></i>Test Button
            </button>
            <a href="/admin" class="btn-primary">
                <i class="fas fa-cog mr-2"></i>Go to Admin
            </a>
        </div>
    </div>
</body>
</html> 
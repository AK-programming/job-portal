<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Job Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background: #f8f9fa;
    }
    .form-register {
      max-width: 400px;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<div class="form-register">
  <h2 class="mb-4 text-center">Create an Account</h2>

  @if($errors->any())
    <div class="alert alert-danger">
      {{ $errors->first() }}
    </div>
  @endif

  <form method="POST" action="{{ route('register.submit') }}">
    @csrf

    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>User Type</label>
      <select name="user_type" class="form-select" required>
        <option value="jobseeker">Job Seeker</option>
        <option value="employer">Employer</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary w-100">Register</button>
    <a href="{{ route('login') }}" class="btn btn-link mt-3 d-block text-center">Back to Login</a>
  </form>
</div>

</body>
</html>

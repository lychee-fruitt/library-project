<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src="{{ asset('images/banner-login.png') }}" alt="logo-library" class="h-20 w-auto mb-10 ml-auto mr-3 ">
          <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Create an account</h2>
          <p class="mt-2 text-center text-sm/6 text-gray-500">
            Already a member?
            <a href="{{route('login')}}" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign in</a>
          </p>
        </div>
      
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
          <form class="space-y-6" action="{{ route('register') }}" method="POST">
            @csrf
            <!-- Full Name -->
            <div>
              <label for="name" class="block text-sm font-medium text-gray-900">Full Name</label>
              <div class="mt-2">
                <input id="name" name="name" type="text" value="{{ old('name') }}" required class="block w-full rounded-md text-gray-900 shadow-sm">
                @error('name')
                  <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
              </div>
            </div>
          
            <!-- Username -->
            <div>
              <label for="username" class="block text-sm font-medium text-gray-900">Username</label>
              <div class="mt-2">
                <input id="username" name="username" type="text" value="{{ old('username') }}" required class="block w-full rounded-md text-gray-900 shadow-sm">
                @error('username')
                  <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div>
              <label for="phone" class="block text-sm font-medium text-gray-900">Phone Number</label>
              <div class="mt-2">
                <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required class="block w-full rounded-md text-gray-900 shadow-sm">
                @error('phone')
                  <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
              </div>
            </div>
          
            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
              <div class="mt-2">
                <input id="email" name="email" type="email" value="{{ old('email') }}" required class="block w-full rounded-md text-gray-900 shadow-sm">
                @error('email')
                  <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
              </div>
            </div>
          
            <!-- Password -->
            <div>
              <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
              <div class="mt-2">
                <input id="password" name="password" type="password" required class="block w-full rounded-md text-gray-900 shadow-sm">
                @error('password')
                  <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
              </div>
            </div>
          
            <!-- Confirm Password -->
            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Confirm Password</label>
              <div class="mt-2">
                <input id="password_confirmation" name="password_confirmation" type="password" required class="block w-full rounded-md text-gray-900 shadow-sm">
                @error('password_confirmation')
                  <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
              </div>
            </div>
          
            <div>
              <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md">Sign Up</button>
            </div>
          </form>
        </div>
      </div>
    
</body>
</html>

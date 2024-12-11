<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center">
  <div class="flex max-w-7xl w-full bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="w-1/2 px-12 py-16 flex flex-col justify-center">
      <img src="{{ asset('images/banner-login.png') }}" alt="logo-library" class="h-20 w-auto mb-10 mx-auto ml-0 ">
      <h2 class="text-2xl font-bold text-gray-900 mb-2">Sign in to your account</h2>
      <p class="text-sm text-gray-500 mb-8">
        Don't have an account? <a href="{{route('register')}}" class="text-indigo-600 font-semibold hover:underline">Sign-up now</a>
      </p>
      
      <form action="{{ route('login') }}" method="POST" class="space-y-6">
        @csrf 
        <div>
          <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
          <input id="username" name="username" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        
        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          </div>
          <input id="password" name="password" type="password" autocomplete="current-password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="flex items-center">
          <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
          <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
        </div>

        <div>
          <button type="submit" class="w-full flex justify-center bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Sign in
          </button>
        </div>
      </form>

      <div class="mt-6 text-center">
        <p class="text-sm "></p>
        <div class="mt-3 flex justify-center space-x-4">
          <button class=" p-2 rounded-md ">
            <img src="" alt="" class="h-6">
          </button>
          <button class=" p-2 rounded-md ">
            <img src="" alt="" class="h-6">
          </button>
        </div>
      </div>
    </div>

    <div class="w-1/2 hidden lg:block">
      <img src="{{ asset('images/Image_login.jpg') }}" alt="left-loginside-Image" class="object-cover w-full h-full">
    </div>
  </div>
</body>
</html>

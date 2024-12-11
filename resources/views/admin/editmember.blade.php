<x-adminlayout>
    <div class="max-w-4xl mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Edit Account</h2>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" 
              class="bg-white p-6 rounded-lg shadow-md dark:bg-gray-800">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                <input type="text" name="name" id="name" 
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                       value="{{ old('name', $user->name) }}" required>
                @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Username</label>
                <input type="text" name="username" id="username" 
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                       value="{{ old('username', $user->username) }}" required>
                @error('username')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                <input type="email" name="email" id="email" 
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                       value="{{ old('email', $user->email) }}" required>
                @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Phone</label>
                <input type="text" name="phone" id="phone" 
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                       value="{{ old('phone', $user->phone) }}" required>
                @error('phone')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="role_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Role</label>
                <select name="role_id" id="role_id" 
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" 
                                {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                            {{ $role->role_name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
                <input type="password" name="password" id="password" 
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Leave blank if you don't want to change the password.</p>
                @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Update Account
            </button>
        </form>
    </div>
</x-adminlayout>

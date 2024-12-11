<x-adminlayout>
    <div class="max-w-2xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-6">Edit Category</h1>

        <!-- Form chỉnh sửa thể loại -->
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Tên thể loại -->
            <div class="mb-4">
                <label for="category_name" class="block mb-2 text-sm font-medium text-gray-700">Category Name</label>
                <input type="text" id="category_name" name="category_name" 
                       value="{{ old('category_name', $category->category_name) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('category_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mô tả -->
            <div class="mb-4">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description"
                          class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Trạng thái -->
            <div class="mb-4">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="1" {{ $category->status ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$category->status ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nút cập nhật -->
            <div class="flex items-center justify-end">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-gray-700 hover:underline">Cancel</a>
                <button type="submit" class="ml-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</x-adminlayout>

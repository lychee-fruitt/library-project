<x-adminlayout>
    <div class="max-w-2xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-6">Add New Book</h1>

        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- ISBN -->
            <div class="mb-4">
                <label for="ISBN" class="block mb-2 text-sm font-medium text-gray-700">ISBN</label>
                <input type="text" id="ISBN" name="ISBN" 
                       value="{{ old('ISBN') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('ISBN')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" 
                       value="{{ old('title') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Publish Year -->
            <div class="mb-4">
                <label for="publish_year" class="block mb-2 text-sm font-medium text-gray-700">Publish Year</label>
                <input type="number" id="publish_year" name="publish_year" 
                       value="{{ old('publish_year') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('publish_year')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Author -->
            <div class="mb-4">
                <label for="author" class="block mb-2 text-sm font-medium text-gray-700">Author</label>
                <input type="text" id="author" name="author" 
                       value="{{ old('author') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('author')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label for="cate_id" class="block mb-2 text-sm font-medium text-gray-700">Category</label>
                <select id="cate_id" name="cate_id" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                @error('cate_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Total Copies -->
            <div class="mb-4">
                <label for="total_copies" class="block mb-2 text-sm font-medium text-gray-700">Total Copies</label>
                <input type="number" id="total_copies" name="total_copies" 
                       value="{{ old('total_copies') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('total_copies')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-700">Price</label>
                <input type="number" id="price" name="price" 
                       value="{{ old('price') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Cover Image -->

            <div class="mb-4">
                <label for="cover_image" class="block mb-2 text-sm font-medium text-gray-700">Cover Image</label>
                <input type="file" id="cover_image" name="cover_image" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('cover_image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-end">
                <a href="{{ route('admin.bookmanagement') }}" class="px-4 py-2 text-gray-700 hover:underline">Cancel</a>
                <button type="submit" class="ml-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Save Book
                </button>
            </div>
        </form>
    </div>

</x-adminlayout>

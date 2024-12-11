<x-adminlayout>
    <div class="max-w-2xl mx-auto mt-10">

        <!-- Form chỉnh sửa sách -->
        <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')  

            <!-- ISBN -->
            <div class="mb-4">
                <label for="ISBN" class="block mb-2 text-sm font-medium text-gray-700">ISBN</label>
                <input type="text" id="ISBN" name="ISBN" 
                       value="{{ old('ISBN', $book->ISBN) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('ISBN')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tên sách -->
            <div class="mb-4">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" 
                       value="{{ old('title', $book->title) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Năm xuất bản -->
            <div class="mb-4">
                <label for="publish_year" class="block mb-2 text-sm font-medium text-gray-700">Publish Year</label>
                <input type="number" id="publish_year" name="publish_year" 
                       value="{{ old('publish_year', $book->publish_year) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('publish_year')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tác giả -->
            <div class="mb-4">
                <label for="author" class="block mb-2 text-sm font-medium text-gray-700">Author</label>
                <input type="text" id="author" name="author" 
                       value="{{ old('author', $book->author) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('author')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Thể loại -->
            <div class="mb-4">
                <label for="cate_id" class="block mb-2 text-sm font-medium text-gray-700">Category</label>
                <select id="cate_id" name="cate_id" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $book->cate_id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
                @error('cate_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tổng số bản sao -->
            <div class="mb-4">
                <label for="total_copies" class="block mb-2 text-sm font-medium text-gray-700">Total Copies</label>
                <input type="number" id="total_copies" name="total_copies" 
                       value="{{ old('total_copies', $book->total_copies) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('total_copies')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Số bản sao còn lại -->
            <div class="mb-4">
                <label for="available_copies" class="block mb-2 text-sm font-medium text-gray-700">Available Copies</label>
                <input type="number" id="available_copies" name="available_copies" 
                       value="{{ old('available_copies', $book->available_copies) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('available_copies')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Giá -->
            <div class="mb-4">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-700">Price</label>
                <input type="number" id="price" name="price" 
                       value="{{ old('price', $book->price) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Trạng thái -->

            <div class="mb-4">
                <label for="cover_image" class="block mb-2 text-sm font-medium text-gray-700">Cover Image</label>
                <input type="file" id="cover_image" name="cover_image" accept="image/*" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
            
                @if($book->cover_image)
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Current Image:</p>
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Current Cover Image" class="max-w-xs mt-2">
                    </div>
                @endif
            
                @error('cover_image')   
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nút cập nhật -->
            <div class="flex items-center justify-end">
                <a href="{{ route('admin.bookmanagement') }}" class="px-4 py-2 text-gray-700 hover:underline">Cancel</a>
                <button type="submit" class="ml-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Update Book
                </button>
            </div>
        </form>
    </div>
</x-adminlayout>
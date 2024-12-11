<x-adminlayout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
        <!-- Tiêu đề và nút Add Book -->
        <div class="flex justify-between items-center my-4">
            <h2 class="text-xl font-bold text-gray-700">Book Management</h2>
            <a href="{{ route('admin.books.create') }}" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Add Book
            </a>
        </div>

        <!-- Form lọc -->
        <form method="GET" action="{{ route('admin.bookmanagement') }}" class="mb-4">
            <div class="flex items-center gap-4">
                <!-- Tìm kiếm theo tên sách -->
                <input 
                    type="text" 
                    name="title" 
                    placeholder="Search by title" 
                    value="{{ request('title') }}" 
                    class="px-4 py-2 border rounded-lg"
                />

                <!-- Lọc theo thể loại -->
                <select name="cate_id" class="px-4 py-2 border rounded-lg">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('cate_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>

                <!-- Lọc theo khoảng giá -->
                <input 
                    type="number" 
                    name="min_price" 
                    placeholder="Min Price" 
                    value="{{ request('min_price') }}" 
                    class="px-4 py-2 border rounded-lg"
                />
                <input 
                    type="number" 
                    name="max_price" 
                    placeholder="Max Price" 
                    value="{{ request('max_price') }}" 
                    class="px-4 py-2 border rounded-lg"
                />

                <!-- Nút submit -->
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Filter
                </button>
            </div>
        </form>

        <!-- Bảng hiển thị danh sách sách -->
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ISBN</th>
                    <th scope="col" class="px-6 py-3">Title</th>
                    <th scope="col" class="px-6 py-3">Publish Year</th>
                    <th scope="col" class="px-6 py-3">Author</th>
                    <th scope="col" class="px-6 py-3">Category</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                    <th scope="col" class="px-6 py-3">Total of Copies</th>
                    <th scope="col" class="px-6 py-3">Available Copies</th>
                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $book->ISBN }}
                        </th>
                        <td class="px-6 py-4">{{ $book->title }}</td>
                        <td class="px-6 py-4">{{ $book->publish_year }}</td>
                        <td class="px-6 py-4">{{ $book->author }}</td>
                        <td class="px-6 py-4">{{ $book->category->category_name ?? 'No Category' }}</td>
                        <td class="px-6 py-4">{{ number_format($book->price, 0, ',', '.') }}$</td>
                        <td class="px-6 py-4">{{ $book->total_copies }}</td>
                        <td class="px-6 py-4">{{ $book->available_copies }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('admin.books.delete', $book->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline ml-4">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No books found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-adminlayout>
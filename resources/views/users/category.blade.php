<x-userlayout>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Books by Category</h1>

        <!-- Filter by Category -->
        <form action="{{ route('user.category') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <label for="category" class="form-label">Choose a Category:</label>
                    <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                @if($category->id == $selectedCategory) selected @endif>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <div class="row row-cols-1 row-cols-md-3 g-4"> 
            @foreach($books as $book)
                <div class="col">
                    <div class="card h-100 shadow-sm d-flex flex-column" style="height: 450px;"> 
                    
                        <a href="{{ route('user.book', $book->id) }}" class="text-decoration-none text-dark">
                            <img src="{{ asset('storage/' . $book->cover_image) }}" 
                                 class="card-img-top book-cover" 
                                 alt="{{ $book->title }}">
                        </a>
                        <div class="card-body text-center flex-grow-1" style="padding: 20px;"> 
                
                            <a href="{{ route('user.book', $book->id) }}" class="text-decoration-none text-dark">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text text-muted">{{ $book->author }}</p>
                            </a>
                        </div>
                        
                        <form action="{{ route('users.add_to_borrow_list') }}" method="POST" class="d-flex justify-content-center mt-auto">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-success btn-sm">Add</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

   
        <div class="mt-4 d-flex justify-content-center">
            {{ $books->links('pagination::bootstrap-4') }}
        </div>

        @if(session('success'))
            <div class="alert alert-success mt-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-4" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <style>
        .book-cover {
            width: 100%; 
            max-height: 250px; 
            object-fit: contain; 
            margin: 0 auto; 
            border-radius: 8px; 
            padding: 10px;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between; 
            padding: 20px; 
        }
        .btn-success {
            margin-top: auto; 
            padding: 8px 16px; 
            margin-bottom: 20px;
        }
        .btn-sm {
            font-size: 0.875rem; 
        }
    </style>
</x-userlayout>

<x-userlayout>
    <div class="book-detail">
        <h1 class="book-title">{{ $book->title }}</h1>
        <div class="book-info">
            <!-- Book Image -->
            <div class="book-image">
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="img-fluid">
            </div>

            <!-- Book Details -->
            <div class="book-details">
                <p><strong>Author:</strong> {{ $book->author }}</p>
                <p><strong>Category:</strong> {{ $book->category->name }}</p>
                <p><strong>Published Year:</strong> {{ $book->publish_year }}</p>
                <p><strong>Total Copies:</strong> {{ $book->total_copies }}</p>
                <p><strong>Available Copies:</strong> {{ $book->available_copies }}</p>
                <p><strong>Price:</strong> ${{ number_format($book->price, 2) }}</p>

                <!-- Quantity Input -->
                <div class="quantity-selector">
                    <label for="quantity"><strong>Quantity:</strong></label>
                    <button type="button" class="btn btn-secondary btn-sm" id="decrease">-</button>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $book->available_copies }}" class="quantity-input" />
                    <button type="button" class="btn btn-secondary btn-sm" id="increase">+</button>
                </div>

                <!-- Add to Borrow List Button -->
                <form action="{{ route('users.add_to_borrow_list') }}" method="POST" style="margin-top: 10px;">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="quantity" id="hidden-quantity" value="1">
                    <button type="submit" class="btn btn-success btn-sm" style="width: 100%;">Add to Borrow List</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .book-detail {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .book-title {
            width: 100%;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        .book-info {
            display: flex;
            justify-content: space-between;
            width: 100%;
            gap: 20px;
        }

        .book-image {
            max-width: 300px;
            flex-shrink: 0;
        }

        .book-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .book-details {
            flex-grow: 1;
            padding: 10px;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .quantity-selector button {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 0;
        }

        .quantity-input {
            width: 60px;
            height: 30px;
            text-align: center;
            margin: 0 10px;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 70px; 
        }
    </style>

    <!-- Custom JavaScript for Quantity Control -->
    <script>
        document.getElementById('increase').addEventListener('click', function() {
            var quantityInput = document.getElementById('quantity');
            var newQuantity = parseInt(quantityInput.value) + 1;
            var maxQuantity = parseInt(quantityInput.max);
            if (newQuantity <= maxQuantity) {
                quantityInput.value = newQuantity;
                document.getElementById('hidden-quantity').value = newQuantity;
            }
        });

        document.getElementById('decrease').addEventListener('click', function() {
            var quantityInput = document.getElementById('quantity');
            var newQuantity = parseInt(quantityInput.value) - 1;
            if (newQuantity >= 1) {
                quantityInput.value = newQuantity;
                document.getElementById('hidden-quantity').value = newQuantity;
            }
        });
    </script>
</x-userlayout>

<x-userlayout>
    <h3>Borrow List</h3>

    <!-- Filter form -->
    <form method="GET" action="{{ route('users.member_library') }}" class="mb-4">
        <div class="row g-3 align-items-end">
            <!-- Filter by book title -->
            <div class="col-md-4">
                <label for="book_title" class="form-label">Book Title</label>
                <input type="text" class="form-control rounded-3" id="book_title" name="book_title" value="{{ request('book_title') }}">
            </div>

            <!-- Filter by status -->
            <div class="col-md-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-select rounded-3" id="status" name="status">
                    <option value="">-- All Statuses --</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="returned" {{ request('status') === 'returned' ? 'selected' : '' }}>Returned</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <!-- Filter by borrow date -->
            <div class="col-md-4">
                <label for="borrow_date" class="form-label">Borrow Date</label>
                <input type="date" class="form-control rounded-3" id="borrow_date" name="borrow_date" value="{{ request('borrow_date') }}">
            </div>

            <!-- Submit button -->
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary rounded-3">Filter</button>
            </div>
        </div>
    </form>

    <table class="table table-striped mt-3 table-bordered rounded-3 shadow-sm">
        <thead class="bg-light">
            <tr>
                <th>Book Title</th>
                <th>Quantity</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowBooks as $borrowBook)
                <tr class="hover-row">
                    <td>{{ $borrowBook->book->title }}</td>
                    <td>{{ $borrowBook->quantity }}</td>
                    <td>{{ $borrowBook->borrow_date->format('Y-m-d') }}</td>
                    <td>{{ $borrowBook->return_date ? $borrowBook->return_date->format('Y-m-d') : '-' }}</td>
                    <td>{{ ucfirst($borrowBook->status) }}</td>
                    {{-- <td>
                        @if($borrowBook->status === 'approved')
                            <form action="{{ route('users.return_book', $borrowBook->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success rounded-3">Return Book</button>
                            </form>
                        @endif
                    </td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No borrow records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <style>
       
        .form-control, .form-select {
            border-radius: 10px; 
            box-shadow: none; 
        }

        .btn-primary {
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #006bb3; 
        }

        .table th, .table td {
            border-radius: 8px; 
        }

        .table tbody tr:hover {
            background-color: #f1f9ff; 
        }

        .table-bordered {
            border: 1px solid #ddd;
            border-radius: 8px; 
        }

        .hover-row:hover {
            background-color: #f9f9f9; 
        }

      
        .btn-success {
            background-color: #28a745;
            border-radius: 8px;
        }

        .btn-sm {
            font-size: 0.875rem;
        }

        .text-muted {
            color: #6c757d !important; 
        }

        .mb-4 {
            margin-bottom: 2rem;
        }

        .row.g-3 .col-md-4 {
            padding-right: 15px;
            padding-left: 15px;
        }
    </style>
</x-userlayout>

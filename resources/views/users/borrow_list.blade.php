<x-userlayout>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

   
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Please fix the following issues:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h3 class="my-4">Your Borrow List</h3>

   
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Book Title</th>
                <th scope="col">Quantity</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowBooks as $borrowBook)
                <tr>
                    <td>{{ $borrowBook->book->title }}</td>
                    <td>{{ $borrowBook->quantity }}</td>
                    <td>
                        <!-- Edit Button (you can link to an edit page or use a modal) -->
                        <a href="" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete Button (with confirmation) -->
                        <form action="{{ route('users.remove_from_borrow_list', $borrowBook->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this book from the Borrow List?')">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Register Borrow Button -->
    <form action="{{ route('users.register_borrow') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="borrow_date" class="form-label">Borrow Date</label>
            <input type="date" name="borrow_date" id="borrow_date" class="form-control" min="{{ \Carbon\Carbon::today()->toDateString() }}" required>
        </div>
        <div class="mb-3">
            <label for="return_date" class="form-label">Return Date</label>
            <input type="date" name="return_date" id="return_date" class="form-control" min="{{ \Carbon\Carbon::today()->toDateString() }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Register Borrow</button>
    </form>
</x-userlayout>

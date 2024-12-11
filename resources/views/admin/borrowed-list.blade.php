<x-adminlayout>
    <div class="container mt-4">
        <h3 class="mb-4 text-center">Manage Borrow Book Requests</h3>

        <table class="table table-striped table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Book Title</th>
                    <th scope="col">Member Name</th>
                    <th scope="col">Borrow Date</th>
                    <th scope="col">Return Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowBooks as $borrowBook)
                    <tr>
                        <td>{{ $borrowBook->book->title }}</td>
                        <td>{{ $borrowBook->member->name }}</td>
                        <td>{{ $borrowBook->borrow_date->format('Y-m-d') }}</td>
                        <td>{{ $borrowBook->return_date->format('Y-m-d') }}</td>
                        <td>
                            <span class="badge 
                                @if($borrowBook->status === 'pending') bg-warning text-dark 
                                @elseif($borrowBook->status === 'rejected') bg-danger 
                                @else bg-success 
                                @endif">
                                {{ ucfirst($borrowBook->status) }}
                            </span>
                        </td>
                        <td>
                            @if($borrowBook->status === 'pending')
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.borrow.edit', $borrowBook->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                    <form action="{{ route('admin.borrow.approve', $borrowBook->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-success">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.borrow.reject', $borrowBook->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Reject</button>
                                    </form>
                                </div>
                            @elseif($borrowBook->status === 'rejected')
                                <span class="text-muted">Rejected</span>
                            @elseif($borrowBook->status === 'approved')
                            <!-- Nút trả sách -->
                            <form action="{{ route('admin.borrow.return', $borrowBook->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-primary">Return Book</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-adminlayout>

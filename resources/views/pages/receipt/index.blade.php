@extends('layout.index')
@section('content')
    <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h3 class="text-capitalize">{{ $title }}</h3>
            <a href="{{ route('receipt.create') }}" class="btn btn-primary btn-sm">Create</a>
          </div>
        </div>
        <div class="card-body">
            <div class="table responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receipts as $receipt)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $receipt->name }}</td>
                                <td>{{ optional($receipt->category)->name }}</td>
                                <td>
                                    <a href="{{ route('receipt.edit', $receipt->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{ route('receipt.ingridient.index', ['receipt_id' => $receipt->id]) }}" class="btn btn-warning btn-sm">Ingridient</a>
                                    <form action="{{ route('receipt.destroy', $receipt->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

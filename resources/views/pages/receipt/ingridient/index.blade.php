@extends('layout.index')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-capitalize">{{ $title }}</h3>

                <div class="">
                    <a href="{{ route('receipt.index') }}" class="btn btn-secondary btn-sm">Back</a>
                    <a href="{{ route('receipt.ingridient.create', ['receipt_id' => $receipt_id]) }}" class="btn btn-secondary btn-sm">Create</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Ingridient</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receipts as $receipt)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ optional($receipt->receipt)->name }}</td>
                                <td>{{ optional($receipt->ingridient)->name }}</td>
                                <td>
                                    <a href="{{ route('receipt.ingridient.edit', [$receipt->id, 'receipt_id' => $receipt_id]) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('receipt.ingridient.destroy', $receipt->id) }}" method="POST"
                                        class="d-inline">
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

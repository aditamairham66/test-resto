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
            <form id="formFilter">
                <div class="mb-3">
                    <input type="text" name="q" class="form-control" value="{{ $q ?? null }}">
                </div>

                <div class="mb-3">
                    <label for="">Category</label>
                    <select name="category_id" class="form-control"
                        onchange="document.getElementById('formFilter').submit()">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $category_id ?? null) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="">Ingridient</label>
                    <select name="ingridient_id" class="form-control"
                        onchange="document.getElementById('formFilter').submit()">
                        <option value="">-- Select Ingridient --</option>
                        @foreach ($ingridients as $ingridient)
                            <option value="{{ $ingridient->id }}"
                                {{ old('ingridient_id', $ingridient_id ?? null) == $ingridient->id ? 'selected' : '' }}>
                                {{ $ingridient->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

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
                                    <a href="{{ route('receipt.edit', $receipt->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{ route('receipt.ingridient.index', ['receipt_id' => $receipt->id]) }}"
                                        class="btn btn-warning btn-sm">Ingridient</a>
                                    <form action="{{ route('receipt.destroy', $receipt->id) }}" method="POST"
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

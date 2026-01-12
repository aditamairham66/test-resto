@extends('layout.index')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="text-capitalize">{{ $title }}</h3>
        </div>
        <form class="card-body" method="POST" action="{{ $url }}">
            {{ csrf_field() }}
            {{ method_field($method) }}

            <div class="mb-3">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Category Name"
                    value="{{ old('name', $form->name ?? null) }}">
            </div>

            <div class="mb-3">
                <label for="">Category</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $form->master_category_id ?? null) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
@endsection

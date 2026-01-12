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
                <label for="">Ingridient</label>
                <select name="ingridient_id" class="form-control">
                    <option value="">-- Select Ingridient --</option>
                    @foreach ($ingridients as $ingridient)
                        <option value="{{ $ingridient->id }}"
                            {{ old('ingridient_id', $form->master_ingridient_id ?? null) == $ingridient->id ? 'selected' : '' }}>
                            {{ $ingridient->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('receipt.ingridient.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
@endsection

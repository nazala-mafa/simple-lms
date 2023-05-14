@extends('master::layouts.master')

@section('content')
  {{-- @dd($errors) --}}
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h1>Create New School</h1>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('master.school.store') }}">
          {{ csrf_field() }}
          <div class="mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name') }}" placeholder="School Name">
            @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
              value="{{ old('email') }}" placeholder="School Email">
            @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <textarea type="text" name="address" class="form-control @error('address') is-invalid @enderror"
              placeholder="School Address">{{ old('address') }}</textarea>
            @error('address')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <select name="status" class="form-control @error('role') is-invalid @enderror" value="{{ old('role') }}">
              @foreach ($statuses as $status)
                <option value="{{ $status }}">Status - {{ $status }}</option>
              @endforeach
            </select>
            @error('role')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary w-100">Add School</button>
          </div>
        </form>
      </div>
    </div>

  </div>
@endsection

@extends('master::layouts.master')

@section('content')
  <div class="container">
    <div class="p-3">
      <div class="card">
        <div class="card-header">
          <h2>Add New School Status</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('master.school.status.store') }}" method="post">
            @csrf
            <div class="mb-3">
              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                placeholder="Status Name">
              @error('name')
                <p class="invalid-feedback">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-3">
              <button class="btn btn-primary w-100" type="submit">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

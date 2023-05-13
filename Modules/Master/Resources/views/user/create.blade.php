@extends('master::layouts.master')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h1>Users List</h1>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('master.user.store') }}">
          {{ csrf_field() }}
          <div class="mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name') }}" placeholder="Username">
            @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
              value="{{ old('email') }}" placeholder="Email">
            @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
              value="{{ old('password') }}" placeholder="Password">
            @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <input type="password" name="password-confirm"
              class="form-control @error('password-confirm') is-invalid @enderror" value="{{ old('password-confirm') }}"
              placeholder="Password Confirmation">
            @error('password-confirm')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <select name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role') }}">
              @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
              @endforeach
            </select>
            @error('role')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary w-100">Add User</button>
          </div>
        </form>
      </div>
    </div>

  </div>
@endsection

@extends('lms::layouts.master')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h1>Create New Course</h1>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('lms.course.store') }}">
          {{ csrf_field() }}
          <div class="mb-3">
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
              value="{{ old('title') }}" placeholder="Title">
            @error('title')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description">{{ old('description') }}</textarea>
            @error('description')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <select name="is_published" class="form-control">
              <option value="0">Draft</option>
              <option value="1">Publish</option>
            </select>
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-primary w-100">Add Course</button>
          </div>
        </form>
      </div>
    </div>

  </div>
@endsection

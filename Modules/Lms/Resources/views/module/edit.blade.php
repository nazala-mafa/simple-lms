@extends('lms::layouts.master')
@include('layouts.utils.ckeditor')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h2 class="mb-0">Edit Module {{ $module->title }}</h2>
        <a href="{{ route('lms.module.index') }}" class="btn btn-primary">Back</a>
      </div>
      <div class="card-body">
        <form action="{{ route('lms.module.update', $module->id) }}" method="post">
          @csrf
          @method('PATCH')
          <div class="mb-3">
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
              value="{{ old('title', $module->title) }}" placeholder="Input Title">
            @error('title')
              <p class="invalid-feedback">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-3">
            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
              placeholder="Input Description">{{ old('description', $module->description) }}</textarea>
            @error('description')
              <p class="invalid-feedback">
                {{ $message }}
              </p>
            @enderror
          </div>
          <div class="mb-3">
            <textarea name="body" class="ckeditor form-control @error('body') is-invalid @enderror" placeholder="Input Body">{{ old('body', $module->body) }}</textarea>
            @error('body')
              <p class="invalid-feedback">
                {{ $message }}
              </p>
            @enderror
          </div>
          <div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@extends('lms::layouts.master')
@include('layouts.utils.ckeditor')

@section('content')
  <div class="container">
    <div class="row">

      <div class="col">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Add New Question</h2>
            <a href="{{ route('lms.question.index') }}" class="btn btn-primary">Back</a>
          </div>
          <div class="card-body">
            <form action="{{ route('lms.question.store') }}" method="post">
              @csrf

              <div class="mb-3">
                <textarea name="question" class="ckeditor form-control @error('question') is-invalid @enderror" placeholder="Question">{{ old('question') }}</textarea>
                @error('question')
                  <p class="invalid-feedback">
                    {{ $message }}
                  </p>
                @enderror
              </div>

              <div class="mb-3">
                <button class="btn btn-primary w-100">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection

@extends('lms::layouts.master')

@section('content')
  <div class="container">
    <div class="row">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h2>Edit Question "{{ $question->question }}"</h2>
          <a href="{{ route('lms.question.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">
          <form action="{{ route('lms.question.update', $question->id) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="mb-3">
              <input type="text" name="question" class="form-control @error('question') is-invalid @enderror"
                placeholder="Question" value="{{ old('question', $question->question) }}">
              @error('question')
                <p class="invalid-feedback">
                  {{ $message }}
                </p>
              @enderror
            </div>
            <div class="mb-3">
              <button class="btn btn-primary w-100">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@extends('lms::layouts.master')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card mb-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Add Answers</h5>
            <a href="{{ route('lms.question.edit', request()->question_id) }}" class="btn btn-primary">Back</a>
          </div>
          <div class="card-body">
            <form action="{{ route('lms.answer.store') }}" method="post">
              @csrf
              <input type="hidden" name="question_id" value="{{ request()->question_id }}">
              <div class="mb-3">
                <input type="text" name="answer" class="form-control @error('answer') is-invalid @enderror"
                  placeholder="Answer" value="{{ old('answer') }}">
                @error('answer')
                  <p class="invalid-feedback">
                    {{ $message }}
                  </p>
                @enderror
              </div>
              <div class="mb-3">
                <select name="is_true" class="form-control">
                  <option value="0">False Answer</option>
                  <option value="1">True Answer</option>
                </select>
              </div>
              <div>
                <button class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

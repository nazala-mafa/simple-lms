@extends('lms::layouts.master')
@include('layouts.utils.ckeditor')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xl-6 col-md-12 mb-3">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Edit Question</h2>
            <a href="{{ route('lms.question.index') }}" class="btn btn-primary">Back</a>
          </div>
          <div class="card-body">
            <form action="{{ route('lms.question.update', $question->id) }}" method="post">
              @csrf
              @method('PATCH')
              <div class="mb-3">
                <textarea name="question" class="ckeditor form-control @error('question') is-invalid @enderror" placeholder="Question">{!! old('question', $question->question) !!}</textarea>
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

      <div class="col-xl-6 col-md-12 mb-3">
        <div class="card mb-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Answers</h3>
            <a href="{{ route('lms.answer.create', ['question_id' => $question->id]) }}" class="btn btn-primary">New
              Answer</a>
          </div>
          <div class="card-body">
            <ul class="list-group">
              @foreach ($question->answers as $answer)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  {{ $answer->answer }}
                  <div class="d-flex justify-content-end align-items-center gap-2">
                    @if ($answer->is_true == '1')
                      <span class="badge btn btn-primary btn-sm rounded-pill p-1 px-2">true answer</span>
                    @endif
                    <a href="{{ route('lms.answer.edit', $answer->id) }}"
                      class="badge btn btn-info btn-sm p-1 px-2 rounded-pill">edit</a>
                    <button action="{{ route('lms.answer.destroy', $answer->id) }}"
                      class="badge btn btn-danger btn-sm p-1 px-2 rounded-pill btn-del">delete</button>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            @livewire('add-tags', [$question])
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@extends('lms::layouts.master')

@section('content')
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <h2 class="m-2">Do Quiz</h2>
      <form action="{{ route('lms.my.course.submit') }}" method="post">
        @csrf
        <button name="quiz_id" type="submit" value="{{ request()->segment(4) }}" class="btn btn-primary">Submit your
          answers</button>
      </form>
    </div>
    @livewire('do-quiz')
  </div>
@endsection

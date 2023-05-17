@extends('lms::layouts.master')

@section('content')
  <div class="container">
    <h1>Quiz "{{ $quiz->title }}" Questions List</h1>
    <div class="row">
      <div class="col-xl-6">
        <div class="card mb-3">
          <div class="card-body">
            <table class="display" style="width: 100%;" id="quiz-questions">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Question</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>

      <div class="col-xl-6">
        <div class="card mb-3">
          <div class="card-body">
            <table class="display" style="width: 100%;" id="school-questions">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Question</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

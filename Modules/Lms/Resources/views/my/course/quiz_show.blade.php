@extends('lms::layouts.master')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h2>{{ $quiz->title }}</h2>
              <a class="btn btn-primary mb-2" href="{{ route('lms.my.course.show', request()->course_id) }}">Back to
                activity</a>
            </div>
            <div class="row">
              <div class="col-xl-7">
                <p>{{ $quiz->description }}</p>
                <a href="{{ route('lms.my.course.quiz_do', [request()->course_id, request()->activity_id, $quiz->id]) }}"
                  class="btn btn-primary mb-3">Do your quiz</a>
              </div>
              <div class="col-xl-5">
                <div class="card">
                  <div class="card-body">
                    <h5>Your Recent Scores</h5>
                    <ul class="list-group">
                      @foreach ($quiz->scores()->orderBy('created_at', 'desc')->get() as $item)
                        <li class="list-group-item d-flex justify-content-between">
                          <span>{{ $item->score_text }}</span>
                          <span>{{ $item->created_at }}</span>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

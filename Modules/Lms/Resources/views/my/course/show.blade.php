@extends('lms::layouts.master')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body overflow-auto">
            <table id="my-course-activity" class="w-100">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
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

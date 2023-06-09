@extends('lms::layouts.master')

@section('content')
  <div class="container">
    <div class="card mb-3">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h1>Edit "{{ $course->title }}" Course</h1>
        <a href="/lms/course" class="btn btn-primary">Back</a>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('lms.course.update', $course->id) }}">

          @csrf
          @method('PATCH')

          <div class="mb-3">
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
              value="{{ old('title', $course->title) }}" placeholder="Title">
            @error('title')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description">{{ old('description', $course->description) }}</textarea>
            @error('description')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <select name="is_published" class="form-control">
              <option value="0" @if ($course->is_published == '0') selected @endif>Draft</option>
              <option value="1" @if ($course->is_published == '1') selected @endif>Publish</option>
            </select>
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-primary w-100">Edit Course</button>
          </div>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 col-sm-12 mb-3">
        <div class="card">
          <div class="card-header">
            <h2>Course Activities</h2>
          </div>
          <div class="card-body">
            <ul class="list-group">
              @foreach ($courseActivities as $item)
                <li class="list-group-item d-flex justify-content-between gap-2">
                  <span>
                    {{ $item->activities?->title }}
                  </span>

                  <div class="d-flex justify-content-end align-items-center gap-2">
                    <span
                      class="badge btn btn-primary btn-sm rounded-pill p-1 px-2">{{ array_slice(explode('\\', $item->model_type), -1)[0] }}</span>
                    <button action="{{ route('lms.course.activity.destroy', $item->id) }}"
                      class="badge btn btn-danger btn-sm p-1 px-2 rounded-pill btn-del">delete</button>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-sm-12 mb-3">
        <div class="card">
          <div class="card-header">
            <h2>Activities</h2>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active activity-tabs" data-type="quiz" aria-current="page"
                  href="javascript:void(0)">Quizzes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link activity-tabs" data-type="module" aria-current="page"
                  href="javascript:void(0)">Modules</a>
              </li>
              <li class="nav-item">
                <a class="nav-link activity-tabs" data-type="video" aria-current="page"
                  href="javascript:void(0)">Videos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link activity-tabs" data-type="document" aria-current="page"
                  href="javascript:void(0)">Documents</a>
              </li>
            </ul>

            <form action="{{ route('lms.course.activity.store') }}" method="post"
              class="my-3 d-flex align-items-center gap-2">
              @csrf
              <input type="hidden" name="course_id" value="{{ request()->segment(3) }}">
              <input type="hidden" name="model_type" value="{{ Quiz::class }}">
              <select name="model_id" class="w-100 _select2 quizzes"></select>
              <button type="submit" class="btn btn-primary btn-sm">Add</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-sm-12 mb-3">
        <div class="card">
          <div class="card-header">
            <h2>Contributors</h2>
          </div>
          <div class="card-body">
            <ul class="list-group">
              @foreach ($course->contributors as $item)
                <li class="list-group-item">
                  {{ $item->name }}
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-sm-12 mb-3">
        <div class="card">
          <div class="card-header">
            <h2>Partisipants</h2>
          </div>
          <div class="card-body">

            <h5 class="mb-0">Add Partisipants</h5>
            <form class="d-flex gap-2 mb-3 align-items-center" action="{{ route('lms.course.add-partisipant') }}"
              method="post">
              @csrf
              <input type="hidden" name="course_id" value="{{ $course->id }}">
              <select name="user_id" class="select2 form-control">
                @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
              <button type="submit" class="btn btn-primary btn-sm">Add</button>
            </form>

            <ul class="list-group">
              @foreach ($course->partisipants as $item)
                <li class="list-group-item">
                  {{ $item->name }}
                </li>
              @endforeach
            </ul>

          </div>
        </div>
      </div>
    </div>

  </div>
@endsection

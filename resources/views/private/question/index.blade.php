@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Questions List</h1>
    <div class="row">
      <div class="card">
        <div class="card-body">
          <table class="display" style="width: 100%;" id="question">
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

  <!-- Modal -->
  <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" name="question" placeholder="Question">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="modalSubmit"></button>
        </div>
      </div>

    </div>
  </div>


  <!-- Answer Modal -->
  <div class="modal fade" id="answerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <h5 class="modal-title" id="answerModalLabel"></h5>
            <input type="text" class="form-control mb-2" name="answer" placeholder="Answer">
            <select name="is_true" class="form-control mb-2">
              <option value="0">False Answer</option>
              <option value="1">True Answer</option>
            </select>
            <button type="button" class="btn btn-primary px-5" id="answerModalSubmit"></button>
          </div>
          <h5>Answers list</h5>
          <div id="answers"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>
      </div>

    </div>
  </div>
@endsection

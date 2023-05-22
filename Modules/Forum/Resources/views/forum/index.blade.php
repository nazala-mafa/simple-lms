@extends('forum::layouts.master')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xl-8">
        <div class="card shadow mb-2">
          <div class="card-body">
            <h4 class="mb-0">Make New Feed</h4>
            <div class="mb-2">
              <textarea id="caption" rows="4" class="form-control" placeholder="What do you think"></textarea>
            </div>
            <div class="mb-2">
              <input type="file" id="image" class="form-control" accept="image/*">
            </div>
            <div class="d-flex justify-content-end mt-2 gap-3">
              <button id="cancel-btn" class="mb-0 btn">Cancel</button>
              <button id="submit-btn" class="mb-0 btn btn-primary">Submit</button>
            </div>
          </div>
        </div>

        <div id="feeds">
          @if (false)
            <div class="card shadow">
              <div class="card-header">
                <div class="lead fw-bold">{{ $feed->author->name }}</div>
                <div class="text-secondary">{{ $feed->created_at }}</div>
              </div>
              <div class="card-body">
                <div class="lead mb-3">
                  {{ $feed->caption }}
                </div>
                <div class="images my-3">
                  @foreach ($feed->images as $item)
                    <img src="{{ $item->uri }}" width="100%" alt="Gambar">
                  @endforeach
                </div>
                <div class="row">
                  <div class="col text-center">
                    <button class="btn btn-sm">like</button>
                  </div>
                  <div class="col text-center">
                    <button class="btn btn-sm">dislike</button>
                  </div>
                  <div class="col text-center">
                    <button class="btn btn-sm">comment</button>
                  </div>
                  <div class="col text-center">
                    <button class="btn btn-sm">share</button>
                  </div>
                </div>
                <ul class="list-group">
                  @foreach ($feed->comments as $item)
                    <li class="list-group-item">
                      <strong>{{ $item->author->name }}</strong>
                      <div class="text-secondary" style="font-size: .6em">{{ $item->created_at }}</div>
                      <p class="lead mb-0">
                        {{ $item->comment }}
                      </p>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          @endif
        </div>
        <div style="height: 50px"></div>
      </div>
      <div class="col-xl-4">
        <div class="card position-fixed">
          <div class="card-body">
            <h5 class="mb-0">Ads Space Here</h5>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Comment Modal -->
  <div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div id="modal-body"></div>
          <ul class="list-group" id="feed-comments"></ul>
          <div class="my-2">
            <textarea id="comment" rows="3" class="form-control" placeholder="Comment here ..."></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="comment-submit">Add Comment</button>
        </div>
      </div>
    </div>
  </div>
@endsection

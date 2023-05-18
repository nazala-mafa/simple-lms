<div class="row">
  <div class="col-md-8 col-sm-12">
    <div class="card">
      @if ($activeQuestion)
        <div class="card-header">
          Question number #{{ $activeQuestionIndex + 1 }}
        </div>
        <div class="card-body">
          <p class="mb-0 border border-1 rounded-2 p-2 mb-2">{{ $activeQuestion->question }}</p>
          <ul class="list-group mb-2">
            @foreach ($activeQuestion->answers as $item)
              <li class="list-group-item @if ($item->answered($quizId)) bg-info @endif" style="cursor: pointer"
                wire:click="answerQuestion({{ $item->id }})">
                {{ $this->abc[$loop->index] }}.
                {{ $item->answer }}
              </li>
            @endforeach
          </ul>
          <div class="d-flex justify-content-evenly align-items-center">
            <button class="btn btn-primary" wire:click="backQuestion">Back</button>
            <button class="btn btn-primary" wire:click="nextQuestion">Next</button>
          </div>
        </div>
      @endif
    </div>
  </div>
  <div class="col-md-4 col-sm-12">
    <div class="card">
      <div class="card-body">
        <h3>Your Answers</h3>
        <div class="row">
          @foreach ($questions as $item)
            @php
              $answerIndex =
                  array_values(
                      $item->answers
                          ->map(fn($a, $key) => $a->answered($quizId) == true ? $key : 'false')
                          ->filter(fn($a) => $a != 'false')
                          ->toArray(),
                  )[0] ?? '-';
            @endphp

            <div class="col-3">
              <button
                class="btn @if ($answerIndex == '-') btn-secondary @else btn-success @endif w-100 m-1 map-answer"
                wire:click="toQuestionIdx({{ $loop->index }})">{{ $loop->index + 1 }}.
                {{ $answerIndex == '-' ? '' : $abc[$answerIndex] }}
              </button>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

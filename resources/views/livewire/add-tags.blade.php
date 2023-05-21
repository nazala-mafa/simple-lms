<div>
  <h3>Add Tags</h3>
  <div class="mb-2">
    <input type="text" wire:model="name" wire:keydown.enter="saveTag"
      class="form-control @error('name') is-invalid @enderror">
    @error('name')
      <p class="invalid-feedback">{{ $message }}</p>
    @enderror
  </div>

  <div class="div">
    @foreach ($tags as $tag)
      <div class="btn-group" role="group" aria-label="{{ $tag->name }}">
        @php
          $related = $tag
              ->questions()
              ->where('id', $this->question->id)
              ->exists();
        @endphp
        <button wire:click="toggleTag({{ $tag->id }})"
          class="btn btn-{{ $related ? 'success' : 'primary' }} d-flex gap-4 align-items-center">{{ $tag->name }} <i
            class="ni ni-fat-{{ $related ? 'delete' : 'add' }}"></i></button>
        <button wire:click="removeTag({{ $tag->id }})" type="button"
          class="btn btn-danger d-flex align-items-center">
          <i class="ni ni-fat-remove"></i>
        </button>
      </div>
    @endforeach
  </div>
</div>

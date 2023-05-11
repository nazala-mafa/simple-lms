<div class="modal-content">
  <form wire:submit.prevent="saveProduct">
    <div class="modal-header">
      <h5 class="modal-title" id="modalLabel">{{ $modelTitle }}</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <input type="text" class="form-control" wire:model="name">
      @error('name')
        <p class="error">{{ $message }}</p>
      @enderror
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="modalSubmit"></button>
    </div>
  </form>
</div>

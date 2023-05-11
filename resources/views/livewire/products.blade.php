<div>
  <div class="row">
    <div class="col-12 col-md-4 col-xl-3">
      <input type="text" wire:model="search" class="form-control">
    </div>

    <div class="col-12 col-md-4 col-xl-3">
      <select class="form-control">
        <option value="5">5</option>
        <option value="10">10</option>
      </select>
    </div>

  </div>

  <form wire:submit.prevent="addProduct" style="margin: 2em 0">
    <input type="text" wire:model="name" placeholder="product name">
    @error('name')
      <span>{{ $message }}</span>
    @enderror
    <button type="submit">save product</button>
  </form>

  <table class="table">
    <tbody>
      @foreach ($products as $product)
        <tr>
          <td>{{ $product->name }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="d-flex justify-content-center">
    {{ $products->links() }}
  </div>
</div>

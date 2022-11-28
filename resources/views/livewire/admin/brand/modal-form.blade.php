<!-- Create modal -->
<div wire:ignore.self class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add brands</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
      </div>
      <form wire:submit.prevent="saveBrand()">
        <div class="modal-body">
            <div class="mb-3">
                <label>Brand name</label>
                <input wire:model.defer="name" type="text" class="form-control"/>
                @error('name') <span class="text-danger">{{$message}}</span> @enderror
            </div>
            <div class="mb-3">
                <label>Brand slug</label>
                <input wire:model.defer="slug" type="text" class="form-control"/>
                @error('slug') <span class="text-danger">{{$message}}</span> @enderror
            </div>
            <div class="mb-3">
                <label>Status</label>
                <input wire:model.defer="status" type="checkbox"/> Checked=Hidden, un-checked=visible
                @error('status') <span class="text-danger">{{$message}}</span> @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Update modal -->
<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Update brand</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
      </div>
      <div wire:loading class="p-2">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>Loading...
      </div>
      <div wire:loading.remove>
        <form wire:submit.prevent="updateBrand()">
          <div class="modal-body">
              <div class="mb-3">
                  <label>Brand name</label>
                  <input wire:model.defer="name" type="text" class="form-control"/>
                  @error('name') <span class="text-danger">{{$message}}</span> @enderror
              </div>
              <div class="mb-3">
                  <label>Brand slug</label>
                  <input wire:model.defer="slug" type="text" class="form-control"/>
                  @error('slug') <span class="text-danger">{{$message}}</span> @enderror
              </div>
              <div class="mb-3">
                  <label>Status</label>
                  <input wire:model.defer="status" type="checkbox"/> Checked=Hidden, un-checked=visible
                  @error('status') <span class="text-danger">{{$message}}</span> @enderror
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete modal -->
<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete brand</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
      </div>
      <div wire:loading class="p-2">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>Loading...
      </div>
      <div wire:loading.remove>
        <form wire:submit.prevent="deleteBrand()">
          <div class="modal-body">
            <h4>Are you sure you want to delete?</h4>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
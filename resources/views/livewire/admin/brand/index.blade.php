<div>

@include('livewire.admin.brand.modal-form')

<div class="row">
    <div class="col-md-12">
            @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif

        <div class="card">
            <div class="card-header">
                <h4>Brands
                    <a href="#" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#saveModal">Add Brand</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse($brands as $brand)
                        <tr>
                            <td>{{$brand->id}}</td>
                            <td>{{$brand->name}}</td>
                            <td>{{$brand->slug}}</td>
                            <td>{{$brand->status==0? 'visible':'hidden'}}</td>
                            <td>
                                <a href="{{url('admin/category/'.$brand->id.'/edit')}}" wire:click="editBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#updateModal" class="btn btn-success">Edit</a>
                                <a href="#" wire:click="deleteBrandModel({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5">Empty</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{$brands->links()}}
                </div>
            </div>
        </div>
    </div>
</div>


</div>

@push('script')
<script>
    window.addEventListener('close-modal', event => {
        $('#saveModal').modal('hide');
        $('#updateModal').modal('hide');
        $('#deleteModal').modal('hide');
        $('.modal-backdrop').removeClass('show').css('display', 'none');
    })
</script>
@endpush
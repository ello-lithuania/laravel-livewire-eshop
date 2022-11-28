@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
            @if($errors->any())
                <div class="alert alert-danger">
                    {{ implode('', $errors->all(':message')) }}
                </div>
            @endif

        <div class="card">
            <div class="card-header">
                <h4>Color edit
                    <a href="{{url('/admin/colors/create')}}" class="btn btn-primary float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{url('admin/colors/'.$color->id)}}">
                    @method('put')
                    @csrf
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$color->name}}"/>
                                </div>
                                <div class="mb-3">
                                    <label>Slug</label>
                                    <input type="text" name="slug" class="form-control" value="{{$color->slug}}"/>
                                </div>
                                <div class="mb-3">
                                    <label>Status</label>
                                    <input type="checkbox" name="status" {{$color->status?'checked':''}}/> 0=visible, 1=hidden
                                </div>

                                <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
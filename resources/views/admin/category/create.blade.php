@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if($errors->any())
                <div class="alert alert-danger">
                    {{ implode('', $errors->all(':message')) }}
                </div>
            @endif
            <div class="card-header">
                <h4>Create Category
                    <a href="{{url('/admin/category')}}" class="btn btn-primary float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{url('admin/category')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name')}}"/>
                            @error('name') {{$message}} @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug')}}"/>
                            @error('slug') {{$message}} @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Description</label>
                            <textarea type="text" name="description" class="form-control" rows="3">{{ old('description')}}</textarea>
                            @error('description') {{$message}} @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" value="{{ old('image')}}"/>
                            @error('image') {{$message}} @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <input type="checkbox" name="status" value="{{ old('status')}}"/>
                            @error('status') {{$message}} @enderror
                        </div>
                        <hr/>
                        <div class="col-md-12">
                            <h4>Seo tags</h4>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Meta title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title')}}"/>
                            @error('meta_title') {{$message}} @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Meta keywords</label>
                            <input type="text" name="meta_keyword" class="form-control" value="{{ old('meta_keyword')}}"/>
                            @error('meta_keyword') {{$message}} @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Meta description</label>
                            <textarea type="text" name="meta_description" class="form-control" rows="3">{{ old('meta_description')}}</textarea>
                            @error('meta_description') {{$message}} @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
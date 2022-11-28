@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
            @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif

        <div class="card">
            <div class="card-header">
                <h4>Color create
                    <a href="{{url('/admin/colors/create')}}" class="btn btn-primary float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{url('admin/colors/create')}}">
                    @csrf
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <label>Slug</label>
                                    <input type="text" name="slug" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <label>Status</label>
                                    <input type="checkbox" name="status"/> 0=visible, 1=hidden
                                </div>

                                <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
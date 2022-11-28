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
                <h4>Colors
                    <a href="{{url('/admin/colors/create')}}" class="btn btn-primary float-end">Add Color</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($colors as $color)
                        <tr>
                            <td>{{$color->id}}</td>
                            <td>{{$color->name}}</td>
                            <td>{{$color->slug}}</td>
                            <td>{{$color->status==0?'visible':'hidden'}}</td>
                            <td>
                                <a href="{{url('admin/colors/'.$color->id.'/edit')}}" class="btn btn-primary">Edit</a>
                                <a href="{{url('admin/colors/'.$color->id.'/delete')}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @empty
                        No colors
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
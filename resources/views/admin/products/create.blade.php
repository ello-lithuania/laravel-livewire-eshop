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
                <h4>Create Product
                    <a href="{{url('/admin/products')}}" class="btn btn-primary float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <form method="post" action="{{url('admin/products')}}" enctype="multipart/form-data">
                    @csrf
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo-tab-pane" type="button" role="tab" aria-controls="seo-tab-pane" aria-selected="false">Seo tags</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">Images</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab-pane" aria-selected="false">Colors</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="mb-3">
                            <label>Category</label>
                            <select name="category_id" class="form-control"> 
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Product name</label>
                            <input type="text" name="name" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label>Product slug</label>
                            <input type="text" name="slug" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label>Brand</label>
                            <select name="brand" class="form-control"> 
                                @foreach($brands as $brand)
                                    <option value="{{$brand->name}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Small description</label>
                            <textarea name="small_description" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="seo-tab-pane" role="tabpanel" aria-labelledby="seo-tab" tabindex="0">
                        <div class="mb-3">
                            <label>Meta title</label>
                            <input type="text" name="meta_title" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label>Meta description</label>
                            <textarea name="meta_description" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Meta keyword</label>
                            <textarea name="meta_keyword" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Original price</label>
                                    <input type="text" name="original_price" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Selling price</label>
                                    <input type="text" name="selling_price" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Quantity</label>
                                    <input type="number" name="quantity" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Trending</label>
                                    <input type="checkbox" name="trending"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Status</label>
                                    <input type="checkbox" name="status"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                                <div class="mb-3">
                                    <label>Images</label>
                                    <input type="file" name="image[]" class="form-control" multiple/>
                                </div>
                    </div>
                    <div class="tab-pane fade" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab" tabindex="0">
                        <div class="mb-3">
                            <label>Select color</label>
                            <div class="row">

                                @forelse($colors as $color)
                                    <div class="col-md-3">
                                        <div class="p-2 border">
                                        Color: <input type="checkbox" name="colors[{{$color->id}}]" value="{{$color->id}}"/> {{$color->name}}
                                        <br/>
                                        Quantity: <input type="number" name="colorquantity[{{$color->id}}]"/>
                                        </div>
                                    </div>
                                @empty
                                    no colors
                                @endforelse

                                
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
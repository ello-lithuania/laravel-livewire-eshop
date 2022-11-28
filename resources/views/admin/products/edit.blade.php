@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
            @if(session('message'))
                <div class="alert alert-danger">
                    {{session('message')}}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    {{ implode('', $errors->all(':message')) }}
                </div>
            @endif

        <div class="card">
            <div class="card-header">
                <h4>Edit Product
                    <a href="{{url('/admin/products')}}" class="btn btn-primary float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <form method="post" action="{{url('admin/products/'.$product->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
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
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="mb-3">
                            <label>Category</label>
                            <select name="category_id" class="form-control"> 
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($category->id==$product->id) selected @endif >{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Product name</label>
                            <input type="text" name="name" class="form-control" value="{{$product->name}}"/>
                        </div>
                        <div class="mb-3">
                            <label>Product slug</label>
                            <input type="text" name="slug" class="form-control" value="{{$product->slug}}"/>
                        </div>
                        <div class="mb-3">
                            <label>Brand</label>
                            <select name="brand" class="form-control"> 
                                @foreach($brands as $brand)
                                    <option value="{{$brand->name}}" @if($brand->name==$product->name) selected @endif>{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Small description</label>
                            <textarea name="small_description" class="form-control" rows="4">{{$product->small_description}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="4">{{$product->description}}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="seo-tab-pane" role="tabpanel" aria-labelledby="seo-tab" tabindex="0">
                        <div class="mb-3">
                            <label>Meta title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{$product->meta_title}}"/>
                        </div>
                        <div class="mb-3">
                            <label>Meta description</label>
                            <textarea name="meta_description" class="form-control" rows="4">{{$product->meta_description}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Meta keyword</label>
                            <textarea name="meta_keyword" class="form-control" rows="4">{{$product->meta_keyword}}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Original price</label>
                                    <input type="text" name="original_price" class="form-control" value="{{$product->original_price}}"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Selling price</label>
                                    <input type="text" name="selling_price" class="form-control" value="{{$product->selling_price}}"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Quantity</label>
                                    <input type="number" name="quantity" class="form-control" value="{{$product->quantity}}"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Trending</label>
                                    <input type="checkbox" name="trending" @if($product->trending==1) checked @endif />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Status</label>
                                    <input type="checkbox" name="status" @if($product->status==1) checked @endif/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                                <div class="mb-3">
                                    <label>Images</label>
                                    <input type="file" name="image[]" class="form-control" multiple/>
                                </div>
                                <div>
                                    <div class="row">
                                    @forelse($product->productImages as $image)
                                    <div class="col-md-2">
                                        <img src="{{asset($image->image)}}" style="width: 80px; height: 80px" class="me-4 border"/>
                                        <a href="{{url('admin/product-image/'.$image->id.'/delete')}}" class="d-block">Remove</a>
                                    </div>
                                    @empty 
                                    no Images
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
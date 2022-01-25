@extends('admin.master.master',["sidebarLink"=>["main"=>'product',"active"=>'listProduct']])
@section('title')
    Update Product
@endsection
@section('page-content-heading')
    Update Product
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('product-list') }}">Product List</a></li>
    <li class="breadcrumb-item active">Update Product </li>
@endsection
@section('page-content')

   


    <div class="container">
        <div class="row ">
            <div class="card">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="col-6" style="display: inline">
                        @csrf
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}">
                            @if ($errors->has('name'))
                                <span class="alert-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control" id="description"
                                value="{{ $product->description }}">
                            @if ($errors->has('description'))
                                <span class="alert-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control" id="price" value="{{ $product->price }}">
                            @if ($errors->has('price'))
                                <span class="alert-danger">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" name="quantity" class="form-control" id="quantity"
                                value="{{ $product->quantity }}">
                            @if ($errors->has('quantity'))
                                <span class="alert-danger">{{ $errors->first('quantity') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="category">Select Category</label>
                            <select name="category_id" id="categpry" class="form-control">
                                <option value="">Select --</option>
                                @foreach ($cat as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <span class="alert-danger">{{ $errors->first('category_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="category">Select Sub Category</label>
                            <div id="subCatDrop">

                            </div>
                            <div>
                                @foreach ($product->getSubCategories as $item)
                                    <span class="text-secondary">{{ $item->name }}</span>
                                @endforeach
                            </div>
                            @if ($errors->has('sub_category_id'))
                                <span class="alert-danger">{{ $errors->first('sub_category_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="product_images">Images</label>
                            <input type="file" accept="images/*" name="product_images[]" class="form-control"
                                id="gallery-photo-add" multiple>
                            <div class="row p-2">
                                    @foreach ($product->getImages as $item)
                                        <div class="col-3">
                                            <img src="{{asset($item->image_url)}}" alt="" class="img-fluid">
                                        </div>
                                    @endforeach
                            </div>
                        </div>
                        <label for="">Product features</label>
                        <div class="form-group prod_assoc">
                            @foreach ($product->getAssocAttr as $item)
                            <div class="row p-5" id="inputFormRow">
                                <div class="col-5">
                                    <label for="">name</label>
                                    <input type="text" class="form-control" name="assoc_name[]" value="{{$item->attr_name}}">
                                </div>
                                <div class="col-7">
                                    <label for="">description</label>
                                    <textarea name="assoc_dsc[]" id="" cols="30" rows="3" style="resize: none"> {{$item->attr_description}}</textarea>
                                </div>
                                <button type="button" class="btn btn-warning remove_assoc">remove</button>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <button class="btn btn-dark btn-add-assoc-field" type="button">Add features field</button>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success form-control btn-lg p-1">Submit</button>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="gallery"></div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            var prod_assoc = $('.prod_assoc');
            $('.btn-add-assoc-field').click(function() {
                prod_assoc.append(`
                     <div class="row p-5" id="inputFormRow">
                        <div class="col-5">
                            <label for="">name</label>
                                <input type="text" class="form-control" name="assoc_name[]">
                        </div>
                        <div class="col-7">
                            <label for="">description</label>
                            <textarea name="assoc_dsc[]" id="" cols="30" rows="3" style="resize: none"></textarea>
                        </div>
                        <button type="button" class="btn btn-warning remove_assoc">remove</button>
                    </div>
            `);
            })
            $(document).on('click', '.remove_assoc', function() {
                $(this).closest('#inputFormRow').remove();
            });



            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).attr(
                                "class", "img-fluid m-2").attr("width", "100").appendTo(
                                placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#gallery-photo-add').on('change', function() {
                imagesPreview(this, 'div.gallery');

            });

        })
    </script>
@endsection

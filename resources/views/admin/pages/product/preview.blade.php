@extends('admin.master.master',["sidebarLink"=>["main"=>'product',"active"=>'listProduct']])
@section('title')
    Product preview
@endsection
@section('page-content-heading')
    Product preview
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('product-list') }}">Product List</a></li>
    <li class="breadcrumb-item active">Product preview </li>
@endsection
@section('page-content')

    <div class="container">
        <div class="row card">
            <div class="card-body">

                <div class="col-md-12">
                    <div class="row m-1 p-2 bg-light">
                        <div class="col-2 ">Name</div>
                        <div class="col-1">:</div>
                        <div class="col-9">{{ $product->name }}</div>
                    </div>
                    <div class="row m-1 p-2">
                        <div class="col-2 ">Description</div>
                        <div class="col-1">:</div>
                        <div class="col-9">{{ $product->description }}</div>
                    </div>
                    <div class="row m-1 p-2 bg-light">
                        <div class="col-2 ">Price</div>
                        <div class="col-1">:</div>
                        <div class="col-9">{{ $product->price }}</div>
                    </div>
                    <div class="row m-1 p-2">
                        <div class="col-2 ">Quantity</div>
                        <div class="col-1">:</div>
                        <div class="col-9">{{ $product->quantity }}</div>
                    </div>
                    <div class="row m-1 p-2 bg-light">
                        <div class="col-2">Category</div>
                        <div class="col-1">:</div>
                        <div class="col-9">{{ $product->getCategory->name }}</div>
                    </div>
                    <div class="row m-1 p-2">
                        <div class="col-2 ">Sub Categories</div>
                        <div class="col-1">:</div>
                        <div class="col">
                            @foreach ($product->getSubCategories as $item)
                                @php
                                    $q = DB::selectOne('SELECT `name` as `name` FROM sub_categories WHERE id=?', [$item->sub_category_id]);
                                    echo($q->name);
                                @endphp
                            @endforeach

                        </div>
                    </div>
                    <div class="row m-1 p-2 bg-light">
                        <div class="col-2">Features</div>
                        <div class="col-1">:</div>
                        <div class="col-9">
                            @foreach ($product->getAssocAttr as $item)
                                <div class="row bg-white p-1 m-1">
                                    <div class="col-5">{{ $item->attr_name }}</div>
                                    <div class="col-1">:</div>
                                    <div class="col-6">{{ $item->attr_description }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row m-1 p-2">
                        <div class="col-2">Images</div>
                        <div class="col-1">:</div>
                        <div class="col-9">
                            <div class="row m-1 ">
                                @foreach ($product->getImages as $item)
                                    <div class="col-3">
                                        <img src="{{ asset($item->image_url) }}" alt="" class="img-fluid">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4"><a href="{{ route('product-list') }}"
                                class="btn btn-primary form-control">Back</a></div>
                        <div class="col-4"><a href="/admin/product/update/{{ $product->id }}"
                                class="btn btn-warning form-control">Update</a></div>
                        <div class="col-4">
                            <button type="button" class="btn btn-danger form-control" data-toggle="modal"
                                data-target="#modaldefault">Delete</button>
                            <div class="modal fade" id="modaldefault">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete Alert !!</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <p>Are You confirm to delete ?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                            <a href="/admin/product/delete/{{ $product->id }}"
                                                class="btn btn-danger">Confirm Delete</a>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

@endsection

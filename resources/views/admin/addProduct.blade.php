@extends('layouts.admin')

@section('adminBody')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(isset($productDetail))
                    <h1>
                        Edit Product
                    </h1>
                    @else
                    <h1>
                        Add Product
                    </h1>
                    @endif

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">
                            @if(isset($productDetail))
                            Edit Product
                            @else
                            Add Product
                            @endif
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{!! session('flash_message_success') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Product Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if(isset($productDetail))
                    <form method="post" action="{{ route('EditProduct', $productDetail->id)}}" name="add_product" id="add_product" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ProductTitle">Product Title</label>
                                <input type="text" class="form-control" id="ProductTitle" name="ProductTitle" placeholder="Enter title" value="{{ $productDetail->title }}">
                            </div>
                            <div class="form-group">
                                <label for="inputDetail">Product Details</label>
                                <input type="text" class="form-control" id="inputDetail" name="inputDetail" placeholder="Enter details" value="{{ $productDetail->details }}">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Product Description</label>
                                <textarea id="inputDescription" name="inputDescription" class="form-control" rows="4" placeholder="Enter description">{{ $productDetail->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputOldPrice">Old Price</label>
                                <input type="text" id="inputOldPrice" name="inputOldPrice" class="form-control" placeholder="Enter old price" value="{{ $productDetail->oldPrice }}">
                            </div>
                            <div class="form-group">
                                <label for="inputPrice">Price</label>
                                <input type="text" id="inputPrice" name="inputPrice" class="form-control price_input" placeholder="Enter price" value="{{ $productDetail->price }}">
                            </div>
                            <div class="form-group">
                                <label for="MainCategoryName">Main Category</label>
                                <select class="form-control" id="MainCategoryName" name="MainCategoryName">
                                    <?php echo $categories_dropdown; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="SubCategoryName">Sub Category</label>
                                <select class="form-control" id="SubCategoryName" name="SubCategoryName">
                                    <option selected disabled>Select</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Product Images</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="multiImage" name="multiImage[]" multiple="true">
                                        <label class="custom-file-label" for="multiImage">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPrice">In Stock</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="InStock" name="InStock" {{$productDetail->in_stock?'checked="checked"':''}}>
                                    <label class="form-check-label" for="InStock">
                                        Checked if available
                                    </label>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    @else

                    <form method="post" action="{{ route('AddProduct')}}" name="add_product" id="add_product" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ProductTitle">Product Title</label>
                                <input type="text" class="form-control" id="ProductTitle" name="ProductTitle" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="inputDetail">Product Details</label>
                                <input type="text" class="form-control" id="inputDetail" name="inputDetail" placeholder="Enter details">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Product Description</label>
                                <textarea id="inputDescription" name="inputDescription" class="form-control" rows="4" placeholder="Enter description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputOldPrice">Old Price </label>
                                <input type="text" id="inputOldPrice" name="inputOldPrice" class="form-control price_input" placeholder="Enter old price">
                            </div>
                            <div class="form-group">
                                <label for="inputPrice">Price</label>
                                <input type="text" id="inputPrice" name="inputPrice" class="form-control price_input" placeholder="Enter price">
                            </div>
                            <div class="form-group">
                                <label for="MainCategoryName">Main Category</label>
                                <select class="form-control" id="MainCategoryName" name="MainCategoryName">
                                    <?php echo $categories_dropdown; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="SubCategoryName">Sub Category</label>
                                <select class="form-control" id="SubCategoryName" name="SubCategoryName">
                                    <option selected disabled>Select</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Product Images</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="multiImage" name="multiImage[]" multiple="true">
                                        <label class="custom-file-label" for="multiImage">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="InStock" name="InStock">
                                <label class="form-check-label" for="InStock">
                                    Checked if available
                                </label>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    @endif
                </div>
                <!-- /.card -->
            </div>

            @if(isset($productDetail))
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Images</h2>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="product-table table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($images as $img)
                                <tr>
                                    <td>
                                        <img src="{{ asset($img->ImageName) }}" alt="" class="img-fluid">
                                    </td>
                                    <td>
                                        <a href="{{ route('DeleteImage', $img ->id) }}" class="btn btn-sm bg-warning">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            @endif
        </div>

    </section>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
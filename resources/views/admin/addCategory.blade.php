@extends('layouts.admin')

@section('adminBody')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
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
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Product Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if(isset($categoryDetails))
                            <form method="post"
                                action="{{ url('/admin/edit-category/'.$categoryDetails->id) }}"
                                novalidate="novalidate">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="CategoryName">Category Name</label>
                                        <input type="text" class="form-control" id="CategoryName" name="CategoryName"
                                            placeholder="Enter Category" value="{{ $categoryDetails->name }}">

                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        @else

                            <form method="post" action="{{ route('AddCategory') }}"
                                novalidate="novalidate">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="CategoryName">Category Name</label>
                                        <input type="text" class="form-control" id="CategoryName" name="CategoryName"
                                            placeholder="Enter Category">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
                <!-- /.card -->

                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Product SubCategory</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if(isset($categoryDetails))
                            <form method="post"
                                action="{{ url('/admin/edit-category/'.$categoryDetails->id) }}"
                                novalidate="novalidate">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    
                                    <div class="form-group">
                                        <label>Select</label>
                                        <select class="form-control">
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="CategoryName">Category Name</label>
                                        <input type="text" class="form-control" id="CategoryName" name="CategoryName"
                                            placeholder="Enter Category" value="{{ $categoryDetails->name }}">

                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        @else

                            <form method="post" action="{{ route('AddSubCategory') }}"
                                novalidate="novalidate">
                                {{ csrf_field() }}
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="MainCategoryName">Main Category</label>
                                        <select class="form-control" id="MainCategoryName" name="MainCategoryName">
                                            <option value="0">Select main category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="CategoryName">Sub Category Name</label>
                                        <input type="text" class="form-control" id="SubCategoryName" name="SubCategoryName"
                                            placeholder="Enter Sub Category">
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
            </div>
            <div class="col-md-6">
                <div class="card-body table-responsive p-0">
                    <table class="product-table table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $categoriestable;?>
                            {{-- @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category ->name }}</td>

                                    <td style="text-align: right;">
                                        <a href="{{ url('/admin/edit-category/'.$category->id) }}"
                                            class="btn btn-sm bg-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ url('/admin/delete-category/'.$category->id) }}"
                                            class="btn btn-sm bg-warning" id="dltCat">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    @foreach ($category as $subcategory)
                                    <tr>
                                        <td>{{ $subcategory ->sub_categories->name }}</td>
                                    </tr>
                                    @endforeach
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <ul class="m-0 float-right">
                        {{-- {{ $categories->appends(request()->input())->links() }} --}}
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </section>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

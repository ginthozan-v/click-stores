@extends('layouts.app')

@section('content')

<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Product Category</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product Category</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->


<!-- ================ category section start ================= -->
<section class="mb-5 section-margin--small">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <div class="head">Browse Categories</div>
                    <ul class="main-categories">
                        <li class="common-filter">
                            <form action="#">
                                <ul>
                                    @foreach ($categories as $category )
                                    <li class="filter-list dropdown-btn"> 
                                        <label> <a class="text-uppercase" href="{{ route('shop.index', ['category' => $category->id])}}"> {{ $category->name }}</a> </label>
                                        <i class="fa fa-caret-down"></i>
                                        <li class="dropdown-container">
                                            <ul>
                                                @foreach ($subcategories as $subcat )
                                                @if($subcat->category_id == $category->id)
                                                <li class="sub-list">
                                                    <label> <a class="text-lowercase font-weight-bold text-muted" href="{{ route('shop.index', ['subcategory' => $subcat->id])}}" id="apple" name="brand">
                                                        {{ $subcat->name }} 
                                                    </a></label>
                                                </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    </li>
                                    @endforeach
                                </ul>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="flex-wrap filter-bar d-flex align-items-center">
                    <div>
                    <form action="{{ route('search') }}" method="get">

                        <div class="input-group filter-bar-search">
                                {{ csrf_field() }}
                                <input type="text" placeholder="Search" name="search" id="search">
                                <div class="input-group-append">
                                    <button type="submit"><i class="ti-search"></i></button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="container pb-40 shop-product">
                    <div class="section-intro pb-60px">
                        <h2>
                        @if(isset( $searchName))
                        <a class="icon_btn " href="{{ route('shop.index') }}"><i class="fas fa-arrow-left text-black"></i></a>
                        <span class=" section-intro__style">{{$searchName}} </span></h2>
                        @else
                        <span class=" section-intro__style">{{$categoryName}} </span></h2>
                        @endif
                    </div>

                    <div class="row">
                        @forelse ($products as $product)
                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="text-center card card-product card-product1">
                                <div class="card-product__img">
                                    @if($product->images->count())
                                    <img class="card-img"
                                        src="{{ asset($product->images[0]->ImageName) }}"
                                        alt="">
                                    @else
                                    <img class="card-img"
                                        src="/img/products/noimage.png"
                                        alt="">
                                    @endif
                                    <ul class="card-product__imgOverlay">
                                        <li>
                                            <a
                                                href="{{ route('shop.details', $product ->id) }}">
                                                <button><i class="ti-eye"></i></button>
                                            </a>
                                        </li>

                                        <li>
                                            <form action="{{ route('cart.store') }}"
                                                method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="title" value="{{ $product->title }}">
                                                <input type="hidden" name="price" value="{{ $product->price }}">



                                                <button type="submit"><i class="ti-shopping-cart"></i></button>

                                            </form>
                                        </li>

                                    </ul>
                                </div>
                                <div class="card-body">
                                    <!-- <p>Accessories</p> -->
                                    <h4 class="card-product__title text-truncate"><a href="#">{{ $product ->title }}</a></h4>
                                    <del class="text-danger">List Price: {{ $product ->oldPrice() }}</del>
                                    <p class="card-product__price">{{ $product ->presentPrice() }}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="container">
                            <p class="text-center billing-alert text-danger">No items found!.</p>
                        </div>
                        @endforelse
                    </div>
                    <nav class="justify-content-center d-flex">
                        {{-- {{ $products->links() }} --}}
                        {{ $products->appends(request()->input())->links() }}
                    </nav> 
                  
                </section>
                <!-- End Best Seller -->
            </div>
        </div>
    </div>
</section>
<!-- ================ category section end ================= -->


@include('shared.brand')
@endsection

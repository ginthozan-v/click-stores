@extends('layouts.app')

@section('content')
<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="blog">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Shop Single</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shop Single</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->


<!--================Single Product Area =================-->
<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="owl-carousel owl-theme s_Product_carousel">
                    @if(count($images) > 0)
                    @foreach($images as $img)
                    <div class="single-prd-item">
                        <img class="img-fluid" src="{{ asset($img->ImageName) }}" alt="">
                    </div>
                    @endforeach
                    @else
                    <div class="single-prd-item">
                        <img class="img-fluid" src="/img/products/noimage.png" alt="">
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3>{{ $product ->title }}</h3>
                    <h2>{{ $product ->presentPrice() }}</h2>
                    <ul class="list">
                        @foreach ( $product->categories as $cat)
                        <li><a class="active" href="#"><span>Category</span> : {{ $cat->name }}</a></li>
                        @endforeach
                        <li><a href="#"><span>Availibility</span> : In Stock</a></li>
                    </ul>
                    <p>{{ $product ->description }}</p>

                    <form class="add-to-card" action="{{ route('cart.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="product_count">
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="title" value="{{ $product->title }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">

                            {{-- <label for="qty">Quantity:</label> --}}
                            <!-- <button
                            onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
							class="increase items-count" type="button"><i class="ti-angle-left"></i></button> -->

                            {{-- <input type="text" name="qty" id="sst" size="2" maxlength="12" value="1" title="Quantity:"
                                class="input-text qty"> --}}

                            <!-- <button
                            onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                            class="reduced items-count" type="button"><i class="ti-angle-right"></i></button> -->
                            <!-- <a class="button primary-btn" href="#">Add to Cart</a> -->




                        </div>
                        @if($product->in_stock == 0)
                        <button class="button primary-btn mt-5" disabled="disabled">Stock not available</button>
                        @else
                        <button type="submit" class="button primary-btn mt-5">Add to Cart</button>
                        @endif

                    </form>
                    <!-- <div class="card_area d-flex align-items-center">
                        <a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a>
                        <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->

<!-- ================ top product area start ================= -->
<section class="related-product-area pt-60px">
    <div class="container">
        <div class="section-intro pb-60px">
            <p>Popular Item in the market</p>
            <h2>Top <span class="section-intro__style">Product</span></h2>
        </div>
        <div class="row mt-30">
            @foreach($mightAlsoLike as $product)
            <div class="col-sm-6 col-xl-3 col-6 mb-4">
                <div class="single-search-product-wrapper">

                    <div class="single-search-product d-flex">
                        <a href="{{ route('shop.details', $product ->id) }}">
                            @if($product->images->count())
                            <img class="card-img" src="{{ asset($product->images[0]->ImageName) }}" alt="">
                            @else
                            <img class="card-img" src="/img/products/noimage.png" alt="">
                            @endif
                            <div class="desc">
                                <a href="{{ route('shop.details', $product ->id) }}" class="title">{{ $product ->title }}</a>
                                <div class="price">{{ $product ->presentPrice() }}</div>
                            </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ================ top product area end ================= -->

@include('shared.brand')
@endsection
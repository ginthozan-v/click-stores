@extends('layouts.app')

@section('content')

<main class="site-main">

    <!--================ Hero banner start =================-->
    <section class="hero-banner">
        <div class="container">
            <div class="row no-gutters align-items-center pt-60px">
                <div class="col-5 d-none d-sm-block">
                    <div class="hero-banner__img">
                        <img class="img-fluid" src="img/home/hero-banner.jpg" alt="">
                    </div>
                </div>
                <div class="pl-4 col-sm-7 col-lg-6 offset-lg-1 pl-md-5 pl-lg-0">
                    <div class="hero-banner__content">
                        <h1>Foodservice Packaging</h1>
                        <p> Foodservice <i class="fa fa-circle"></i> Retail <i class="fa fa-circle"></i> Processor <i
                                class="fa fa-circle"></i> Jan/San </p>

                        <a class="button button-hero" href="#content1"><i class="fa fa-arrow-down"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Hero banner start =================-->

    <!--================ Hero Carousel start =================-->
    <section class="landing-bg1" id="parallax-1">
        <div style="height: 250px">
        </div>
    </section>
    <!--================ Hero Carousel end =================-->

    <!-- ================ offer section start ================= -->
    <section class="offer" id="parallax-1">
        <div class="container" id="content1">
            <div class="row">
                <div class="col-xl-5">
                    <div class="text-center offer__content">
                        <h3>Strategic Sourcing Partner</h3>
                        <p>Click Store is a leading supplier of all of your foodservice packaging and back of the house
                            supplies.
                            We are an industry expert that provides smart solutions to save you time and money.</p>
                        <a class="mt-3 button button--active mt-xl-4" href="{{url('shop')}}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ offer section end ================= -->

    <!--================ Hero Carousel start =================-->
    <section class="landing-bg2" id="parallax-1">
        <div style="height: 250px">
        </div>
    </section>
    <!--================ Hero Carousel end =================-->


    <!-- ================ offer section start ================= -->
    <section class="offer" id="parallax-1" data-anchor-target="#parallax-1"
        data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="text-center offer__content">
                        <h3>Over 5000 Products</h3>
                        <p>Click Store carries over 5000 products, from over 300 manufacturers located across the globe.
                            We provide choice, and ensure you can find the exact product to suit your needs.</p>
                        <a class="mt-3 button button--active mt-xl-4" href="{{url('shop')}}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ offer section end ================= -->

    <!--================ Hero Carousel start =================-->
    <section class="landing-bg3" id="parallax-1">
        <div style="height: 250px">
        </div>
    </section>
    <!--================ Hero Carousel end =================-->

    <!-- ================ offer section start ================= -->
    <section class="offer" id="parallax-1" data-anchor-target="#parallax-1"
        data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="text-center offer__content">
                        <h3>Areas Of Service</h3>
                        <p>Click Store delivers across Canada and the US. Our own fleet of trucks coupled with our
                            extensive
                            logistics network will get your products where you want them, right on time.</p>
                        <a class="mt-3 button button--active mt-xl-4" href="{{url('shop')}}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ offer section end ================= -->

    @include('shared.brand')
</main>

@endsection
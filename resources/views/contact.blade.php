@extends('layouts.app')

@section('content')

<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="contact">
  <div class="container h-100">
    <div class="blog-banner">
      <div class="text-center">
        <h1>Contact Us</h1>
        <nav aria-label="breadcrumb" class="banner-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>
<!-- ================ end banner area ================= -->

<!-- ================ contact section start ================= -->
<section class="section-margin--small">
  <div class="container">
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

    <div class="d-none d-sm-block mb-5 pb-4">
      <div id="map" style="height: 420px;"></div>
      <script>
        function initMap() {
          var uluru = {
            lat: -25.363,
            lng: 131.044
          };
          var grayStyles = [{
              featureType: "all",
              stylers: [{
                  saturation: -90
                },
                {
                  lightness: 50
                }
              ]
            },
            {
              elementType: 'labels.text.fill',
              stylers: [{
                color: '#A3A3A3'
              }]
            }
          ];
          var map = new google.maps.Map(document.getElementById('map'), {
            center: {
              lat: -31.197,
              lng: 150.744
            },
            zoom: 9,
            styles: grayStyles,
            scrollwheel: false
          });
        }
      </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&callback=initMap"></script>

    </div>


    <div class="row">

      <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
        <div class="media contact-info">
          <span class="contact-info__icon"><i class="fa fa-globe"></i></span>
          <div class="media-body">
            <h3><a href="http://www.clickstores.ca/" target="_blank" style="color:black">www.clickstores.ca</a></h3>
            <p>order through website</p>
          </div>
        </div>
        <div class="media contact-info">
          <span class="contact-info__icon"><i class="ti-headphone"></i></span>
          <div class="media-body">
            <h3><a href="tel:+1647854-5354">+1 (647) 854-5354</a></h3>
            <p>Mon to Fri 9am to 6pm</p>
          </div>
        </div>
        <div class="media contact-info">
          <span class="contact-info__icon"><i class="ti-email"></i></span>
          <div class="media-body">
            <h3><a href="mailto:info@clickstores.ca">info@clickstores.ca</a></h3>
            <p>Send us your query anytime!</p>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-9">

        <form action="{{ route('contact.send') }}" method="post" class="form-contact contact_form" id="contactForm">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-lg-5">
              <div class="form-group">
                <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name">
              </div>
              <div class="form-group">
                <input class="form-control" name="email" id="email" type="email" placeholder="Enter email address">
              </div>
              <div class="form-group">
                <input class="form-control" name="subject" id="subject" type="text" placeholder="Enter Subject">
              </div>
            </div>
            <div class="col-lg-7">
              <div class="form-group">
                <textarea class="form-control different-control w-100" name="message" id="message" cols="30" rows="5" placeholder="Enter Message"></textarea>
              </div>
            </div>
          </div>
          <div class="form-group text-center text-md-right mt-3">
            <button type="submit" class="button button--active button-contactForm">Send Message</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- ================ contact section end ================= -->

@endsection
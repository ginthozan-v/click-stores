@extends('layouts.app')

@section('content')

	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Order Confirmation</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shop Category</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->
  
  <!--================Order Details Area =================-->
  <section class="order_details section-margin--small">
    <div class="container">
      <p class="text-center billing-alert">Thank you. Your order has been received.</p>
      <div class="row mb-5">
        <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
          <div class="confirmation-card">
            <h3 class="billing-title">Order Info</h3>
            <table class="order-rable">
              <tr>
                <td>Order number</td>
                <td>: {{$checkout->id}}</td>
              </tr>
              <tr>
                <td>Date</td>
                <td>: {{$checkout->created_at->format('M d, Y')}}</td>
              </tr>
              <tr>
                <td>Total</td>
                <td>: {{ presentPrice(Cart::total()) }}</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
          <div class="confirmation-card">
            <h3 class="billing-title">Billing Address</h3>
            <table class="order-rable">
              <tr>
                <td>Company Name</td>
                <td>: {{$checkout->companyName}}</td>
              </tr>
              <tr>
                <td>City</td>
                <td>:  {{$checkout->city}}</td>
              </tr>
              <tr>
                <td>Address</td>
                <td>:  {{$checkout->addressLine1}}</td>
              </tr>
              <tr>
                <td>Zipcode</td>
                <td>: {{$checkout->zip}}</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
          <div class="confirmation-card">
            <h3 class="billing-title">Shipping Address</h3>
            <table class="order-rable">
            <tr>
                <td>Company Name</td>
                <td>: {{$checkout->companyName}}</td>
              </tr>
              <tr>
                <td>City</td>
                <td>:  {{$checkout->city}}</td>
              </tr>
              <tr>
                <td>Address</td>
                <td>:  {{$checkout->addressLine1}}</td>
              </tr>
              <tr>
                <td>Zipcode</td>
                <td>: {{$checkout->zip}}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="order_details_table">
        <h2>Order Details</h2>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
              @foreach($checkout->products as $product )
                <td>
                  <p>{{$product->title}}</p>
                </td>
                <td>
                  <h5>{{$product->pivot->qty}}X</h5>
                </td>
                <td>
                  <p>{{presentPrice($product->pivot->price)}}</p>
                </td>
              </tr>
              @endforeach
              <tr>
                <td>
                  <h4>Subtotal</h4>
                </td>
                <td>
                  <h5></h5>
                </td>
                <td>
                  <p>{{ presentPrice(Cart::subtotal()) }}</p>
                </td>
              </tr>
              <tr>
                <td>
                  <h4>Tax</h4>
                </td>
                <td>
                  <h5></h5>
                </td>
                <td>
                  <p>{{ presentPrice(Cart::tax()) }}</p>
                </td>
              </tr>
              <tr>
                <td>
                  <h4>Total</h4>
                </td>
                <td>
                  <h5></h5>
                </td>
                <td>
                  <h4>{{ presentPrice(Cart::total()) }}</h4>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <!--================End Order Details Area =================-->

@endsection
@extends('layouts.app')

@section('content')
<script src="https://js.stripe.com/v3/"></script>

<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Product Checkout</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->


<!--================Checkout Area =================-->
<section class="checkout_area section-margin--small">
    <div class="container">
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



        <div class="billing_details" style="margin-top: 50px">
            <form action="{{ route('checkout.store') }}" method="post" novalidate="novalidate" id="payment-form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-7">
                        <h3>Billing Details</h3>
                        <div class="row contact_form">

                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name">
                                <span class="placeholder" data-placeholder="First name"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name">
                                <span class="placeholder" data-placeholder="Last name"></span>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="company" name="company" placeholder="Company name">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="Phonenumber" name="Phonenumber" placeholder="Phone number">
                                <span class="placeholder" data-placeholder="Phone number"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email Address">
                                <span class="placeholder" data-placeholder="Email Address"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add1" name="add1" placeholder="Address line 01">
                                <span class="placeholder" data-placeholder="Address line 01"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add2" name="add2" placeholder="Address line 02">
                                <span class="placeholder" data-placeholder="Address line 02"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="city" name="city" placeholder="Town/City">
                                <span class="placeholder" data-placeholder="Town/City"></span>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP">
                            </div>
                            <div class="col-md-12 form-group">
                                <h3>Shipping Details</h3>
                                <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes"></textarea>
                            </div>

                            <div id="OnlinePayment" class="col-md-12 form-group mb-0">
                                <h3>Payment Details</h3>
                                <input type="text" class="form-control mb-2" id="name_on_card" name="name_on_card" placeholder="Name on Card">
                                <div class="form-group">
                                    <label for="card-element">Credit or debit card</label>
                                    <div id="card-element"></div>
                                    <div id="card-errors"></div>
                                </div>
                            </div>
                        </div>


                    </div>


                    <div class="col-lg-5">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li><a href="#">
                                        <h4>Product <span>Total</span></h4>
                                    </a>
                                </li>

                                <div class="border-bottom chechout-products-list">
                                    @foreach(Cart::content() as $item )
                                    <li>
                                        <div class="row checkout-products-det">
                                            <div class="col-6 prod-name">
                                                <a href="#">{{ $item->model->title }}
                                                    <input type="hidden" name="qty" id="qty" value="{{ $item->qty }}" />
                                                    <input type="hidden" name="productid" id="productid" value="{{ $item->model->id }}" />
                                                </a>
                                            </div>
                                            <div class="col-3 ">
                                                <a href="" onclick='return false;' style="cursor: default;">
                                                    <span class="">x {{ $item->qty }}</span>
                                                </a>
                                            </div>
                                            <div class="col-3">
                                                <a href="" onclick='return false;' style="cursor: default;">
                                                    <span class="">{{ $item->model->presentPrice() }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach

                                </div>

                            </ul>
                            <ul class="list list_2 mt-2">
                                <li><a href="#">Subtotal <span>{{ presentPrice(Cart::subtotal()) }}</span></a></li>
                                <li><a href="#">Tax(13%) <span>{{ presentPrice(Cart::tax()) }}</span></a></li>
                                <li><a href="#">Total <span>$ {{ presentPrice(Cart::total()) }}</span></a></li>
                                <input type="hidden" name="total" id="total" value="{{ presentPrice(Cart::total()) }}" />

                                <input type="hidden" value="{{ presentPrice(Cart::subtotal()) }}" name="subtotal" id="subtotal" />
                                <input type="hidden" value="{{ presentPrice(Cart::tax())}}" name="tax" id="tax" />
                                <input type="hidden" value="{{ presentPrice(Cart::total()) }}" name="total" id="total" />
                            </ul>
                            <div class="payment_item active">
                                <div class=" mt-4">
                                    <label for="f-option6">Card Payment</label>
                                </div>
                                <p>Please make the payment with your Credit/Debit card to place an order. Thank you!</p>
                            </div>
                            <div class="text-center">
                                <button class="button button-paypal" type="submit" id="place-order">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->

@endsection


@section('extra-js')
<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>

<script>
    (function() {
        // Create a Stripe client
        var stripe = Stripe('pk_test_51IME1mGQl9CODMYbvlmlRV2Z4n10SCvPuo8iPLQxlDk1YI4WNHhl4218nDNTzuGCBBTamESQfX2Jqrvsv4mUpeSN005yjeqclw');
        // Create an instance of Elements
        var elements = stripe.elements();
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        // Create an instance of the card Element
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true
        });
        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            // Disable the submit button to prevent repeated clicks
            document.getElementById('place-order').disabled = true;
            var options = {
                name: document.getElementById('name_on_card').value,
                address_line1: document.getElementById('add1').value,
                address_city: document.getElementById('city').value,
                address_zip: document.getElementById('zip').value
            }
            stripe.createToken(card, options).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                    // Enable the submit button
                    document.getElementById('place-order').disabled = false;
                } else {
                    // Send the token to your server
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        }
    })();
</script>
@endsection
@extends('layouts.admin')

@section('adminBody')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    {{-- <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Note:</h5>
                        This page has been enhanced for printing. Click the print button at the bottom of the invoice to
                        test.
                    </div> --}}


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <div class="image">
                                        <img src="{{ asset('img/logo.png') }}" alt="User Image" style="width: 80px; margin-bottom:10px">
                                      </div>
                                    {{-- <small class="float-right">Date: 2/10/2014</small> --}}
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong>click-store.ca</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    Phone: (804) 123-5432<br>
                                    Email: info@click-store.ca
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                    <strong>{{$checkoutdetail->firstName}} {{$checkoutdetail->lastName}}</strong><br>
                                    <strong>{{$checkoutdetail->companyName}}</strong><br>
                                    {{$checkoutdetail->addressLine1}}<br>
                                    {{$checkoutdetail->addressLine2}}<br>
                                    {{$checkoutdetail->city}}<br>
                                    {{$checkoutdetail->zip}}<br>
                                    Phone: {{$checkoutdetail->phone}}<br>
                                    Email: {{$checkoutdetail->email}}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                {{-- <b>Invoice #007612</b><br> --}}
                                <br>
                                <b>Order ID:</b> {{$checkoutdetail->id}}<br>
                                <b>Date:</b> {{ $checkoutdetail->created_at->toDateString() }}<br>
                                {{-- <b>Account:</b> 968-34567 --}}
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Qty</th>
                                            <th>Product</th>
                                            <th>Product id</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($checkoutdetail->products as $product) 
                                        <tr>
                                            <td><div class="product-img">
                                                <img src="{{$product->image}}" alt="Product Image" class="img-size-50">
                                              </div></td>
                                            <td>{{$product->pivot->qty}}</td>
                                            <td>{{$product->title}}</td>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->presentPrice()}}</td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="lead">Order Notes:</p>
                                {{-- <img src="../../dist/img/credit/visa.png" alt="Visa">
                                <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                                <img src="../../dist/img/credit/american-express.png" alt="American Express">
                                <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> --}}

                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    {{$checkoutdetail->orderNotes}}
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <p class="lead">Date {{ $checkoutdetail->updated_at->toDateString() }}</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>${{ $checkoutdetail->subtotal}}</td>
                                         
                                        </tr>
                                        <tr>
                                            <th>Tax (9.3%)</th>
                                            <td>${{ $checkoutdetail->tax }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td>${{ $checkoutdetail->total }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                {{-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                        class="fas fa-print"></i> Print</a>
                                <button type="button" class="btn btn-success float-right"><i
                                        class="far fa-credit-card"></i> Submit
                                    Payment
                                </button> --}}

                            

                                <a href="{{ route('delivered', $checkoutdetail->id) }}" class="btn btn-primary float-right" style="margin-right: 5px;">
                                Delivered </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection

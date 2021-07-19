@extends('layouts.master')

@section('content')
    <!-- products-breadcrumb -->
    <div class="products-breadcrumb">
        <div class="container">
            <ul>
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="{{ route('home') }}">Home</a><span>|</span></li>
                <li>Checkout</li>
            </ul>
        </div>
    </div>
    <!-- //products-breadcrumb -->
    @include('includes.left-banner')
    <div class="w3l_banner_nav_right">
        <!-- about -->
        <div class="privacy about">
            <h3>Chec<span>kout</span></h3>

            @if(session('cart_status'))
                <div class="alert alert-danger alert-dismissible"
                     role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('cart_status')}}
                </div>
            @endif

            @if($cart)
            <div class="checkout-right">
                    <h4>Your shopping cart contains: {{ $cart->totalQuantity }} @if($cart->totalQuantity == 1) Product @else Products @endif</h4>
                    <table class="timetable_sub">
                        <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Product</th>
                            <th>Quality</th>
                            <th>Product Name</th>

                            <th>Price</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart->items as $product)
                            <tr class="rem1">
                                <td class="invert">{{ $loop->iteration }}</td>
                                <td class="invert-image">
                                    <a href="{{ route('good' , ['product' => $product['item']->product_slug ] ) }}">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($product['item']->product_image) }}" alt=" " class="img-responsive">
                                    </a>
                                </td>
                                <td class="invert">
                                    <div class="quantity">
                                        <div class="quantity-select">
                                            <form action="{{ route('removeOne' , ['product_slug' => $product['item']->product_slug]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="entry value-minus"></button>
                                            </form>
                                            <div class="entry value"><span>{{ $product['itemQuantity'] }}</span></div>
                                            <form action="{{ route('addToCart' , ['product_slug' => $product['item']->product_slug]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="entry value-plus active"></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td class="invert">{{ $product['item']->product_name }}</td>

                                <td class="invert">{{ $currency->symbol }}{{$product['item']->is_offer ?
                                    $product['item']->product_price_with_offer : $product['item']->product_price}}</td>

                                <td class="invert">
                                    <div class="rem">
                                        <form action="{{ route('removeFromCart' , ['product_slug' => $product['item']->product_slug]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="close1"></button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="checkout-left">
                    <div class="col-md-4 checkout-left-basket">
                        <h4>Continue to basket</h4>
                        <ul>
                            @foreach($cart->items as $product)
                                <li>{{ $product['item']->product_name }} <i>-</i> {{ $product['itemQuantity'] }}x <span>{{ $currency->symbol }}{{ $product['price'] }} </span></li>
                            @endforeach
                                <li>Total <i>-</i> <span>{{ $currency->symbol }}{{ $cart->totalPrice }}</span></li>
                        </ul>
                    </div>
                    <div class="col-md-8 address_form_agile">
                        <h4>Add a new Details</h4>
                        <form action="payment.html" method="post" class="creditly-card-form agileinfo_form">
                            <section class="creditly-wrapper wthree, w3_agileits_wrapper">
                                <div class="information-wrapper">
                                    <div class="first-row form-group">
                                        <div class="controls">
                                            <label class="control-label">Full name: </label>
                                            <input class="billing-address-name form-control" type="text" name="name" placeholder="Full name">
                                        </div>
                                        <div class="w3_agileits_card_number_grids">
                                            <div class="w3_agileits_card_number_grid_left">
                                                <div class="controls">
                                                    <label class="control-label">Mobile number:</label>
                                                    <input class="form-control" type="text" placeholder="Mobile number">
                                                </div>
                                            </div>
                                            <div class="w3_agileits_card_number_grid_right">
                                                <div class="controls">
                                                    <label class="control-label">Landmark: </label>
                                                    <input class="form-control" type="text" placeholder="Landmark">
                                                </div>
                                            </div>
                                            <div class="clear"> </div>
                                        </div>
                                        <div class="controls">
                                            <label class="control-label">Town/City: </label>
                                            <input class="form-control" type="text" placeholder="Town/City">
                                        </div>
                                        <div class="controls">
                                            <label class="control-label">Address type: </label>
                                            <select class="form-control option-w3ls">
                                                <option>Office</option>
                                                <option>Home</option>
                                                <option>Commercial</option>

                                            </select>
                                        </div>
                                    </div>
                                    <button class="submit check_out">Delivery to this Address</button>
                                </div>
                            </section>
                        </form>
                        <div class="checkout-right-basket">
                            <a href="payment.html">Make a Payment <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                        </div>
                    </div>

                    <div class="clearfix"> </div>

                </div>
            @else
                <h4>No Items</h4>
            @endif
            </div>
            <!-- //about -->
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- //banner -->

@endsection

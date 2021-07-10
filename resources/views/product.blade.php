@extends('layouts.master')

@section('content')
    <!-- products-breadcrumb -->
    <div class="products-breadcrumb">
        <div class="container">
            <ul>
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="{{ route('home') }}">Home</a><span>|</span>
                </li>
                <li>
                    <a href="{{ route('category' , ['category_name' => $product->category->category_slug]) }}">{{ $product->category->category_name }}</a><span>|</span>
                </li>
                <li>{{ $product->product_name }}</li>
            </ul>
        </div>
    </div>
    <!-- //products-breadcrumb -->
    @include('includes.left-banner')
    <div class="w3l_banner_nav_right">
        <div class="w3l_banner_nav_right_banner3">
            <h3>Best Deals For New Products<span class="blink_me"></span></h3>
        </div>
        <div class="agileinfo_single">
            <h5>{{ $product->product_name }}</h5>

            @if(session()->has('out_of_stock'))
                <div class="alert alert-danger" role="alert">
                    {{ session('out_of_stock') }}
                </div>
            @endif

            @if(session()->has('status'))
                <div class="alert alert-success alert-dismissible"
                     role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('status') }}
                </div>
            @endif

            <div class="col-md-4 agileinfo_single_left">
                <img id="example" src="{{ \Illuminate\Support\Facades\Storage::url($product->product_image) }}"
                     alt="{{ $product->product_name }}" class="img-responsive"/>
            </div>
            <div class="col-md-8 agileinfo_single_right">
                <div class="rating1">
                            <span class="starRating">
                                @for($i = 1; $i <= 5; $i++)
                                    <input id="rating{{ $i }}" type="radio" name="rating" value="{{ $i }}"
                                           @if($i == $product->rating) checked @endif >
                                    <label for="rating{{ $i }}">{{ $i }}</label>
                                @endfor
                            </span>
                </div>
                <div class="w3agile_description">
                    <h4>Description :</h4>
                    <p>{{ $product->product_description }}</p>
                </div>
                <div class="snipcart-item block">
                    <div class="snipcart-thumb agileinfo_single_right_snipcart">
                        @if($product->is_offer)
                            <h4>{{ $product->product_price_with_offer }}$<span>{{ $product->product_price }}$</span>
                            </h4>
                        @else
                            <h4>{{ $product->product_price }}$</h4>
                        @endif
                    </div>
                    <div class="btn-group" role="group">

                        @if($product->isEvaluable())
                            <form action="{{ route('addToCart' , ['product_slug' => $product->product_slug]) }}"
                                  method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-block"><span
                                        class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Add to cart
                                </button>
                            </form>
                        @else

                            <button type="button" class="btn btn-default" disabled="disabled">
                                Out of stock
                            </button>

                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#stock-alert">Get in-stock alert
                            </button>

                            <form action="{{ route('subscription', ['product' => $product]) }}" method="post">
                                @csrf
                                <!-- Modal -->
                                <div class="modal fade" id="stock-alert" tabindex="-1" role="dialog"
                                     aria-labelledby="stock-alert-title" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header"
                                                 style="display: flex; justify-content: space-between; align-items: flex-start;">
                                                <h5 class="modal-title" style="margin-bottom: 0" id="stock-alert-title">Get in-stock alert</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div style="margin-bottom: 15px">
                                                    This item isn't available right now, but we’ll send you an email as soon
                                                as it’s back in stock.
                                                </div>
                                                <div class="form-group">
                                                    <label for="stock-alert-email">Email address</label>
                                                    <input type="email" class="form-control" name="email" id="stock-alert-email" aria-describedby="emailHelp" placeholder="Enter email">
{{--                                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        @endif


                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    </div>
    <!-- //banner -->
    <!-- brands -->
    <div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_popular">
        <div class="container">
            <h3>Popular Brands</h3>
            <div class="w3ls_w3l_banner_nav_right_grid1">
                <h6>food</h6>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/5.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>knorr instant soup (100 gm)</p>
                                            <h4>$3.00 <span>$5.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="knorr instant soup"/>
                                                    <input type="hidden" name="amount" value="3.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/6.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>chings noodles (75 gm)</p>
                                            <h4>$5.00 <span>$8.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="chings noodles"/>
                                                    <input type="hidden" name="amount" value="5.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/7.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>lahsun sev (150 gm)</p>
                                            <h4>$3.00 <span>$5.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="lahsun sev"/>
                                                    <input type="hidden" name="amount" value="3.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/8.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>premium bake rusk (300 gm)</p>
                                            <h4>$5.00 <span>$7.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="premium bake rusk"/>
                                                    <input type="hidden" name="amount" value="5.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="w3ls_w3l_banner_nav_right_grid1">
                <h6>vegetables & fruits</h6>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/9.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>fresh spinach (palak)</p>
                                            <h4>$2.00 <span>$3.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="fresh spinach"/>
                                                    <input type="hidden" name="amount" value="2.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/10.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>fresh mango dasheri (1 kg)</p>
                                            <h4>$5.00 <span>$8.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="fresh mango dasheri"/>
                                                    <input type="hidden" name="amount" value="5.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="tag"><img src="images/tag.png" alt=" " class="img-responsive"/></div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/11.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>fresh apple red (1 kg)</p>
                                            <h4>$6.00 <span>$8.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="fresh apple red"/>
                                                    <input type="hidden" name="amount" value="6.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/12.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>fresh broccoli (500 gm)</p>
                                            <h4>$4.00 <span>$6.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="fresh broccoli"/>
                                                    <input type="hidden" name="amount" value="4.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="w3ls_w3l_banner_nav_right_grid1">
                <h6>beverages</h6>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/13.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>mixed fruit juice (1 ltr)</p>
                                            <h4>$3.00 <span>$4.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="mixed fruit juice"/>
                                                    <input type="hidden" name="amount" value="3.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/14.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>prune juice - sunsweet (1 ltr)</p>
                                            <h4>$4.00 <span>$5.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name"
                                                           value="prune juice - sunsweet"/>
                                                    <input type="hidden" name="amount" value="4.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="tag"><img src="images/tag.png" alt=" " class="img-responsive"/></div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/15.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>coco cola zero can (330 ml)</p>
                                            <h4>$3.00 <span>$5.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="coco cola zero can"/>
                                                    <input type="hidden" name="amount" value="3.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/16.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>sprite bottle (2 ltr)</p>
                                            <h4>$3.00 <span>$4.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="sprite bottle"/>
                                                    <input type="hidden" name="amount" value="3.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- //brands -->
@endsection

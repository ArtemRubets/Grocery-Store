@extends('layouts.master')

@section('content')
    <!-- products-breadcrumb -->
    <div class="products-breadcrumb">
        <div class="container">
            <ul>
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="/">Home</a><span>|</span></li>
                <li>Search</li>
            </ul>
        </div>
    </div>
    <!-- //products-breadcrumb -->
    @include('includes.left-banner')
    <div class="w3l_banner_nav_right search_right_column">

        @if($productsFound->isEmpty())
            <div class="w3ls_w3l_banner_nav_right_grid">
                <h3>Nothing...</h3>
            </div>
        @else

            <div class="w3ls_w3l_banner_nav_right_grid">
                <h3>Search</h3>
                <div class="w3ls_w3l_banner_nav_right_grid1">
                    <h6>found ({{ $productsFound->count() }} items)</h6>

                    @if(session()->has('out_of_stock'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('out_of_stock') }}
                        </div>
                    @endif
                    @foreach($productsFound as $product)
                        <div class="col-md-3 w3ls_w3l_banner_left">
                            <div class="hover14 column">
                                <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                                    @if($product->is_offer)
                                        <div class="agile_top_brand_left_grid_pos">
                                            <img src="{{ asset('images/offer.png') }}" alt=" " class="img-responsive"/>
                                        </div>
                                    @endif
                                    <div class="agile_top_brand_left_grid1" @if($product->product_count == 0) style="background: #C9C9C9" @endif>
                                        <figure>
                                            <div class="snipcart-item block">
                                                <div class="snipcart-thumb">
                                                    <a href="{{ route('good' , ['product' => $product->product_slug]) }}"><img
                                                            src="{{ \Illuminate\Support\Facades\Storage::url($product->product_image) }}"
                                                            alt=" "
                                                            class="img-responsive"/></a>
                                                    <p>{{ $product->product_name }}</p>

                                                    @if($product->is_offer)
                                                        <h4>{{ $product->product_price_with_offer }}{{ $currency->symbol }}
                                                            <span>{{ $product->product_price }}{{ $currency->symbol }}</span>
                                                        </h4>
                                                    @else
                                                        <h4>{{ $product->product_price }}{{ $currency->symbol }}</h4>
                                                    @endif
                                                </div>
                                                <div class="snipcart-details">
                                                    <form
                                                        action="{{ route('addToCart' , ['product_slug' => $product->product_slug]) }}"
                                                        method="POST">
                                                        @csrf

                                                        @if($product->isEvaluable())
                                                            <button type="submit" class="button">Add to cart</button>
                                                        @else
                                                            <button type="reset" class="button btn-block" style="background: #C9C9C9;
                                                             border: 1px solid #000; color: #000">
                                                                Out of stock
                                                            </button>
                                                        @endif

                                                    </form>
                                                </div>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="clearfix"></div>
            </div>
    </div>
    @endif

    </div>
    <div class="clearfix"></div>
    </div>
    <!-- //banner -->
@endsection

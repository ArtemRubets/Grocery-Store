@extends('layouts.master')

@section('content')
    <!-- products-breadcrumb -->
    <div class="products-breadcrumb">
        <div class="container">
            <ul>
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="/">Home</a><span>|</span></li>
                <li>{{ \Illuminate\Support\Str::ucfirst($category->category_name) }}</li>
            </ul>
        </div>
    </div>
    <!-- //products-breadcrumb -->
    @include('includes.left-banner')
    <div class="w3l_banner_nav_right">
        <div class="w3l_banner_nav_right_banner3"
             style="background-image: url( {{ \Illuminate\Support\Facades\Storage::url($category->category_image) }} )">
            <h3>{{ $category->category_name }}<span class="blink_me"></span></h3>
        </div>
        <div class="w3l_banner_nav_right_banner3_btm">

            <div class="col-md-12 w3l_banner_nav_right_banner3_btml text-center">
                <h4>{{ \Illuminate\Support\Str::ucfirst($category->category_name) }}</h4>
                <p>{{ $category->category_description }}</p>
            </div>
            <div class="clearfix"></div>
        </div>
        @if($categoryProductsAll->isEmpty())
            <div class="w3ls_w3l_banner_nav_right_grid">
                <h3>Empty Category</h3>
            </div>
        @else

            <div class="w3ls_w3l_banner_nav_right_grid">
                <h3>Popular Brands</h3>
                <form class="form-inline margin-top" method="GET"
                      action="{{ route('category', ['category_name' => $category->category_slug]) }}">
                    <div class="form-group">
                        @error('price_from')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                        <label for="PriceFrom">Price From</label>
                        <input style="width: 70px" type="text" class="form-control" id="PriceFrom" name="price_from" value="{{ request()->input('price_from') }}">
                    </div>
                    <div class="form-group">
                        @error('price_to')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                        <label for="PriceTo">Price To</label>
                        <input style="width: 70px" type="text" class="form-control" id="PriceTo" name="price_to" value="{{ request()->input('price_to') }}">
                    </div>
                    <div class="checkbox">
                        @error('is_offer')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                        <label>
                            <input type="checkbox" name="is_offer" value="1" @if(request()->has('is_offer')) checked @endif > Is Offer
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('category', ['category_name' => $category->category_slug]) }}" class="btn btn-danger">Reset</a>
                </form>
                <div class="w3ls_w3l_banner_nav_right_grid1">
                    <h6>food ({{ $categoryProductsFiltered->count() }} items)</h6>

                    @if(session()->has('out_of_stock'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('out_of_stock') }}
                        </div>
                    @endif
                    @foreach($categoryProductsFiltered as $product)
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
                                                        <h4>{{ $product->product_price_with_offer }}$<span>{{ $product->product_price }}$</span>
                                                        </h4>
                                                    @else
                                                        <h4>{{ $product->product_price }}$</h4>
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

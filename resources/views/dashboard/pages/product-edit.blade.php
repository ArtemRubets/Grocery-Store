@extends('dashboard.layouts.master')
@section('content')
    <div class="w3l_banner_nav_right">
        <h3 class="dashboard-titles" style="margin: 20px 0">Edit product</h3>

        <form action="{{ route('dashboard.products.update', ['product' => $product->id])}}" method="post"
              class="creditly-card-form agileinfo_form"
              enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-info">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                               aria-expanded="true" aria-controls="collapseOne">
                                The main characteristic's
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                         aria-labelledby="headingOne">
                        <div class="panel-body">

                            <div class="col-md-12 address_form_agile">

                                <table class="timetable_sub">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product name</th>
                                        <th>Product description</th>
                                        <th>Product image</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr class="rem1">
                                        <td class="invert">{{ $product->id }}</td>

                                        <td class="invert">
                                            <div class="controls">
                                                @error('product_name')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input class="billing-address-name form-control" type="text"
                                                       name="product_name"
                                                       placeholder="Product name" value="{{ $product->product_name }}">
                                            </div>
                                        </td>

                                        <td class="invert">
                                            <div class="controls">
                                                @error('product_description')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <textarea class="form-control" name="category_description" rows="5"
                                                          placeholder="Product description">{{ $product->product_description }}</textarea>
                                            </div>
                                        </td>

                                        <td class="invert-image">
                                            <img
                                                src="{{ \Illuminate\Support\Facades\Storage::url($product->product_image) }}"
                                                alt=""
                                                class="img-responsive">
                                            <div class="controls">
                                                @error('product_image')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="file" class="form-control" name="product_image">
                                            </div>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                                <table class="timetable_sub">
                                    <thead>
                                    <tr>
                                        <th>Product category</th>
                                        <th>Is offer</th>
                                        <th>Offer percent</th>
                                        <th>Product count</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr class="rem1">

                                        <td class="invert">
                                            <div class="controls">
                                                @error('category_id')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <select class="form-control option-w3ls" name="category_id">
                                                    @foreach($categories as $item)
                                                        <option value="{{ $item->id }}"
                                                                @if($item->id == $product->category_id) selected @endif>{{ $item->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>

                                        <td class="invert">
                                            <div class="controls">
                                                @error('is_offer')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="checkbox" name="is_offer"
                                                       @if($product->is_offer) checked @endif>
                                            </div>

                                        </td>

                                        <td class="invert">
                                            @error('offer_percent')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <input class="billing-address-name form-control" type="number"
                                                   name="offer_percent"
                                                   placeholder="Offer percent" value="{{ $product->offer_percent }}">
                                        </td>

                                        <td class="invert">
                                            @error('product_count')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <input class="billing-address-name form-control" type="number"
                                                   name="product_count"
                                                   placeholder="Product Count" value="{{ $product->product_count }}">
                                        </td>

                                        <td class="invert">
                                            {{ $product->created_at }}
                                        </td>

                                        <td class="invert">
                                            {{ $product->updated_at }}
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>

                            </div>


                        </div>
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                               aria-expanded="true" aria-controls="collapseTwo">
                                Prices
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel"
                         aria-labelledby="headingTwo">
                        <div class="panel-body">

                            <div class="col-md-12 address_form_agile">

                                <table class="timetable_sub">
                                    <thead>
                                    <tr>
                                        <th>Currency</th>
                                        <th>Product price</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($product->price as $productCurrency)

                                        <tr class="rem1">

                                            <td class="invert">
                                                {{ $productCurrency->currency->symbol }} ({{ $productCurrency->currency->code }})
                                            </td>

                                            <td class="invert">
                                                <div class="controls">
                                                    @error('product_price')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <input class="billing-address-name form-control" type="number"
                                                           name="product_price[{{ $productCurrency->currency->code }}]"
                                                           placeholder="Product price"
                                                           value="{{ $productCurrency->price }}">
                                                    <input type="hidden" name="currency[{{ $productCurrency->currency->code }}]" value="{{ $productCurrency->currency->id }}">
                                                </div>
                                            </td>


                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="submit check_out" style="margin-top: 20px">Update</button>

        </form>


    </div>
    <div class="clearfix"></div>
@endsection

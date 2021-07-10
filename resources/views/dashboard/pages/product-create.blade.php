@extends('dashboard.layouts.master')
@section('content')
    <div class="w3l_banner_nav_right">
        <h3 class="dashboard-titles" style="margin: 20px 0">Add new product</h3>

        <div class="col-md-12 address_form_agile">
            <form action="{{ route('dashboard.products.store') }}" method="post"
                  class="creditly-card-form agileinfo_form"
                  enctype="multipart/form-data">
                @csrf
                <table class="timetable_sub">
                    <thead>
                    <tr>
                        <th>Product name</th>
                        <th>Product description</th>
                        <th>Product image</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr class="rem1">

                        <td class="invert">
                            <div class="controls">
                                @error('product_name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input class="billing-address-name form-control" type="text" name="product_name"
                                       placeholder="Product name" value="{{ old('product_name') }}">
                            </div>
                        </td>

                        <td class="invert">
                            <div class="controls">
                                @error('product_description')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <textarea class="form-control" name="product_description" rows="5"
                                          placeholder="Product description">{{ old('category_description') }}</textarea>
                            </div>
                        </td>

                        <td class="invert-image">
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
                        <th>Product price</th>
                        <th>Product category</th>
                        <th>Is offer</th>
                        <th>Offer percent</th>
                        <th>Product count</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr class="rem1">

                        <td class="invert">
                            <div class="controls">
                                @error('product_price')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input class="billing-address-name form-control" type="number" name="product_price"
                                       placeholder="Product price"
                                       value="{{ old('product_price') }}">
                            </div>
                        </td>

                        <td class="invert">
                            <div class="controls">
                                @error('category_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <select class="form-control option-w3ls" name="category_id">
                                    @foreach($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>
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
                                <input type="checkbox" name="is_offer">
                            </div>

                        </td>

                        <td class="invert">
                            @error('offer_percent')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                            <input class="billing-address-name form-control" type="number" name="offer_percent"
                                   placeholder="Offer percent" value="{{ old('offer_percent') }}">
                        </td>

                        <td class="invert">
                            @error('product_count')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                            <input class="billing-address-name form-control" type="number" name="product_count"
                                   placeholder="Product Count" value="{{ old('product_count') }}">
                        </td>

                    </tr>
                    </tbody>
                </table>
                <button type="submit" class="submit check_out" style="margin-top: 20px">Add</button>
            </form>

        </div>

    </div>
    <div class="clearfix"></div>
@endsection

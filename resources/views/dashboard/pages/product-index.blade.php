@extends('dashboard.layouts.master')
@section('content')
    <div class="w3l_banner_nav_right">
        <h3 class="dashboard-titles" style="margin: 20px 0">Products ({{ $category->category_name }})</h3>

        @if(session('product_status'))
            <div class="alert @if(session('product_error'))alert-danger @else alert-success @endif alert-dismissible"
                 role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                {{ session('product_status') }}
            </div>
        @endif

        @if(count($products) == 0)
            <h4 class="text-center">No Products</h4>
        @else
            <table class="timetable_sub">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Is offer</th>
                    <th>Price</th>
                    <th>Count</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class="rem1">
                        <td class="invert">{{ $loop->iteration }}</td>
                        <td class="invert-image">
                            <a href="{{ route('good' , ['product' => $product->product_slug]) }}" target="_blank">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($product->product_image)}}" alt=""
                                     class="img-responsive">
                            </a>
                        </td>

                        <td class="invert">
                            <a href="{{ route('good' , ['product' => $product->product_slug]) }}" target="_blank">
                                {{ $product->product_name }}
                            </a>
                        </td>

                        <td class="invert">
                            {{ $product->is_offer ? 'Yes' : 'No' }}
                        </td>

                        <td class="invert">
                            ${{ $product->product_price }}
                        </td>

                        <td class="invert">
                            {{ $product->product_count }}
                        </td>

                        <td class="invert">
                            <a href="{{ route('dashboard.products.edit' ,  ['product' => $product->id] ) }}"
                               class="btn btn-info">Edit</a>
                        </td>

                        <td class="invert">
                            <div class="rem">
                                <form action="{{ route('dashboard.products.destroy' , ['product' => $product->id]) }}"
                                      method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="close1" type="submit"></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        @endif

    </div>
    <div class="clearfix"></div>
@endsection

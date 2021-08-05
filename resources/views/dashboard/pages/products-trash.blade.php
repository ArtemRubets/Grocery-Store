@extends('dashboard.layouts.master')
@section('content')
    <div class="w3l_banner_nav_right">
        <h3 class="dashboard-titles" style="margin: 20px 0">Products Trash</h3>

        @if(session('product_status'))
            <div class="alert @if(session('product_error'))alert-danger @else alert-success @endif alert-dismissible"
                 role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                {{ session('product_status') }}
            </div>
        @endif

        @if(count($TrashedProducts) == 0)
            <h4 class="text-center">No Products in trash</h4>
        @else
            <table class="timetable_sub">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Restore</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($TrashedProducts as $product)
                    <tr class="rem1">
                        <td class="invert">{{ $loop->iteration }}</td>
                        <td class="invert-image">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($product->product_image)}}" alt=""
                                 class="img-responsive">
                        </td>

                        <td class="invert">
                            {{ $product->product_name }}
                        </td>

                        <td class="invert">
                            {{ $product->category->category_name }}
                        </td>

                        <td class="invert">
                            <div class="rem">
                                <form action="{{ route('dashboard.trash.products.restore' , ['id' => $product->id]) }}"
                                      method="post">
                                    @csrf
                                    <button class="success" type="submit">Restore</button>
                                </form>
                            </div>
                        </td>

                        <td class="invert">
                            <div class="rem">
                                <form
                                    action="{{ route('dashboard.trash.products.forceDelete' , ['id' => $product->id]) }}"
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

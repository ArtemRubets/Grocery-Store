@extends('dashboard.layouts.master')
@section('content')
    <div class="w3l_banner_nav_right">
        <h3 class="dashboard-titles" style="margin: 20px 0">Product Categories</h3>
        <div class="row">
            <div class="col-md-9">
                <a class="btn btn-success btn-lg btn-block" style="margin-bottom: 20px"
                   href="{{ route('dashboard.products.create') }}">Add new product</a>
            </div>
            <div class="col-md-2 col-md-offset-1">
                <a class="btn btn-success btn-lg btn-block" style="margin-bottom: 20px;"
                   href="{{ route('dashboard.trash.products.index') }}">
                    <i class="fa fa-trash-o" style="margin-right: 10px; font-size: 40px;vertical-align: middle"></i>Trash</a>
            </div>
        </div>

        @if(session('product_status'))
            <div class="alert @if(session('product_error'))alert-danger @else alert-success @endif alert-dismissible"
                 role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                {{ session('product_status') }}
            </div>
        @endif

        <table class="timetable_sub">
            <thead>
            <tr>
                <th>№</th>
                <th>Image</th>
                <th>Category</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr class="rem1">

                    <td class="invert">{{ $loop->iteration }}</td>
                    <td class="invert-image">
                        <a href="{{ route('dashboard.products.index', ['category' => $category->id]) }}">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($category->category_image)}}" alt=""
                                 class="img-responsive">
                        </a>
                    </td>

                    <td class="invert">
                        <a href="{{ route('dashboard.products.index', ['category' => $category->id]) }}">
                            {{ $category->category_name }}
                        </a>
                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>

    </div>
    <div class="clearfix"></div>
@endsection

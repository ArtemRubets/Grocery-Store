@extends('dashboard.layouts.master')
@section('content')
    <div class="w3l_banner_nav_right">
        <h3 class="dashboard-titles" style="margin: 20px 0">Categories</h3>
        <a class="btn btn-success btn-lg btn-block" style="margin-bottom: 20px" href="{{ route('dashboard.categories.create') }}">New category</a>

        @if(session('category_status'))
            <div class="alert @if(session('category_error'))alert-danger @else alert-success @endif alert-dismissible"
                 role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ session('category_status') }}
            </div>
        @endif

        <table class="timetable_sub">
            <thead>
            <tr>
                <th>№</th>
                <th>Image</th>
                <th>Category</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr class="rem1">
                    <td class="invert">{{ $loop->iteration }}</td>
                    <td class="invert-image">
                        <a href="{{ route('category' , ['category_name' => $category->category_slug]) }}" target="_blank">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($category->category_image)}}" alt="" class="img-responsive">
                        </a>
                    </td>

                    <td class="invert">
                        {{ $category->category_name }}
                    </td>

                    <td class="invert">
                        <a href="{{ route('dashboard.categories.edit' ,  ['category' => $category->id] ) }}" class="btn btn-info">Edit</a>
                    </td>

                    <td class="invert">
                        <div class="rem">
                            <form action="{{ route('dashboard.categories.destroy' , ['category' => $category->id]) }}" method="post">
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
    </div>
    <div class="clearfix"></div>
@endsection



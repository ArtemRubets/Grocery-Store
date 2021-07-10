@extends('dashboard.layouts.master')
@section('content')
    <div class="w3l_banner_nav_right">
        <h3 class="dashboard-titles" style="margin: 20px 0">Edit Category</h3>

        @if(session('category_status'))
            <div class="alert @if(session('category_error'))alert-danger @else alert-success @endif alert-dismissible"
                 role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ session('category_status') }}
            </div>
        @endif

        <div class="col-md-12 address_form_agile">
            <form action="{{ route('dashboard.categories.update', ['category' => $category->id])}}" method="post"
                  class="creditly-card-form agileinfo_form"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <table class="timetable_sub">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category name</th>
                        <th>Category description</th>
                        <th>Category image</th>
                        <th>Parent category</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr class="rem1">
                        <td class="invert">{{ $category->id }}</td>

                        <td class="invert">
                            <div class="controls">
                                @error('category_name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input class="billing-address-name form-control" type="text" name="category_name"
                                       placeholder="Category name" value="{{ $category->category_name }}">
                            </div>
                        </td>

                        <td class="invert">
                            <div class="controls">
                                <textarea class="form-control" name="category_description" rows="5"
                                          placeholder="Category description">{{ $category->category_description }}</textarea>
                            </div>
                        </td>

                        <td class="invert-image">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($category->category_image) }}" alt="" class="img-responsive">
                            <div class="controls">
                                <input type="file" class="form-control" name="category_image">
                            </div>
                        </td>

                        <td class="invert">
                            <div class="controls">
                                @error('parent_category')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <select class="form-control option-w3ls" name="parent_category">
                                    <option value="0" @if($category->parent_category == 0) selected @endif>Main category</option>
                                    @foreach($categories as $item)
                                        <option value="{{ $item->id }}"
                                        @if($item->id == $category->parent_category) selected @endif>{{ $item->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>

                        <td class="invert">
                            {{ $category->created_at }}
                        </td>

                        <td class="invert">
                            {{ $category->updated_at }}
                        </td>

                    </tr>
                    </tbody>
                </table>
                <button type="submit" class="submit check_out" style="margin-top: 20px">Update</button>
            </form>

        </div>

    </div>
    <div class="clearfix"></div>
@endsection

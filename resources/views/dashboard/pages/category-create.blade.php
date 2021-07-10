@extends('dashboard.layouts.master')
@section('content')
    <div class="w3l_banner_nav_right">
        <h3 class="dashboard-titles" style="margin: 20px 0">New category</h3>
        <div class="col-md-12 address_form_agile">
            <form action="{{ route('dashboard.categories.store') }}" method="post"
                  class="creditly-card-form agileinfo_form"
                  enctype="multipart/form-data">
                @csrf
                <section class="creditly-wrapper wthree, w3_agileits_wrapper">
                    <div class="information-wrapper">
                        <div class="first-row form-group">
                            <div class="controls">
                                <label class="control-label">Category name</label>
                                @error('category_name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input class="billing-address-name form-control" type="text" name="category_name"
                                       placeholder="Category name" value="{{ old('category_name') }}">
                            </div>
                            <div class="controls">
                                <label class="control-label">Category description</label>
                                <textarea class="form-control" name="category_description" rows="5"
                                          placeholder="Category description">{{ old('category_description') }}</textarea>
                            </div>
                            <div class="controls">
                                <label class="control-label">Select category image</label>
                                @error('category_image')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="form-group">
                                    <div class="input-group input-file">
                                        <input type="file" name="category_image" class="form-control dashboard-control"
                                               placeholder='Choose a file...'/>
                                        <span class="input-group-btn">
        		                            <button class="btn btn-default btn-choose" type="button">Choose</button>
    		                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="controls">
                                <label class="control-label">Parent category</label>
                                @error('parent_category')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <select class="form-control option-w3ls" name="parent_category">
                                    <option value="0">Main category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="submit check_out">Create</button>
                    </div>
                </section>
            </form>
        </div>

    </div>
    <div class="clearfix"></div>
@endsection

<!-- banner -->
<div class="banner">
    <div class="w3l_banner_nav_left">
        <nav class="navbar nav_bottom">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header nav_2">
                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                <ul class="nav navbar-nav nav_1">
                    @foreach($categoriesList as $category)
                        @if(count($category->child) > 0)
                                <li class="dropdown mega-dropdown active">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $category->category_name }}<span class="caret"></span></a>
                                    <div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
                                        <div class="w3ls_vegetables">
                                            <ul>
                                                @foreach($category->child as $child)
                                                    <li><a href="{{ route('category' , ['category_name' => $child->category_slug]) }}">{{ $child->category_name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                        @else
                            <li><a href="{{ route('category' , ['category_name' => $category->category_slug]) }}">{{ $category->category_name }}</a></li>
                        @endif

                    @endforeach

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </div>

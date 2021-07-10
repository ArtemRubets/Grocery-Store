<div class="w3l_banner_nav_left">
    <nav class="navbar nav_bottom">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header nav_2">
            <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse"
                    data-target="#bs-megadropdown-tabs">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
            <ul class="nav navbar-nav nav_1">

                @management
                    <li>
                        <a @currentroute("dashboard.home") href="{{ route('dashboard.home') }}">Home</a>
                    </li>
                    <li>
                        <a @currentroute("dashboard.categories.*") href="{{ route('dashboard.categories.index') }}">Categories</a>
                    </li>
                    <li class="dropdown mega-dropdown active">
                        <a @currentroute("dashboard.product*") href="{{ route('dashboard.product-categories') }}">Products</a>
                    </li>
                    <li class="dropdown mega-dropdown active">
                        <a @currentroute("dashboard.payments.settings") href="{{ route('dashboard.payments.settings') }}">Payments</a>
                    </li>
                    <li>
                        <a href="#">Orders</a>
                    </li>
                @endmanagement
                <li>
                    <a href="#">Profile</a>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</div>

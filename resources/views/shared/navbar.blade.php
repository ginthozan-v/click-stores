<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand logo_h" href="{{url('/')}}"><img src="{{ asset('img/logo.png') }}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                        <li class="nav-item active"><a class="nav-link" href="{{url('/')}}">Home</a></li>

                        <li class="nav-item submenu dropdown">
                            <a href="{{url('shop')}}" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="{{url('shop')}}">Product Category</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{url('delivery-decription')}}">Delivery
                                        Description</a>
                                </li>
                            </ul>
                        </li>
                        <!-- <li class="nav-item"><a class="nav-link" href="index.html">About</a></li> -->
                        <li class="nav-item"><a class="nav-link" href="{{url('contact')}}">Contact</a></li>
                    </ul>

                    <ul class="nav-shop">
                        <!-- <li class="nav-item"><a href="#"><i class="ti-search"></i></a></li>  -->
                        <li class="nav-item"><a href="{{ route('cart.index') }}"><i class="ti-shopping-cart"></i>
                                @if(Cart::instance('default')->count() > 0)
                                <span class="nav-shop__circle"> {{ Cart::instance('default')->count() }} </span>
                                @endif
                            </a> </li>
                    </ul>


                    @if(Auth::check())
                    <form method="post" action="{{route('logout')}}">
                        @csrf
                        <ul class="nav">
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi {{ Auth::user()->name }}! </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"> <button type="submit" class="nav-link" style="border: none"> Logout</button>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </form>

                    @else
                    <ul class="nav">
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user"></i></a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="{{url('/login')}}">Login</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{url('/register')}}">Register</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</header>
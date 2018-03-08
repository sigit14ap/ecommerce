<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fashioneer">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>@yield('title')</title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('css/owl.theme.css')}}" rel="stylesheet">
    <script src="{{asset('plugins/jquery/jquery-2.1.4.min.js')}}"></script>

    <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap-select.js.map')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/js/jquery.datatables.min.js')}}"></script>




        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="{{asset('plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>

        <link href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('plugins/bootstrap/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('plugins/bootstrap/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('plugins/bootstrap/css/bootstrap-select.css.map')}}" rel="stylesheet" type="text/css"/>

        <link href="{{asset('plugins/datatables/css/jquery.datatables.min.css')}}" rel="stylesheet" type="text/css"/> 
        <link href="{{asset('plugins/datatables/css/jquery.datatables_themeroller.css')}}" rel="stylesheet" type="text/css"/> 
        


    <!-- Datatables -->


    <!-- theme stylesheet -->
    <link href="{{asset('css/style.default.css')}}" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">

    <script src="{{asset('js/respond.min.js')}}"></script>
    


    <link rel="shortcut icon" href="favicon.png">


<style type="text/css">
* {
  box-sizing: border-box;
}

.input-number {
  width: 80px;
  padding: 0 12px;
  vertical-align: top;
  text-align: center;
  outline: none;
}

.input-number,
.input-number-decrement,
.input-number-increment {
  border: 1px solid #ccc;
  height: 40px;
  user-select: none;
}

.input-number-decrement,
.input-number-increment {
  display: inline-block;
  width: 30px;
  line-height: 38px;
  background: #f1f1f1;
  color: #444;
  text-align: center;
  font-weight: bold;
  cursor: pointer;
}
.input-number-decrement:active,
.input-number-increment:active {
  background: #ddd;
}

.input-number-decrement {
  border-right: none;
  border-radius: 4px 0 0 4px;
}

.input-number-increment {
  border-left: none;
  border-radius: 0 4px 4px 0;
}

</style>
</head>

<body>

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="{{route('home')}}" data-animate-hover="bounce">
                    <img src="{{asset('img/logo.png')}}" alt="Fashioneer" class="hidden-xs">
                    <img src="{{asset('img/logo-small.png')}}" alt="Fashioneer" class="visible-xs"><span class="sr-only">Fashioneer</span>
                </a>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                    @if(Auth::check())
                    <button class="btn btn-default navbar-toggle dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-user"></i><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{route('profile')}}"><i class="fa fa-user" aria-hidden="true"></i>Informasi Akun</a></li>
                        <li><a href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
                    </ul>
                    @endif
                    @if(Auth::check() && Auth::user()->level == 'users')
                    <a class="btn btn-default navbar-toggle" href="{{route('cart')}}">
                        <i class="fa fa-shopping-cart"></i><span class="badge">{{$count}}</span>
                    </a>
                    @endif
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li><a href="{{route('home')}}">Home</a>
                    </li>
                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Kategori <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-3">
                                          <a href="/Pria/"><h5>Pria</h5></a>
                                        </div>
                                        <div class="col-sm-3">
                                          <a href="/Wanita/"><h5>Wanita</h5></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
                    @if(!Auth::check())
                    <li><a href="{{route('login')}}">Login</a></li>
                    <li><a href="{{route('register')}}">Register</a></li>
                    @elseif(Auth::check() && Auth::user()->level == 'admin')
                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Kelola <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-3">
                                          <a href="{{ url('/manage_product') }}"><h5>Barang</h5></a>
                                        </div>
                                        <div class="col-sm-3">
                                          <a href="{{ url('/new-kategori') }}"><h5>Kategori</h5></a>
                                        </div>
                                        <div class="col-sm-3">
                                          <a href="{{ url('/orders') }}"><h5>Pesanan</h5></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>

            </div>
            <!--/.nav-collapse -->

            <div class="navbar-buttons">
                @if(Auth::check())
                <div class="navbar-collapse collapse right">
                    <button class="btn btn-primary navbar-btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><span class="hidden-sm">Profil</span>&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{route('profile')}}"><i class="fa fa-user" aria-hidden="true"></i>Informasi Akun</a></li>
                        <li><a href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
                    </ul>
                </div>
                @endif
                @if(Auth::check() && Auth::user()->level == 'users')
                <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="{{route('cart')}}" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">Keranjang <span class="badge">{{$count}}</span></span></a>
                </div>
                <!--/.nav-collapse -->
                @endif

                <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="collapse clearfix" id="search">

                <form class="navbar-form" role="search" action="{{ url('search') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" placeholder="Search" required>
                        <span class="input-group-btn">

                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

                        </span>
                    </div>
                    @if ($errors->has('q'))
                    <div class="alert alert-danger">
                        <p style="text-align: left;"><strong>Masukan Kata Kunci</strong></p>
                    </div>
                    @endif
                </form>

            </div>
            <!--/.nav-collapse -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->
      <div id="all">

        <div id="content">
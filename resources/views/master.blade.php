<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - {{ Config::get('cms.name') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <meta name="currency" content="{{ Config::get('cms.currency') }}">
    <!--meta para el boton favoritos-->
    <meta name="auth" content="{{ Auth::check() }}">

    @yield('custom_meta')





    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <link rel="stylesheet" href="{{ url('/static/css/style.css?v=' . time()) }}">

    <link src="https://fonts.googleapis.com/css?family = Roboto:400,700 & display = swap " rel=" stylesheet ">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">


    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

    <script src="https://kit.fontawesome.com/ff2ccf8f7c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"> </script>
    <script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script src="{{ url('/static/js/mdslider.js?v=' . time()) }}"></script>
    <script src="{{ url('/static/js/site.js?v=' . time()) }}"></script>

    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



</head>


<div class="loader" id="loader">
    <div class="box">
        <div class="cart">
            <img src="{{ url('/static/images/Loading_write.png') }}">
        </div>
        <div class="load">
            <!--
            <img src="{{ url('/static/images/Loading_cart.gif') }}" >
            -->
            <div class="spinner-border text-secondary" role="status">
                <span class="visually-hidden"> Cargando...</span>
            </div>
        </div>
    </div>
</div>


<body>
    <nav class="navbar navbar-expand-lg shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img
                    src="{{ url('/static/images/logotipo - copia.png') }}"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigationMain"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse " id="navigationMain">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link lk-home"><i class="fas fa-home"></i><span>
                                Inicio</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/store') }}" class="nav-link lk-store lk-store_category lk-product_single"><i
                                class="fas fa-store-alt"></i>
                            <span> Tienda</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-id-card-alt"></i><span>
                                Sobre
                                nosotros</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link"><i class="far fa-envelope-open"></i>
                            <span> Contactos</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/cart') }}" class="nav-link lk-cart"><i class="fas fa-shopping-cart"></i><span
                                class="carnumber">
                                0</span></a>
                    </li>

                    @if (Auth::guest())
                    <li class="nav-item link-acc">
                        <a href="{{ url('/login') }}" class="nav-link btn"><i class="fas fa-fingerprint"></i>
                            Ingresar</a>
                        <a href="{{ url('/register') }}" class="nav-link btn"><i class="far fa-user-circle"></i> Crear
                            cuenta</a>
                    </li>
                    @else
                    <li class="nav-item link-acc link-user dropdown">
                        <a href="{{ url('/login') }}" class="nav-link btn dropdown-toggle" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (is_null(Auth::user()->avatar)) <img
                                src="{{ url('/static/images/default-avatar.png') }}">
                            @else
                            <img src="{{ url('/uploads_users/' . Auth::id() . '/av_' . Auth::user()->avatar) }}">
                            @endif
                            Hola: {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->role == '1')
                            <li><a class="dropdown-item" href="{{ url('/admin') }}"><i
                                        class="fas fa-chalkboard-teacher"></i> Administración
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @endif

                            <li><a class="dropdown-item" href="{{ url('/account/address') }}"><i
                                        class="fas fa-map-marker-alt"></i> Mis direcciones
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('/account/favorites') }}"><i
                                        class="fas fa-heart"></i> Favoritos
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('/account/edit') }}"><i
                                        class="fas fa-address-card"></i> Editar perfil
                                </a>
                            </li>

                            <li><a class="dropdown-item" href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt"></i>
                                    Cerrar sesión</a></li>
                        </ul>
                    </li>

                    @endif

                </ul>

            </div>
        </div>
    </nav>

    @if (Session::has('message'))
    <div class="container">
        <div class="alert alert-{{ Session::get('typealert') }} mtop16" style="display:block; margin-bottom: 16px;">
            {{ Session::get('message') }}
            @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                <li> {{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <script>
                $('.alert').slideDown();
                    setTimeout(function() {
                        $('.alert').slideUp();
                    }, 10000);
            </script>
        </div>
    </div>
    @endif

    <div class="wrapper">
        <div class="container">
            @yield('content')


        </div>
    </div>


</body>





</html>

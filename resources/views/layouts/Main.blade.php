<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>ESPB</title>


    <!-- Bootstrap Core CSS -->

    <link href="{{asset('bootstrap-3.3.7/dist/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet" type="text/css">

    <!--select2-->
    <link rel="stylesheet" type="text/css" href="{{asset('select2/dist/css/select2.min.css')}}">



    @yield('estilos')


    <!-- Custom Fonts -->
    <!-- <link href="{{secure_asset('css/font-awesome.min.css')}}" rel="stylesheet"  type="text/css">-->


    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!--
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/i18n/pt-BR.js"></script>

-->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />

    <!-- full calendar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <!-- fin full calendar -->

    <style type="text/css">
        .pago {
            background: blue;
        }

        .naoPago {
            background: red;
        }


        .pt-3-half {
            padding-top: 1.4rem;
        }

        .mt-5 {
            margin-top: 5 !important;
        }


        /* CUSTOMIZE THE CAROUSEL
-------------------------------------------------- */

        /* Carousel base class */
        .carousel {
            margin-bottom: 4rem;
        }

        /* Since positioning the image, we need to help out the caption */
        .carousel-caption {
            bottom: 3rem;
            z-index: 10;
        }

        /* Declare heights because of positioning of img element */
        .carousel-item {
            height: 32rem;
        }

        .carousel-item>img {
            position: absolute;
            top: 0;
            left: 0;
            min-width: 100%;
            height: 32rem;
        }

        .text-pequeno {
            font-size: 5 !important;
        }


        /* modal */

        .modal-contenido {
            background-color: aqua;
            width: 300px;
            padding: 10px 20px;
            margin: 20% auto;
            position: relative;
        }

        .modal {
            background-color: rgba(0, 0, 0, .8);
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 0;
            pointer-events: none;
            transition: all 1s;
        }

        #formasPagamento:target {
            opacity: 1;
            pointer-events: auto;
        }

        .ocultar {
            visibility: hidden;
        }

        .pagamentoConMulta {
            color: brown;
        }

        .navbar-custom {
            height: 100px;
            background-color: #98bbc1;
            color: white;


        }

        .nav-custom {
            background-color: #98bbc1;

        }

        .nav-custom a:link,
        .nav-custom a:visited {
            color: #ff6600 !important;

        }

        .nav-custom a:hover {
            background-color: #98bbc1 !important;
            color: white !important;
        }

        .nav-custom a.active {
            background-color: #98bbc1 !important;
            color: white !important;
        }

        img {
            opacity: 1 !important
        }

        .menuArriba {
            font-size: large;
            padding-top: 50px;
            padding-left: 100px;

        }

        .menuArriba a {
            padding-right: 10px;
        }

        .menuArriba a:hover {
            background-color: #98bbc1 !important;
            color: white !important;
        }

        .menuArriba a:link,
        .menuArriba a:visited {
            color: #ff6600 !important;

        }

        .menuArriba a.active {
            background-color: #98bbc1 !important;
            color: white !important;
        }
    </style>



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>


    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-primary navbar-static-top navbar-custom" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a href="#" class="navbar-left"><img width="100px" height="100px" src="{{url('/storage/logo.png') }}" alt=""></a>
                <p class="navbar-brand" href="index.html">Sistema Gestão Integral ESPB</p>
            </div>
            <!-- /.navbar-header -->
            @if(Auth::user()->hasRole('gestorAreaAcademica') || Auth::user()->hasRole('AreaAcademica'))

            <ul class="nav navbar-top-links navbar-left menuArriba">
                <li><a href="#"><i class="fa fa-users"></i>Candidatura</a></li>
                <li><a href="#"><i class="fa fa-user-plus"></i> Matricula</a></li>
                <li><a href="#"><i class="fa fa-users"></i> Inscrição</a></li>
            </ul>

            @endif
            <ul class="nav navbar-top-links navbar-right">


                <!-- Authentication Links -->
                @guest
                <li><a href="{{ route('login') }}">Entrar</a></li>
                <li><a href="{{ route('register') }}">Registrar-se</a></li>
                @else


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                        <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="{{route('perfil')}}">Perfil</a> </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Sair
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @endguest

                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <br><br><br>
            @include('layouts.nav-bar')
        </nav>
        <div id="page-wrapper">
            @if(Session::has('flash_message'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em>
            </div>
            @endif
            @include('flash-message')
            @yield('content')

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


    <!-- jQuery -->


    <script src="{{asset('js/jquery2.js')}}"></script>


    
    <script src="{{asset('select2/dist/js/select2.min.js')}}" type="text/javascript"></script>


    <!--<script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script> -->



    <!-- Bootstrap Core JavaScript -->
    <script src="https://kit.fontawesome.com/58342afc35.js" crossorigin="anonymous"></script>

    <script src="{{asset('bootstrap-3.3.7/dist/js/bootstrap.min.js')}}"></script>


    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.js')}}"></script>
    <script src="{{asset('js/metisMenu.min.js')}}"></script>
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/additional.js')}}"></script>

    <script src="{{asset('js/d3.min.js')}}"></script>
    <script src="{{asset('js/jqueryMask.min.js')}}"></script>



    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

	
	





    @yield('scripts')






</body>

</html>
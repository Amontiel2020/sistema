<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Colegio Maravilha</title>
  

    <!-- Bootstrap Core CSS -->

    <link href="{{secure_asset('css/bootstrap.css')}}" rel="stylesheet"  type="text/css">

    <!-- Custom CSS -->
    <link href="{{secure_asset('css/sb-admin-2.css')}}" rel="stylesheet"  type="text/css">
    <link href="{{secure_asset('css/metisMenu.min.css')}}" rel="stylesheet"  type="text/css">




       <!-- Custom Fonts -->
   <!-- <link href="{{secure_asset('css/font-awesome.min.css')}}" rel="stylesheet"  type="text/css">-->
   
    
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"  type="text/css">


    <style type="text/css">
        .pago
        {
         background: blue;
        }
        .naoPago
        {
            background: red;
        }


        .pt-3-half {
           padding-top:1.4rem;


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
.carousel-item > img {
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
  height: 32rem;
}

 
.elementoSelect{
    color:brown;
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
        <nav class="navbar navbar-primary navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">

                <a class="navbar-brand" href="index.html">Gestão de Propinas</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">


                         <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
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

       
        <div id="page-wrapper">
     
        @yield('content')
  
       </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

 <!-- jQuery -->
 
 <script src="{{secure_asset('js/jquery.js')}}"></script>

 <!--<script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script> -->



    <!-- Bootstrap Core JavaScript -->
<script src="https://kit.fontawesome.com/58342afc35.js" crossorigin="anonymous"></script>
 <script src="{{secure_asset('js/bootstrap.js')}}"></script>
 

 <script src="{{secure_asset('js/main.js')}}"></script>
 <script src="{{secure_asset('js/sb-admin-2.js')}}"></script>
 <script src="{{secure_asset('js/metisMenu.min.js')}}"></script>
 <script src="{{secure_asset('js/jquery.validate.min.js')}}"></script>
 <script src="{{secure_asset('js/additional.js')}}"></script>

 


 @yield('scripts')
 

 


 
</body>

</html>

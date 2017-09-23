<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-fav.png') }}">
    <title>{{ config('app.name') }}</title>
    {!! Html::style('assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css') !!}
    {!! Html::style('assets/lib/material-design-icons/css/material-design-iconic-font.min.css') !!}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    {!! Html::style('assets/css/style.css') !!}

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Scripts -->
      <script>
          window.Laravel = <?php echo json_encode([
              'csrfToken' => csrf_token(),
          ]); ?>
      </script>
  </head>
  <body>
    @yield('body')

    {!! Html::script('assets/lib/jquery/jquery.min.js') !!}
    {!! Html::script('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') !!}
    {!! Html::script('assets/js/main.js') !!}
    {!! Html::script('assets/lib/bootstrap/dist/js/bootstrap.min.js') !!}
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      });

    </script>

    @yield('footer')
  </body>
</html>

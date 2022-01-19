
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="hold-transition login-page bg-dark" style="transform: translateY('-80px')">
<div class="login-box" style="width: 700px">
    <div class="login-logo">
        <a href="#" style="color: #b3b6b9; font-size: 1.8em;"><b style="font-weight:bold;">YBLT</b>CORPORATE v.1</a>
        <hr/>


      </div>
  @yield('container')
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>HR Management | @yield('title')</title>

  @include('frontend.layouts.style')
</head>
<body>
  @include('frontend.layouts.header')

  @yield('content')

</body>
</html>
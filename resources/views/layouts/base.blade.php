<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ACME Store - @yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/css/all.css" />
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <script src="https://use.fontawesome.com/3fdd20bbfc.js"></script>
</head>

<body data-page-id="@yield('data-page-id')">
  @yield('body')
  <script src="/js/all.js"></script>
  <script src="/js/ACME.js"></script>
  @yield('stripe-checkout')
</body>

</html>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Panel - @yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/css/all.css" />
  <script src="https://use.fontawesome.com/3fdd20bbfc.js"></script>
</head>

<body data-page-id="@yield('data-page-id')">
  @include('includes.admin-sidebar')
  <div class="off-canvas-content" data-off-canvas-content>
    <!-- Your page content lives here -->
    <div class="admin-title-bar">
      <div class="title-bar">
        <div class="title-bar-left">
          <button class="menu-icon hide-for-large" type="button" data-open="offCanvas"></button>
          <span class="title-bar-title">{{ getenv('APP_NAME') }}</span>
        </div>
      </div>
    </div>
    @yield('content')
  </div>

  <script src="/js/all.js"></script>
  <script src="/js/ACME.js"></script>
</body>

</html>
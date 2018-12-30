@extends('layouts.base')
@section('body') 
{{-- Navigation --}}

{{-- site wrapper --}}
    <div class="site_wrapper">
        @yield('content')
    </div>
    @yield('footer')
@endsection
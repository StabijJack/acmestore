@extends('admin.layout.base')
@section('title', 'Dashboard')
@section('content')
<div class="dashboard">
    <div class="row expanded">
        <h2>Dashboard</h2>

        {{ $beforeToken }}
        <br />
        {{ $afterToken }}
        <br />
        {{ $admin }}
        <br />
        {{ $_SERVER['REQUEST_URI'] }}


    </div>
</div>
@endsection 
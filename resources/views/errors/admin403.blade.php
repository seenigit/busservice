@extends('layouts.master')

@section('title') Unauthorized @stop
<style>

    .container {
        color:#000;
        margin-top: 100px;
        text-align: center;
        vertical-align: middle;
    }

    .content {
        text-align: center;
        display: inline-block;
        vertical-align: middle;
    }

    .title {
        font-size: 72px;
        margin-bottom: 40px;
    }
</style>

@section('content')
<div class="container">
    <div class="content">
        <div class="title">Unauthorized action.</div>
    </div>
</div>

@endsection

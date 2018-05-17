@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="container">
    <h1>Add User</h1>
  	<hr>
	<div class="row">      
      
      <div class="col-md-9 personal-info">
        <h3>Add User</h3>
        @if(Session::has('message'))
            <div class="alert alert-info">
                {{Session::get('message')}}
            </div>
        @endif
        <form class="form-horizontal" role="form" method="post" action="{{ url("/admin/adduser") }}">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="col-lg-3 control-label">Name:</label>
            <div class="col-lg-8">
                <input class="form-control" value="" type="text" name="name" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
                <input class="form-control" value="" type="text" name="email" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Address:</label>
            <div class="col-lg-8">
                <input class="form-control" value="" type="text" name="address" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">city:</label>
            <div class="col-lg-8">
                <input class="form-control" value="" type="text" name="city" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Password:</label>
            <div class="col-lg-8">
                <input class="form-control" value="" type="password" name="password" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
                <input class="btn btn-primary" value="Add User" type="submit">
              <span></span>
            </div>
          </div>
        </form>
      </div>
  </div>
 </div></div></div></div></div>
<hr>
@endsection


@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <h2>You are not authorized to access this resource</h2>

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
              &nbsp;
          </ul>
      </div>
  </div>
</nav>

<nav class="navbar navbar-static-top">
    <div class="container">
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <a class="btn btn-primary" href="{{ URL::previous() }}">
                    <span class="glyphicon glyphicon-hand-left"></span> Back
                </a>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                &nbsp;
            </ul>
        </div>
    </div>
</nav>
@endsection

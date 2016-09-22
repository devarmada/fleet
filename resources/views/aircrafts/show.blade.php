@extends('layouts.app')

@section('content')
  <script>
    function ConfirmDelete()  {
    var x = confirm("Are you sure you want to delete this list?");
    if (x)
      return true;
    else
      return false;
  }
  </script>

  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
          <h2>{{ $aircraft->model }}</h2>
          <h3>{{ $aircraft->year }}</h3>
          <h3>{{ $aircraft->description }}</h3>
        </ul>

              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-left" style="margin-top: 20px;margin-left: 20px;">
                  {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()' ,'route' => array('fleet_lists.aircrafts.destroy', $fleet_list->id, $aircraft->id))) !!}
                  <a class="btn btn-primary" href="{{ route('fleet_lists.aircrafts.edit', array($fleet_list->id, $aircraft->id)) }}">
                      <span class="glyphicon glyphicon-pencil"></span> Edit
                  </a>
                  {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Delete', array('class' => 'btn btn-danger', 'type' => 'submit')) !!}
                  {!! Form::close() !!}
              </ul>
          </div>
      </div>
  </nav>

<nav class="navbar navbar-static-top">
    <div class="container">
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <a class="btn btn-primary" href="{{ route('fleet_lists.show', $fleet_list) }}">
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

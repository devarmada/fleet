@extends('layouts.app')

@section('content')
  <script>
    function ConfirmDelete()  {
    var x = confirm("Are you sure you want to delete this note?");
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
          <h2>{{ $note->title }}</h2>
          <h3>{{ $note->text }}</h3>
        </ul>

            @if($note->is_accessible_by($current_user))
              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-left" style="margin-top: 20px;margin-left: 20px;">
                  {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()' ,'route' => array('fleet_lists.aircrafts.notes.destroy', $fleet_list->id, $aircraft->id, $note->id))) !!}
                  <a class="btn btn-primary" href="{{ route('fleet_lists.aircrafts.notes.edit', array($fleet_list->id, $aircraft->id, $note->id)) }}">
                      <span class="glyphicon glyphicon-pencil"></span> Edit
                  </a>
                  {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Delete', array('class' => 'btn btn-danger', 'type' => 'submit')) !!}
                  {!! Form::close() !!}
              </ul>
            @endif
          </div>
      </div>
  </nav>

<nav class="navbar navbar-static-top">
    <div class="container">
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <a class="btn btn-primary" href="{{ route('fleet_lists.aircrafts.show', [$fleet_list, $aircraft]) }}">
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

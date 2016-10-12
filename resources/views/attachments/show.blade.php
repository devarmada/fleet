@extends('layouts.app')

@section('content')
  <script>
    function ConfirmDelete()  {
      var x = confirm("Are you sure you want to delete this attachment?");
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
          <a href="{{ route('fleet_lists.aircrafts.attachments.get_attachment', [$fleet_list, $aircraft, $attachment]) }}"
          href="{{ Storage::disk('local')->url($attachment->file_path) }}"
             target="_blank" style="display: block; width: 100%; height: 100%;">
            <h2>{{ $attachment->title }}</h2>
            <h3>{{ $attachment->file_type }}</h3>
          </a>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-left" style="margin-top: 20px;margin-left: 20px;">
            {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()' ,'route' => array('fleet_lists.aircrafts.attachments.destroy', $fleet_list->id, $aircraft->id, $attachment->id))) !!}
            <a class="btn btn-primary" href="{{ route('fleet_lists.aircrafts.attachments.edit', array($fleet_list->id, $aircraft->id, $attachment->id)) }}">
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

@extends('layouts.app')

@section('content')
  <script>
    function ConfirmDelete(what = "aircraft")  {
    var x = confirm("Are you sure you want to delete this " + what +"?");
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

  <div id="note">
    @if ( !$aircraft->notes->count() )
      This aircraft has no notes.
    @else
      <table class="table table-striped">
        <thead>
            <tr style="text-align: center;">
                <th width="50%">Title</th>
                <th width="35%">User</th>
                <th width="15%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $aircraft->notes as $note )
            <tr>
                <td>
                    <a href="{{ route('fleet_lists.aircrafts.notes.show', [$fleet_list->id, $aircraft->id, $note->id]) }}"
                       style="display: block; width: 100%; height: 100%;">
                        {{ $note->title }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('fleet_lists.aircrafts.notes.show', [$fleet_list->id, $aircraft->id, $note->id]) }}"
                       style="display: block; width: 100%; height: 100%;">
                        {{ $note->user->name }}
                    </a>
                </td>
                <td>
                    {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete("note")' ,'route' => array('fleet_lists.aircrafts.notes.destroy', $fleet_list->id, $aircraft->id, $note->id))) !!}
                    <a class="btn btn-primary" href="{{ route('fleet_lists.aircrafts.notes.edit', array($fleet_list->id, $aircraft->id, $note->id)) }}">
                        <span class="glyphicon glyphicon-pencil"></span> Edit
                    </a>
                    {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Delete', array('class' => 'btn btn-danger', 'type' => 'submit')) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    @endif
  </div>

  <div id=attachments">
    @if ( !$aircraft->attachments->count() )
      This aircraft has no attachments.
    @else
      <table class="table table-striped">
        <thead>
            <tr style="text-align: center;">
                <th width="50%">Title</th>
                <th width="20%">Type</th>
                <th width="15%">User</th>
                <th width="15%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $aircraft->attachments as $attachment )
            <tr>
                <td>
                    <a href="{{ route('fleet_lists.aircrafts.attachments.show', [$fleet_list->id, $aircraft->id, $attachment->id]) }}"
                       style="display: block; width: 100%; height: 100%;">
                        {{ $attachment->title }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('fleet_lists.aircrafts.attachments.show', [$fleet_list->id, $aircraft->id, $attachment->id]) }}"
                       style="display: block; width: 100%; height: 100%;">
                        {{ $attachment->file_type }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('fleet_lists.aircrafts.attachments.show', [$fleet_list->id, $aircraft->id, $attachment->id]) }}"
                       style="display: block; width: 100%; height: 100%;">
                        {{ $attachment->user->name }}
                    </a>
                </td>
                <td>
                    {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete("attachment")' ,'route' => array('fleet_lists.aircrafts.attachments.destroy', $fleet_list->id, $aircraft->id, $attachment->id))) !!}
                    <a class="btn btn-primary" href="{{ route('fleet_lists.aircrafts.attachments.edit', array($fleet_list->id, $aircraft->id, $attachment->id)) }}">
                        <span class="glyphicon glyphicon-pencil"></span> Edit
                    </a>
                    {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Delete', array('class' => 'btn btn-danger', 'type' => 'submit')) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    @endif
  </div>

  <nav class="navbar navbar-static-top">
    <div class="container">
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
              <a class="btn btn-primary" href="{{ route('fleet_lists.aircrafts.notes.create', [$fleet_list->id, $aircraft->id], array('class' => 'btn btn-info')) }}">
                  <span class="glyphicon glyphicon-plus"></span> New note
              </a>
              <a class="btn btn-primary" href="{{ route('fleet_lists.aircrafts.attachments.create', [$fleet_list->id, $aircraft->id], array('class' => 'btn btn-info')) }}">
                  <span class="glyphicon glyphicon-plus"></span> New attachment
              </a>
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

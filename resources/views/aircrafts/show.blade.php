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
    <h2>Notes</h2>

    @if ( !$aircraft->notes->count() )
      This aircraft has no notes.
    @else
      @if($aircraft->notes->count() > 4 || $aircraft->notes->count() > 1)
        @include('aircrafts/partials/_navbuttons', array('show_note_button' => true, 'show_attachment_button' => false))
      @endif

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
              <tr class="noborder">
                <td class="noborder sized">
                    <a href="{{ route('fleet_lists.aircrafts.notes.show', [$fleet_list->id, $aircraft->id, $note->id]) }}" class="expanded">
                        {{ $note->title }}
                    </a>
                </td>
                <td class="noborder sized">
                    <a href="{{ route('fleet_lists.aircrafts.notes.show', [$fleet_list->id, $aircraft->id, $note->id]) }}" class="expanded">
                        {{ $note->user->name }}
                    </a>
                </td>
                <td>
                  @if($note->is_accessible_by($user))
                    {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete("note")' ,'route' => array('fleet_lists.aircrafts.notes.destroy', $fleet_list->id, $aircraft->id, $note->id))) !!}
                    <a class="btn btn-primary" href="{{ route('fleet_lists.aircrafts.notes.edit', array($fleet_list->id, $aircraft->id, $note->id)) }}">
                        <span class="glyphicon glyphicon-pencil"></span> Edit
                    </a>
                    {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Delete', array('class' => 'btn btn-danger', 'type' => 'submit')) !!}
                    {!! Form::close() !!}
                  @endif
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    @endif
  </div>

  <div id=attachments">

    <h2>Attachments</h2>

    @if ( !$aircraft->attachments->count() )
      This aircraft has no attachments.
    @else
      @if($aircraft->attachments->count() > 2 || $aircraft->notes->count() > 2)
        @include('aircrafts/partials/_navbuttons', array('show_note_button' => false, 'show_attachment_button' => true))
      @endif

      <table class="table table-striped">
        <thead>
            <tr style="text-align: center;">
                <th width="45%">Title</th>
                <th width="25%">Preview</th>
                <th width="15%">User</th>
                <th width="15%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $aircraft->attachments as $attachment )
              <tr class="noborder">
                <td class="noborder sized">
                    <a href="{{ route('fleet_lists.aircrafts.attachments.show', [$fleet_list->id, $aircraft->id, $attachment->id]) }}" class="expanded">
                        {{ $attachment->title }}
                    </a>
                </td>
                <td class="noborder sized">
                    <a href="{{ route('fleet_lists.aircrafts.attachments.show', [$fleet_list->id, $aircraft->id, $attachment->id]) }}" class="expanded">
                      @if(explode("/", $attachment->file_type)[0] == 'image')
                        <img src="{{ route('fleet_lists.aircrafts.attachments.get_attachment', [$fleet_list, $aircraft, $attachment]) }}" class="img-thumbnail" width="128" height="128" />
                      @else
                        <img src="{{ "/img/" . $attachment->get_icon() }}" class="img-thumbnail" width="128" height="128" />
                      @endif
                    </a>
                </td>
                <td class="noborder sized">
                    <a href="{{ route('fleet_lists.aircrafts.attachments.show', [$fleet_list->id, $aircraft->id, $attachment->id]) }}" class="expanded">
                        {{ $attachment->user->name }}
                    </a>
                </td>
                <td>
                  @if($attachment->is_accessible_by($user))
                    {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete("attachment")' ,'route' => array('fleet_lists.aircrafts.attachments.destroy', $fleet_list->id, $aircraft->id, $attachment->id))) !!}
                    <a class="btn btn-primary" href="{{ route('fleet_lists.aircrafts.attachments.edit', array($fleet_list->id, $aircraft->id, $attachment->id)) }}">
                        <span class="glyphicon glyphicon-pencil"></span> Edit
                    </a>
                    {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Delete', array('class' => 'btn btn-danger', 'type' => 'submit')) !!}
                    {!! Form::close() !!}
                  @endif
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    @endif
  </div>

  @include('aircrafts/partials/_navbuttons', array('show_note_button' => true, 'show_attachment_button' => true))

@endsection

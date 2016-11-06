@extends('layouts.app')

@section('content')
  <script>
  function ConfirmDelete(what = "list")  {
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
                <h2>{{ $fleet_list->name }}</h2>
                <h3>{{ $fleet_list->description }}</h3>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-left" style="margin-top: 20px;margin-left: 20px;">
                {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()' ,'route' => array('fleet_lists.destroy', $fleet_list->id))) !!}
                <a class="btn btn-primary" href="{{ route('fleet_lists.edit', array($fleet_list->id)) }}">
                    <span class="glyphicon glyphicon-pencil"></span> Edit
                </a>
                {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Delete', array('class' => 'btn btn-danger', 'type' => 'submit')) !!}
                {!! Form::close() !!}
            </ul>
        </div>
    </div>
  </nav>

  <h2>Aircrafts</h2>

  @if ( !$fleet_list->aircrafts->count() )
    Your list has no aircrafts.
  @else
    @if($fleet_list->aircrafts->count() > 4)
      @include('fleet_lists/partials/_navbuttons')
    @endif

  <table class="table table-striped">
    <thead>
        <tr style="text-align: center;">
            <th width="20%">Model</th>
            <th width="5%">Year</th>
            <th width="45%">Description</th>
            <th width="15%">User</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $fleet_list->aircrafts as $aircraft )
        <tr class="noborder">
          <td class="noborder sized">
                <a href="{{ route('fleet_lists.aircrafts.show', [$fleet_list->id, $aircraft->id]) }}" class="expanded">
                    {{ $aircraft->model }}
                </a>
            </td>
            <td class="noborder sized">
                <a href="{{ route('fleet_lists.aircrafts.show', [$fleet_list->id, $aircraft->id]) }}" class="expanded">
                    {{ $aircraft->year }}
                </a>
            </td>
            <td class="noborder sized">
                <a href="{{ route('fleet_lists.aircrafts.show', [$fleet_list->id, $aircraft->id]) }}" class="expanded">
                    {{ $aircraft->description ? $aircraft->description : "-" }}
                </a>
            </td>
            <td class="noborder sized">
                <a href="{{ route('fleet_lists.aircrafts.show', [$fleet_list->id, $aircraft->id]) }}" class="expanded">
                    {{ $aircraft->user->name }}
                </a>
            </td>
            <td>
                {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete("aircraft")' ,'route' => array('fleet_lists.aircrafts.destroy', $fleet_list->id, $aircraft->id))) !!}
                <a class="btn btn-primary" href="{{ route('fleet_lists.aircrafts.edit', array($fleet_list->id, $aircraft->id)) }}">
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

  @include('fleet_lists/partials/_navbuttons')

@endsection

@extends('layouts.app')

@section('content')
  <script>
  function ConfirmDelete()  {
    var x = confirm("Are you sure you want to delete this group?");
    if (x)
      return true;
    else
      return false;
  }

  function ConfirmDisassociate(user)  {
    var x = confirm("Are you sure you want to remove the user " + user + " from this group?");
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
                <h2>{{ $group->name }}</h2>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-left" style="margin-top: 20px;margin-left: 20px;">
                {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()' ,'route' => array('groups.destroy', $group->id))) !!}
                <a class="btn btn-primary" href="{{ route('groups.edit', array($group->id)) }}">
                    <span class="glyphicon glyphicon-pencil"></span> Edit
                </a>
                {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Delete', array('class' => 'btn btn-danger', 'type' => 'submit')) !!}
                {!! Form::close() !!}
            </ul>
        </div>
    </div>
  </nav>

  <table class="table table-striped">
    <thead>
        <tr style="text-align: center;">
            <th width="85%">User name</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody>
      @foreach( $group->users as $user )
        <tr>
            <td>
                <a href="{{  route('users.show', $user->id) }}"
                   style="display: block; width: 100%; height: 100%;">
                    {{ $user->name }}
                </a>
            </td>
            <td>
                {!! Form::open(array('class' => 'form-inline', 'method' => 'POST', 'onsubmit' => 'return ConfirmDisassociate("' . $user->name . '")', 'route' => array('groups.remove_user', $group->id, $user->id))) !!}
                {!! Form::button('<span class="glyphicon glyphicon-resize-full"></span> Remove from group', array('class' => 'btn btn-danger', 'type' => 'submit')) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>

  <nav class="navbar navbar-static-top">
    <div class="container">
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <a class="btn btn-primary" href="{{ route('groups.add_user', $group->id, array('class' => 'btn btn-info')) }}">
                    <span class="glyphicon glyphicon-plus"></span> Add user(s) to the group
                </a>
                <a class="btn btn-primary" href="{{ route('groups.index') }}">
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

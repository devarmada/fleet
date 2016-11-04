@extends('layouts.app')

@section('content')
  <script>
  function ConfirmDelete()  {
    var x = confirm("Are you sure you want to delete this user?");
    if (x)
      return true;
    else
      return false;
  }

  function ConfirmDisassociate(group)  {
    var x = confirm("Are you sure you want to remove this user from group " + group + "?");
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
                <h2>{{ $user->name }}</h2>
                <h3>{{ $user->email }}</h3>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-left" style="margin-top: 20px;margin-left: 20px;">
                {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()' ,'route' => array('users.destroy', $user->id))) !!}
                <a class="btn btn-primary" href="{{ route('users.edit', array($user->id)) }}">
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
            <th width="85%">Group name</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody>
      @foreach( $user->groups as $group )
        <tr>
            <td>
                <!-- <a href="{{  route('groups.show', $group->id) }}"
                   style="display: block; width: 100%; height: 100%;"> -->
                    {{ $group->name }}
                <!-- </a> -->
            </td>
            <td>
                {!! Form::open(array('class' => 'form-inline', 'method' => 'POST', 'onsubmit' => 'return ConfirmDisassociate("' . $group->name . '")', 'route' => array('users.remove_group', $user->id, $group->id))) !!}
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
                <a class="btn btn-primary" href="{{ route('users.add_group', $user->id, array('class' => 'btn btn-info')) }}">
                    <span class="glyphicon glyphicon-plus"></span> Add group(s) association
                </a>
                <a class="btn btn-primary" href="{{ route('users.index') }}">
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

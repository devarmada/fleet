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
  </script>

  <h2>Users</h2>

  <table class="table table-striped">
    <thead>
      <tr style="text-align: center;">
        <th width="40%">Name</th>
        <th width="40%">Email</th>
        <th width="20%">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach( $users as $user )
        <tr>
          <td style="height:0px; width:0px;">
            <a href="{{ route('users.show', $user->id) }}" style="display: block; width: 100%; height: 100%;">
              {{ $user->name }}
            </a>
          </td>
          <td style="height:0px; width:0px;">
            <a href="{{ route('users.show', $user->id) }}" style="display: block; width: 100%; height: 100%;">
              {{ $user->email }}
            </a>
          </td>
          <td style="height:0px; width:0px;">
            {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()' ,'route' => array('users.destroy', $user->id))) !!}
            <a class="btn btn-primary" href="{{ route('users.edit', array($user->id)) }}">
              <span class="glyphicon glyphicon-pencil"></span> Edit
            </a>
            {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Delete', array('class' => 'btn btn-danger', 'type' => 'submit')) !!}
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
          <a class="btn btn-primary" href="{{ route('users.create', 'New list', array(), array('class' => 'btn btn-info')) }}">
            <span class="glyphicon glyphicon-plus"></span> New user
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

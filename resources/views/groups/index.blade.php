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
  </script>

  <h2>Groups</h2>

  <table class="table table-striped">
    <thead>
      <tr style="text-align: center;">
        <th width="75%">Name</th>>
        <th width="25%">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach( $groups as $group )
        <tr>
          <td>
            <a href="{{ route('groups.show', $group->id) }}" style="display: block; width: 100%; height: 100%;">
              {{ $group->name }}
            </a>
          </td>
          <td>
            {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()' ,'route' => array('groups.destroy', $group->id))) !!}
            <a class="btn btn-primary" href="{{ route('groups.edit', array($group->id)) }}">
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
          <a class="btn btn-primary" href="{{ route('groups.create', 'New list', array(), array('class' => 'btn btn-info')) }}">
            <span class="glyphicon glyphicon-plus"></span> New group
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

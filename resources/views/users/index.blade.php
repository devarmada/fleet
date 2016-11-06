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

  @if($users->count() > 4)
    @include('users/partials/_navbutton_index')
  @endif

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
        <tr class="noborder">
          <td class="noborder sized">
            <a href="{{ route('users.show', $user->id) }}" class="expanded">
              {{ $user->name }}
            </a>
          </td>
          <td class="noborder sized">
            <a href="{{ route('users.show', $user->id) }}" class="expanded">
              {{ $user->email }}
            </a>
          </td>
          <td>
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

  @include('users/partials/_navbutton_index')

@endsection

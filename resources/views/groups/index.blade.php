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

  @if($groups->count() > 4)
    @include('groups/partials/_navbutton_index')
  @endif

  <table class="table table-striped">
    <thead>
      <tr style="text-align: center;">
        <th width="75%">Name</th>
        <th width="25%">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach( $groups as $group )
        <tr class="noborder">
          <td class="noborder sized">
            <a href="{{ route('groups.show', $group->id) }}" class="expanded">
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

  @include('groups/partials/_navbutton_index')

  @endsection

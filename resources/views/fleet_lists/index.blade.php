@extends('layouts.app')

@section('content')
  <script>
    function ConfirmDelete()  {
    var x = confirm("Are you sure you want to delete this list?");
    if (x)
      return true;
    else
      return false;
  }
  </script>

  <h2>Aircraft lists</h2>

  @if ( !$fleet_lists->count() )
    You have no aircraft lists
  @else
    @if($fleet_lists->count() > 4)
      @include('fleet_lists/partials/_navbutton_index')
    @endif

    <table class="table table-striped">
      <thead>
        <tr style="text-align: center;">
          <th width="20%">List</th>
          <th width="45%">Description</th>
          <th width="10%">User</th>
          <th width="10%">Group</th>
          <th width="15%">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach( $fleet_lists as $fleet_list )
          <tr class="noborder">
            <td class="noborder sized">
              <a href="{{ route('fleet_lists.show', $fleet_list->id) }}" class="expanded">
                {{ $fleet_list->name }}
              </a>
            </td>
            <td class="noborder sized">
              <a href="{{ route('fleet_lists.show', $fleet_list->id) }}" class="expanded">
                {{ $fleet_list->description }}
              </a>
            </td>
            <td class="noborder sized">
              <a href="{{ route('fleet_lists.show', $fleet_list->id) }}" class="expanded">
                {{ $fleet_list->user->name }}
              </a>
            </td>
            <td class="noborder sized">
              <a href="{{ route('fleet_lists.show', $fleet_list->id) }}" class="expanded">
                {{ $fleet_list->group->name }}
              </a>
            </td>
            <td>
              {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()' ,'route' => array('fleet_lists.destroy', $fleet_list->id))) !!}
              <a class="btn btn-primary" href="{{ route('fleet_lists.edit', array($fleet_list->id)) }}">
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

  @include('fleet_lists/partials/_navbutton_index')

@endsection

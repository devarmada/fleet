@extends('app')

@section('content')
<h2>{{ $aircraft->model }}</h2>


{!! Form::open(array('class' => 'form-inline', 
'method' => 'DELETE', 
'route' => array('aircrafts.destroy', 
$fleet_list->id, $aircraft->id))) !!}
<a href="{{ route('fleet_lists.aircrafts.show', [$fleet_list->id, $aircraft->id]) }}">{{ $aircraft->model }}</a>
(
{!! link_to_route('fleet_lists.aircrafts.edit', 'Edit', array($fleet_list->id, $aircraft->id), 
array('class' => 'btn btn-info')) !!},

{!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
)
{!! Form::close() !!}
@endif
<p>
    {!! link_to_route('fleet_lists.index', 'Back to Projects') !!} |
    {!! link_to_route('fleet_lists.aircrafts.create', 'Create Task', $project->id) !!}
</p>
@endsection
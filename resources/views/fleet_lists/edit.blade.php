@extends('layouts.app')

@section('content')
<h2>Edit List</h2>
{!! Form::model($fleet_list, ['method' => 'PATCH', 'route' => ['fleet_lists.update', $fleet_list->id]]) !!}
@include('fleet_lists/partials/_form', ['submit_text' => 'Save', 'name_value' => $fleet_list->name, 'desc_value' => $fleet_list->description])
{!! Form::close() !!}
@endsection

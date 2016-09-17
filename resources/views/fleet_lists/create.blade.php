@extends('layouts.app')

@section('content')
<h2>Create List</h2>
{!! Form::model(new App\FleetList, ['route' => ['fleet_lists.store']]) !!}
@include('fleet_lists/partials/_form', ['submit_text' => 'Create', 'name_value' => '', 'desc_value' => ''])
{!! Form::close() !!}
@endsection
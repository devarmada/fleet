@extends('layouts.app')

@section('content')
<h2>Create List</h2>
{!! Form::model(new App\Aircraft, ['route' => ['fleet_lists.aircrafts.store', $fleet_list->id]]) !!}
@include('aircrafts/partials/_form', ['submit_text' => 'Create', 'model_value' => '', 'year_value' => '', 'desc_value' => ''])
{!! Form::close() !!}
@endsection

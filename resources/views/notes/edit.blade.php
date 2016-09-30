@extends('layouts.app')

@section('content')
<h2>Edit aircraft</h2>
{!! Form::model($aircraft, ['method' => 'PATCH', 'route' => ['fleet_lists.aircrafts.update', $fleet_list->id, $aircraft->id]]) !!}
@include('aircrafts/partials/_form', ['submit_text' => 'Edit', 'model_value' => $aircraft->model, 'year_value' => $aircraft->year, 'desc_value' => $aircraft->description])
{!! Form::close() !!}
@endsection

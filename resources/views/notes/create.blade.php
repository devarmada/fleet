@extends('layouts.app')

@section('content')
<h2>Create note</h2>
{!! Form::model(new App\Note, ['route' => ['fleet_lists.aircrafts.notes.store', $fleet_list->id, $aircraft->id]]) !!}
@include('notes/partials/_form', ['submit_text' => 'Create', 'title_value' => '', 'text_value' => ''])
{!! Form::close() !!}
@endsection

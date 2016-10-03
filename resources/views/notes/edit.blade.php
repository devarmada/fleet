@extends('layouts.app')

@section('content')
<h2>Edit note</h2>
{!! Form::model($note, ['method' => 'PATCH', 'route' => ['fleet_lists.aircrafts.notes.update', $fleet_list->id, $aircraft->id, $note->id]]) !!}
@include('notes/partials/_form', ['submit_text' => 'Edit', 'title_value' => $note->title, 'text_value' => $note->text])
{!! Form::close() !!}
@endsection

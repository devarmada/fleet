@extends('layouts.app')

@section('content')
<h2>Edit attachment</h2>
{!! Form::model($attachment, ['files' => true, 'method' => 'PATCH', 'route' => ['fleet_lists.aircrafts.attachments.update', $fleet_list->id, $aircraft->id, $attachment->id]]) !!}
@include('attachments/partials/_form', ['submit_text' => 'Save', 'title_value' => $attachment->title, 'file_name_value' => $attachment->file_name])
{!! Form::close() !!}
@endsection

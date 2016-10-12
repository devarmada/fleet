@extends('layouts.app')

@section('content')
<h2>Create List</h2>
{!! Form::model(new App\Attachment, ['files' => true, 'route' => ['fleet_lists.aircrafts.attachments.store', $fleet_list->id, $aircraft->id]]) !!}
@include('attachments/partials/_form', ['submit_text' => 'Create', 'title_value' => '', 'file_name_value' => ''])
{!! Form::close() !!}
@endsection

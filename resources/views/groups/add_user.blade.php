@extends('layouts.app')

@section('content')
<h2>Add user to the group</h2>
{!! Form::model($group, ['method' => 'PATCH', 'route' => ['groups.store_user', $group->id]]) !!}
@include('groups/partials/_user_form', ['user_values' => collect()])
@include('groups/partials/_button_form', ['submit_text' => 'Save'])
{!! Form::close() !!}
@endsection

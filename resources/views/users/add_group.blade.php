@extends('layouts.app')

@section('content')
<h2>Add group association</h2>
{!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.store_group', $user->id]]) !!}
@include('users/partials/_group_form', ['group_values' => collect()])
@include('users/partials/_button_form', ['submit_text' => 'Save'])
{!! Form::close() !!}
@endsection

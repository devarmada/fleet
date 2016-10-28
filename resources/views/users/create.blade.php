@extends('layouts.app')

@section('content')
<h2>Create user</h2>
{!! Form::model(new App\User, ['route' => ['users.store']]) !!}
@include('users/partials/_form', ['submit_text' => 'Create', 'name_value' => '', 'email_value' => '', 'group_values' => collect()])
{!! Form::close() !!}
@endsection

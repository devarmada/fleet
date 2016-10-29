@extends('layouts.app')

@section('content')
<h2>Edit User</h2>
{!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}
@include('users/partials/_form', ['submit_text' => 'Save', 'name_value' => $user->name, 'email_value' => $user->email, 'group_values' => $user->groups])
{!! Form::close() !!}
@endsection

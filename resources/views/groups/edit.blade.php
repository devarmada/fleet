@extends('layouts.app')

@section('content')
<h2>Edit User</h2>
{!! Form::model($group, ['method' => 'PATCH', 'route' => ['groups.update', $group->id]]) !!}
@include('groups/partials/_form', ['submit_text' => 'Save', 'name_value' => $group->name, 'user_values' => $group->users])
{!! Form::close() !!}
@endsection

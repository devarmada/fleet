@extends('layouts.app')

@section('content')
<h2>Create group</h2>
{!! Form::model(new App\Group, ['route' => ['groups.store']]) !!}
@include('groups/partials/_form', ['submit_text' => 'Create', 'name_value' => '', 'user_values' => collect()])
{!! Form::close() !!}
@endsection

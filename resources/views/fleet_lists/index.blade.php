@extends('layouts.app')

@section('content')
<h2>Aircraft lists</h2>

@if ( !$fleet_lists->count() )
You have no aircraft lists
@else
<table class="table table-striped">
    <thead>
        <tr style="text-align: center;">
            <th width="20%">List</th>
            <th width="45%">Description</th>
            <th width="10%">User</th>
            <th width="10%">Group</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $fleet_lists as $fleet_list )
        <tr>
            <td>
                <a href="{{ route('fleet_lists.show', $fleet_list->id) }}"
                   style="display: block; width: 100%; height: 100%;">
                    {{ $fleet_list->name }}
                </a>
            </td>
            <td>
                <a href="{{ route('fleet_lists.show', $fleet_list->id) }}"
                   style="display: block; width: 100%; height: 100%;">
                    {{ $fleet_list->description }}
                </a>
            </td>
            <td>
                <a href="{{ route('fleet_lists.show', $fleet_list->id) }}"
                   style="display: block; width: 100%; height: 100%;">
                    {{ $fleet_list->user->name }}
                </a>
            </td>
            <td>
                <a href="{{ route('fleet_lists.show', $fleet_list->id) }}"
                   style="display: block; width: 100%; height: 100%;">
                    {{ $fleet_list->group->name }}
                </a>
            </td>
            <td>
                {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('fleet_lists.destroy', $fleet_list->id))) !!}
                <a class="btn btn-primary" href="{{ route('fleet_lists.edit', array($fleet_list->id)) }}">
                    <span class="glyphicon glyphicon-pencil"></span> Edit
                </a>
                {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Delete', array('class' => 'btn btn-danger', 'type' => 'submit')) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
<nav class="navbar navbar-static-top">
    <div class="container">
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <a class="btn btn-primary" href="{{ route('fleet_lists.create', 'New list', array(), array('class' => 'btn btn-info')) }}">
                    <span class="glyphicon glyphicon-plus"></span> New list
                </a>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                &nbsp;
            </ul>
        </div>
    </div>
</nav>
@endsection

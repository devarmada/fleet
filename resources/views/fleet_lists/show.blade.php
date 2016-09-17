@extends('layouts.app')

@section('content')


<nav class="navbar navbar-static-top">
    <div class="container">
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <h2>{{ $fleet_list->name }}</h2>
                <h3>{{ $fleet_list->description }}</h3>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-left" style="margin-top: 20px;margin-left: 20px;">
                {!! Form::open(array('class' => 'form-inline', 
                'method' => 'DELETE', 
                'route' => array('fleet_lists.destroy', 
                $fleet_list->id))) !!}
                {!! link_to_route('fleet_lists.edit', 'Edit', array($fleet_list->id), 
                array('class' => 'btn btn-info')) !!},
                {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                {!! Form::close() !!}
            </ul>
        </div>
    </div>
</nav>


@if ( !$fleet_list->aircrafts->count() )
Your list has no aircrafts.
@else
<table class="table table-striped">
    <thead>
        <tr style="text-align: center;">
            <th width="20%">Model</th>
            <th width="5%">Year</th>
            <th width="45%">Description</th>
            <th width="15%">User</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $fleet_list->aircrafts as $aircraft )
        <tr>
            <td>
                <a href="{{ route('fleet_lists.aircrafts.show', [$fleet_list->id, $aircraft->id]) }}"
                   style="display: block; width: 100%; height: 100%;">
                    {{ $aircraft->model }}
                </a>
            </td>
            <td>
                <a href="{{ route('fleet_lists.aircrafts.show', [$fleet_list->id, $aircraft->id]) }}"
                   style="display: block; width: 100%; height: 100%;">
                    {{ $aircraft->year }}
                </a>
            </td>
            <td>
                <a href="{{ route('fleet_lists.aircrafts.show', [$fleet_list->id, $aircraft->id]) }}"
                   style="display: block; width: 100%; height: 100%;">
                    {{ $aircraft->description }}
                </a>
            </td>
            <td>
                <a href="{{ route('fleet_lists.aircrafts.show', [$fleet_list->id, $aircraft->id]) }}"
                   style="display: block; width: 100%; height: 100%;">
                    {{ $aircraft->user->name }}
                </a>
            </td>
            <td>
                {!! Form::open(array('class' => 'form-inline', 
                'method' => 'DELETE', 
                'route' => array('fleet_lists.aircrafts.destroy', 
                $fleet_list->id, $aircraft->id))) !!}
                {!! link_to_route('fleet_lists.aircrafts.edit', 'Edit', array($fleet_list->id, $aircraft->id), 
                array('class' => 'btn btn-info')) !!},
                {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
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
                {!! link_to_route('fleet_lists.aircrafts.create', 'New aircraft', array($fleet_list->id), 
                array('class' => 'btn btn-info')) !!},
                <a class="btn btn-primary" href="{{ route('fleet_lists.index') }}">
                    <span class="glyphicon glyphicon-hand-left"></span> Back
                </a>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                nbsp;
            </ul>
        </div>
    </div>
</nav>

@endsection

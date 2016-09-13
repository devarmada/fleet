@extends('default')

@section('content')
<h2>{{ $fleet_list->name }}</h2>

@if ( !$fleet_list->aircrafts->count() )
Your list has no aircrafts.
@else
<ul>
    @foreach( $fleet_list->aircrafts as $aircraft )
    <li>
        <a href="{{ route('fleet_lists.aircrafts.show', [$fleet_list->id, $aircraft->id]) }}">
            {{ $aircraft->model }}
        </a>
    </li>
    @endforeach
</ul>
@endif
@endsection

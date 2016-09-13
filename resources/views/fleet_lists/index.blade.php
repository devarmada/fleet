@extends('default')

@section('content')
<h2>Aircraft lists</h2>

@if ( !$fleet_lists->count() )
You have no aircraft lists
@else
<ul>
    @foreach( $fleet_lists as $fleet_list )
    <li><a href="{{ route('fleet_lists.show', $fleet_list->id) }}">{{ $fleet_list->name }}</a></li>
    @endforeach
</ul>
@endif
@endsection

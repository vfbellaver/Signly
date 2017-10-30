@is(['slc', 'admin'])
<li class="{!! (route_contains('users', 'IN')) ? 'active' : '' !!}">
    <a href="{{ route('users.index') }}">User</a>
</li>
<li class="{{route_contains('billboard', 'IN') ? 'active' : ''}}">
    <a class="nav-link" href="{{ route('billboards.index') }}">Billboards</a>
</li>
<li class="{!! (route_contains('client', 'IN')) ? 'active' : '' !!}">
    <a href="{{ route('clients.index') }}">Clients</a>
</li>
@endis
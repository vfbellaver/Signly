@is(['slc', 'admin'])
<li class="{!! (route_contains('users', 'IN')) ? 'active' : '' !!}">
    <a href="{{ route('users.index') }}">Users</a>
</li>
<li class="{!! (route_contains('clients', 'IN')) ? 'active' : '' !!}">
    <a href="{{ route('clients.index') }}">Clients</a>
</li>
@endis

@is(['slc', 'admin'])
    <li class="{!! (route_contains('users','IN')) ? 'active' : '' !!}">
        <a class="nav-link" href="{{ route('users.index') }}">Users</a>
    </li>
    <li class="{!! (route_contains('billboards','IN')) ? 'active' : '' !!}">
        <a class="nav-link" href="{{ route('billboards.index') }}">Billboard</a>
    </li>
    <li class="{!! (route_contains('clients', 'IN')) ? 'active' : '' !!}">
        <a href="{{ route('clients.index') }}">Clients</a>
    </li>
@endis
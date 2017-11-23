@canImpersonate
<li class="{{route_contains('user', 'IN') ? 'active' : ''}}">
    <a class="nav-link" href="{{ route('users.index') }}">Users</a>
</li>
@endCanImpersonate

<li class="{{route_contains('billboard', 'IN') ? 'active' : ''}}">
    <a class="nav-link" href="{{ route('billboards.index') }}">Billboards</a>
</li>
<li class="{!! (route_contains('client', 'IN')) ? 'active' : '' !!}">
    <a href="{{ route('clients.index') }}">Clients</a>
</li>
<li class="{!! (route_contains('proposal', 'IN')) ? 'active' : '' !!}">
    <a href="{{ route('proposals.index') }}">Proposals</a>
</li>
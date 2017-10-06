
@is(['slc', 'admin'])
<li>
    <a class="nav-link" href="{{ route('users.index') }}">Settings</a>
</li>
<li>
    <a class="nav-link" href="{{ route('billboards.index') }}">Billboards</a>
</li>
<li class="{!! (route_contains('clients', 'IN')) ? 'active' : '' !!}">
    <a href="{{ route('clients.index') }}">Clients</a>
</li>

@endis
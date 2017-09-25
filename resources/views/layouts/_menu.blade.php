



@is(['slc', 'admin'])
<li class="{!! (route_contains('users','IN')) ? 'active' : '' !!}">
    <a class="nav-link" href="{{ route('users.index') }}">Users</a>
</li>
<li>
    <a class="nav-link" href="{{ route('billboards.index') }}">Billboard</a>
</li>
<li class="{!! (route_contains('billboard-faces','IN')) ? 'active' : '' !!}">
    <a class="nav-link" href="{{ route('billboard-faces.index') }}">Billboard Faces</a>
</li>
<li class="{!! (route_contains('csv-upload', 'IN')) ? 'active' : '' !!}">
    <a href="{{ route('csv-upload.index') }}">Import CSV File</a>
</li>
<li class="{!! (route_contains('clients', 'IN')) ? 'active' : '' !!}">
    <a href="{{ route('clients.index') }}">Clients</a>
</li>

@endis
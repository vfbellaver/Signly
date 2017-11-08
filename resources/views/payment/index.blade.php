@extends('layouts.app')

@section('content')
    @component('components.default-page')
        <table>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                    <td>{{ $invoice->total() }}</td>
                    <td><a href="/user/invoice/{{ $invoice->id }}">Download</a></td>
                </tr>
            @endforeach
        </table>
    @endcomponent
@endsection

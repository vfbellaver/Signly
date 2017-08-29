@extends('app')

@section('content')
<div class="container">
<table class="table">
    <tbody id="tabela">
    <tr id="1">
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
    </tr>
    <tr id="2">
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
    </tr>
    <tr id="3">
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
    </tr>
    </tbody>
</table>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
        $(function () {
            $('#tabela').sortable();
        })
    </script>
</div>
@stop
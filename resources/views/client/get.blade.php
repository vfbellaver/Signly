@extends('app')

@section('content')

<div class="container">
    	<h3>{{ $client->company }}</h3>
        
        <table class="table no-border">
        	<tr>
            	<td width="150px"><label>Contant Name:</label></td>
                <td>{{ $client->first_name.' '.$client->last_name }}</td>
            </tr>
            <tr>
            	<td width="150px"><label>Phone Number:</label></td>
                <td>{{ $client->phone1 }}</td>
            </tr>
            <tr>
            	<td width="150px"><label>Mobile Number:</label></td>
                <td>{{ $client->phone2 }}</td>
            </tr>
            <tr>
            	<td width="150px"><label>Fax Number:</label></td>
                <td>{{ $client->fax }}</td>
            </tr>
            <tr>
            	<td width="150px"><label>Billing Adress:</label></td>
                <td>{{ $client->billing_address.' '.$client->billing_city.' '.$client->billing_state.' '.$client->billing_zipcode }}</td>
            </tr>
            <tr>
            	<td width="150px"><label>Client Logo:</label></td>
                <td>
                	<span class="note-upload">Uploading a logo for your client will make your proposal look MUCH more professional. (max-width 300px).</span>
                	
                    <input type="file">
                </td>
            </tr>
            <tr>
            	<td width="150px"><label>Lifetime Value:</label></td>
                <td>
                	$0
                    
                    <p>Love 'em or hate 'em this is how much this client has paid you since being entered into the system.</p>
                </td>
            </tr>
            <tr>
            	<td width="150px"></td>
                <td>
                	<a>see this Client History</a>
                </td>
            </tr>
        </table>
    </div>      
       
    

@endsection

<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>
		
		<P>Hi {{ $agentname }}</P>

		<p><b>{{ $clientname }}</b> has accepted your proposal "<b>{{ $proposal_name }}</b>"</p>
        
		<p>Please click the link below to view the Proposal</p>
		
		<p>
			URL : <a href="http://signly.com/app/clientview/{{ $hash }}">http://signly.com/app/clientview/{{ $hash }}</a><br/>
		</p>

		<p>Thank you.</p> 

		<p>Signly Team</p>
		
		</div>
	</body>
</html>


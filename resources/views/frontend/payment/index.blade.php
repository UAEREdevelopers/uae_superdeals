<html>
<head>
<title>Superdeals Payment</title>
</head>
<body>
<center>

<form method="post" name="redirect" action="{{$production_url}}"> 

<input type=hidden name=encRequest value="{{$encrypted_string}}">
<input type=hidden name=access_code value="{{$access_code}}">

</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>
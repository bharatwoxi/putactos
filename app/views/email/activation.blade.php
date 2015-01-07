<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>


<p>Welcome to Putactos! {{$firstName}}, You are almost there. Just click the link below to confirm your email address.</p>
<p></p><a href='{{{ URL::to("user/confirm/$_token") }}}'>
    <span style="color:blue;font-weight:900">Click on this, to confirm your account!!</span>
</a></p>
<p>Stay awesome,<br>
    The team at Putactos</p>
<p>Thank you</p>

</body>
</html>
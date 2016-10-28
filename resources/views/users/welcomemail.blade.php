<h1>Hi {{ $user->name }}!</h1>
<p>We'd like to personally welcome you. Thank you for registering!</p>
<p>Please click the link below to set your account password and get access to your account :</p>
<p><a href="{{ URL::to('password/reset/' .  $token) }}">{{ URL::to('password/reset/' .  $token) }}</a></p>

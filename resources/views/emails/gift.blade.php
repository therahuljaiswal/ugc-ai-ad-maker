<h1>Good news, {{ $user->name }}!</h1>
<p>Admin has gifted you {{ $amount }} free credits.</p>
<p>Your new credit balance is: {{ $user->credits }}</p>
<a href="{{ url('/dashboard') }}">Start Creating Ads</a>

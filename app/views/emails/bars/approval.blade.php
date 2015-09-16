<html>
<body>
  Hi there,
<br><br>
  {{ $bar_name or "Your bar" }} has been approved — thanks for opening your doors to even more Packers fans every Sunday!
<br><br>
  Check out your bar's profile on Packers Everywhere now: http://www.packerseverhwere.com/app/venues/{{ $bar_slug }}
<br><br>
  Once you’re finished setting up your account, you can use this link to manage your profile: {{ url('user/edit') }}
<br><br>
  You’re now on the official Packers Everywhere map, so fans in or near {{ $bar_city or "your area" }} can easily find you.
  We’ll update you throughout the season with new opportunities for you to give your patrons the ultimate green and
  gold gameday experience.
<br><br>
  Remember, being listed on Packerseverywhere.com is free and with no strings attached. We simply want to make sure our
  fans have a place to go to watch the game with like-minded fans.
<br><br>
  <a href="{{ url('user/edit')}}">Set up your profile now, and get ready for some football!</a>
<br><br>
  Joan Malcheski
</body>
</html>
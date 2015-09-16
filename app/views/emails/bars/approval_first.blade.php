<html>
<body>
<h1>Welcome to Packers Everywhere!</h1>
  As an official Packers Everywhere bar, you have your own page on our website, which you can manage as you see fit.
  Feel free to edit your description, add gameday specials, and create events.
<br><br>
  <strong>Check out your bar's profile on Packers Everywhere now: http://www.packerseverywhere.com/app/venues/{{ $bar_slug }}</strong>
  Once you’re finished setting up your account, you can use this link to manage your bar: {{ url('/editbar/' . $bar_id) }}
<br><br>
  Here are your temporary login credentials:<br>
  Username: {{ $username }}<br>
  Password: gopackgo
<br><br>
  Log in and change your password here: {{ url('user/edit') }}
<br><br>
  We’ve already added you to our map, so fans in or near {{ $bar_city or "your area" }} can easily find you. Be on the lookout for your
  Packers Everywhere certificate in the mail, which shows that you’re an official Packers establishment. We’ll update
  you throughout the season with new opportunities for you to give your patrons the ultimate football Sunday experience.
<br><br>
  Remember, being listed on Packerseverywhere.com is free and with no strings attached. We simply want to make sure our fans have a
  place to go to watch the game with like-minded fans.
<br><br>
  Set up your profile now, and get ready for some football!
<br><br>
  Go Pack Go!<br><br>
  Joan Malcheski<br>
  Packers Everywhere
</body>
</html>
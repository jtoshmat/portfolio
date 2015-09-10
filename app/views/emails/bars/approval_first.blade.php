<html>
<body>
<h1>Welcome to Packers Everywhere!</h1>
<p>
    As an official Packers Everywhere bar, you have your own page on our website, which you can manage as you see fit.
    Feel free to edit your description, add gameday specials, and create events.
</p>
<p>
    Check out your bar's profile on Packers Everywhere now: http://www.packerseverywhere.com/app/venues/{{ $bar_slug }}
</p>
<p>
    Once you’re finished setting up your account, you can use this link to manage your bar: {{ url('/editbar/' . $bar_id) }}
</p>
<p>
    Here are your temporary login credentials:<br>
    Username: {{ $username }}<br>
    Password: gopackgo
</p>
<p>
    Log in and change your password here: {{ url('user/edit') }}
</p>
<p>
    We’ve already added you to our map, so fans in {{ $bar_city or "your area" }} can easily find you. Be on the lookout for your
    Packers Everywhere certificate in the mail, which shows that you’re an official Packers establishment. We’ll update
    you throughout the season with new opportunities for you to give your patrons the ultimate football Sunday experience.
</p>
<p>
    Set up your profile now, and get ready for some football!
</p>
<p>
    Go Pack Go!<br><br>
    Joan Malcheski<br>
    Packers Everywhere
</p>
</body>
</html>
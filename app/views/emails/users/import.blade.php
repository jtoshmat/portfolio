<html>
<body>
<p>Thanks for being a part of the Packers Everywhere community!</p>
<p>
    The Packers Everywhere admin portal has changed.Use this link to edit your description,
    add gameday specials, and create events: {{ url('/bars') }}
</p>
<p>
    Here are your temporary login credentials:<br>
    Username: {{ $username }}<br>
    Password: {{ $password }}
</p>
<p>
    You can change your password here: {{ url('user/edit') }}
</p>
<p>
    <strong>Update your profile now, and get ready for some football!</strong>
</p>
<p>
    Go Pack Go!
</p>
<p>
    Joan Malcheski<br>
    Packers Everywhere
</p>
</body>
</html>
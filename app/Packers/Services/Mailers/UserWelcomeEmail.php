<?php namespace Packers\Services\Mailers;

class UserWelcomeEmail extends PackersMailer
{
    /**
     * Sample Mailer Class
     *
     * You will want to make a separate class for each mailing you want to send, and just pass in a User object
     * I'm just querying for a User for sample purposes here.
     *
     */
    public function run()
    {
        $user = \User::where('email', '=', 'jschwartz@bluestatedigital.com')->first();
        $view = 'emails.users.welcome';
        $subject = 'Welcome to PackersEverywhere!';
        $data = array(
            'foo' => 'bar',
            'username' => $user->username,
        );
        //dd($user);
        return $this->sendTo($user, $subject, $view, $data);
    }
}
<?php namespace Packers\Services\Mailers;

class UserImportMailer extends PackersMailer
{
    public function run($user)
    {
        $view = 'emails.users.import';
        $subject = 'Packers Everywhere Admin Portal Update';
        $data = array(
            'username' => $user->username,
            'password' => 'gopackgo',
        );

        if($this->sendTo($user, $subject, $view, $data)) {
            $this->logEmail('email.import.notification', $user);
            return true;
        }
    }
}
{

}
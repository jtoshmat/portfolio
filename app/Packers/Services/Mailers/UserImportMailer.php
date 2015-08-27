<?php namespace Packers\Services\Mailers;

class UserImportMailer extends PackersMailer
{
    public function run($user)
    {
        $view = 'emails.users.import';
        $subject = 'You\'re a very imported person!';
        $data = array(
            'username' => 'username',
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
<?php namespace Packers\Services\Mailers;

class BarApprovalMailer extends PackersMailer
{
    public function run($user, $bar)
    {
        if($this->isFirstTimeBarApproved()) { //make sure this email hasn't been sent yet
            if($this->isFirstUserBarApproval()) {  //check to see if this is the first time a bar is being approved
                $view = 'emails.bars.approval_first';
                $subject = 'Welcome to Packers Everywhere!';
                $data = array(
                    'username' => $user->username,
                    'bar_slug' => $bar->slug,
                    'bar_id' => $bar->id,
                    'bar_city' => $bar->city
                );

                if ($this->sendTo($user, $subject, $view, $data)) {
                    $this->logEmail('email.first.bar.approval', $user);
                    return true;
                }
            } else { //send the secondary bar approval

            }
        }
    }

    private function isFirstTimeBarApproved() {
        return true;
    }

    private function isFirstUserBarApproval() {
        return true;
    }
}
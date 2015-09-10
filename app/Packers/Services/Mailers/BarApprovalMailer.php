<?php namespace Packers\Services\Mailers;

class BarApprovalMailer extends PackersMailer
{
    public function run($user, $bar, $approved)
    {
        if($approved == 1) {
            if ($this->isFirstTimeBarApproved($bar)) { //make sure this email hasn't been sent yet
                if ($this->isFirstApiBarApproval($user, $bar)) {  //check to see if this is the first time a bar is being approved
                    return $this->sendFirstApprovalEmail($user, $bar);
                } else { //send the secondary bar approval
                    return $this->sendApprovalEmail($user, $bar);
                }
            }
        }
        else { //send the denial email
            if($this->firstBarRejection($bar)) {
                return $this->sendRejectionEmail($user, $bar);
            }
        }
    }

    private function isFirstTimeBarApproved($bar) {
        $log = \EmailLog::where('ext_type', '=', 'bar_id')
                       ->where('ext_id', '=', $bar->id)->get();
        return $log->count() > 0 ? false : true;
    }

    private function isFirstApiBarApproval($user, $bar) {
        $log = \EmailLog::where('user_id', '=', $user->id)
                        ->where('type', '=', 'email.bar.approval')
                        ->orWhere('type', '=', 'email.import.notification')->get();
        if($bar->from_api == 1 && $log->count() == 0) {
            return true;
        }
        else{
            return false;
        }
    }

    private function firstBarRejection($bar) {
        $log = \EmailLog::where('ext_id', '=', $bar->id)
                        ->where('ext_type', '=', 'bar_id')
                        ->where('type', '=', 'email.bar.rejection')->get();
        return $log->count() > 0 ? false : true;
    }

    private function sendFirstApprovalEmail($user, $bar) {
        $view = 'emails.bars.approval_first';
        $subject = 'Welcome to Packers Everywhere!';
        $data = array(
            'username' => $user->username,
            'bar_slug' => $bar->slug,
            'bar_id' => $bar->id,
            'bar_city' => $bar->city
        );

        if ($this->sendTo($user, $subject, $view, $data)) {
            $ext = array('ext_type' => 'bar_id', 'ext_id' => $bar->id);
            $this->logEmail('email.bar.approval.first', $user, $ext);
            return true;
        }
    }

    private function sendApprovalEmail($user, $bar) {
        $view = 'emails.bars.approval';
        $subject = $bar->barname . ' has been approved';
        $data = array(
            'bar_slug' => $bar->slug,
            'bar_id' => $bar->id,
            'bar_city' => $bar->city,
            'bar_name' => $bar->barname
        );

        if ($this->sendTo($user, $subject, $view, $data)) {
            $ext = array('ext_type' => 'bar_id', 'ext_id' => $bar->id);
            $this->logEmail('email.bar.approval', $user, $ext);
            return true;
        }
    }

    private function sendRejectionEmail($user, $bar) {
        $view = 'emails.bars.rejection';
        $subject = $bar->barname . ' has been rejected';
        $data = array();

        if ($this->sendTo($user, $subject, $view, $data)) {
            $ext = array('ext_type' => 'bar_id', 'ext_id' => $bar->id);
            $this->logEmail('email.bar.approval', $user, $ext);
            return true;
        }
    }
}

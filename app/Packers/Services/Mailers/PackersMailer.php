<?php namespace Packers\Services\Mailers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

abstract class PackersMailer
{
    public function sendTo($user, $subject, $view, $data = array())
    {
        try {
            Mail::queue($view, $data, function ($message) use ($user, $subject, $data) {
                $recipient = $user->email;
                $message->to($recipient)
                    ->subject($subject);
            });
            return true;
        } catch (Swift_TransportException $e) {
            //@todo handle error
        }
    }

    public function logEmail($type, $user, $ext=false) {
        $log = new \EmailLog;
        $log->user_id = $user->id;
        $log->type = $type;
        if($ext) {
            $log->ext_type = $ext['ext_type'];
            $log->ext_id = $ext['ext_id'];
        }
        $log->created_at = Carbon::now();
        $log->updated_at = Carbon::now();
        $log->save();
    }
}
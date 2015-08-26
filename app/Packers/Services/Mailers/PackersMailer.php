<?php namespace Packers\Services\Mailers;

use Illuminate\Support\Facades\Mail;

abstract class PackersMailer
{
    function sendTo($user, $subject, $view, $data = array())
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
}
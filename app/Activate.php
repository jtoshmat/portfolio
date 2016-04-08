<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Activate extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'users';
    protected $parms;
    public static $getActivationCodeRules = array(
        'orgid' => 'required|integer',
        'action' => array('required', 'regex:/^get|send|verify|notme|account$/i'),
        'cid' => 'required|integer|exists:users,cid,type,1',
    );

    public static $sendActivationCodeRules = array(
        'orgid' => 'required|integer',
        'action' => array('required', 'regex:/^get|send|verify|notme|account$/i'),
        'cid' => 'required|integer|exists:users,cid,type,1',
    );

    public static $verifyActivationCodeRules = array(
        'orgid' => 'required|integer',
        'action' => array('required', 'regex:/^get|send|verify|notme|account$/i'),
        'cid' => 'required|integer|exists:users,cid,type,1',
        'code' => 'required_if:action,verify'
    );

    public static $notmeActivationCodeRules = array(
        'orgid' => 'required|integer',
        'action' => array('required', 'regex:/^get|send|verify|notme|account$/i'),
        'cid' => 'required|integer|exists:users,cid,type,1',
    );

    public static $accountActivationCodeRules = array(
        'orgid' => 'required|integer',
        'action' => array('required', 'regex:/^get|send|verify|notme|account$/i'),
        'cid' => 'required|integer|exists:users,cid,type,1',
        'password' => 'required|string',
    );
}

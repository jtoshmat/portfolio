<?php

return [
    /*
    |--------------------------------------------------------------------------
    | All Config parms
    |--------------------------------------------------------------------------
    |
    | This is where we store all the custom config parms
    | Jon Toshmatov
    | 03/03/2016
    |
    */
    'api' => [
        'house'    =>[
        'username' =>   'jtoshmat',
        'password' =>   'business',
        'city'     =>   'Brooklyn',
        'appid'    =>   '4256406aa57c3d7e6c7c07efd94d2679'
        ],
        'cloud'    =>[
            'username' =>   'root',
            'password' =>   'password'
        ]
    ],

    'organizations' => [
        '1' => [
            'adapter' => [
                'primary' => 'UnityAdapter',
                'secondary' => 'EhrAdapter',
                'APITOKENURL' => 'http://tw151ga-azure.unitysandbox.com/Unity/unityservice.svc/json/GetToken',
                'APIURL'  => 'http://tw151ga-azure.unitysandbox.com/Unity/unityservice.svc/json/MagicJson',
                //'APIUSERNAME' => 'CareT-65d1-caretraxx-test',
                //'APIPASSWORD' => 'C@r3tr@xxC2r%tr9xxT%sTepPd51f2',
                'APINAME' => 'CareTraxx.caretraxx.TestApp',
                //'EHRUSERNAME' => 'jmedici',
                'GETPATIENT' => 'getpatient',
                'GETPATIENTFULL' => 'getpatientfull',
                'GETSCHEDULE' => 'GetEncounterList',
                'GETLISTOFDICTIONARIES' => 'getDictionary',
                'GETPROVIDER' => 'getProvider',
                'GETPROVIDERINFO' => 'getProviderInfo',
                'GETCLINICALSUMMARY' => 'getClinicalSummary',
                'ENCOUNTERTYPE' => 'Appointment',
                'TEST' => 'GetPatientSections',
                'TEST2' => 'GetMedicationByTransID',
                'MAXRETRY' => 4
                ]
            ],
        '2' => [
            'adapter' => [
                'primary' => 'EpicAdapter',
                'secondary' => 'EpicAdapter',
            ]
        ],
        '3' => [
            'adapter' => [
                'ehr' => 'EpicAdapter',
                'pms' => 'EpicAdapter',
                'others' => 'EpicAdapter',
            ]
        ],
        ]


];

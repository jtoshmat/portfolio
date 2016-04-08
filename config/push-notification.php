<?php
return array(
    'apple'     => array(
        'environment' =>'development',
        'certificate'=>app_path().'/Services/certificates/CareTraxx_Push.pem',
        'passPhrase'  =>'com.caretraxx.CareTraxx',
        'service'     =>'apns'
    ),
    'android' => array(
        'environment' =>'production',
        'apiKey'      =>'yourAPIKey',
        'service'     =>'gcm'
    )

);
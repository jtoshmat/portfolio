<?php

class WsseAuthHeader extends SoapHeader 
{
	// http://stackoverflow.com/questions/6652227/how-to-consume-a-wcf-web-service-that-uses-custom-username-validation-with-a-php/6684022#6684022
    private $wss_ns = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';
    function __construct($user, $pass, $ns = null)  {    
        if ($ns)  {        
            $this->wss_ns = $ns;    
        }    

        $auth = new stdClass();    

        $auth->Username = new SoapVar($user, XSD_STRING, NULL, $this->wss_ns, NULL, $this->wss_ns);     
        $auth->Password = new SoapVar($pass, XSD_STRING, NULL, $this->wss_ns, NULL, $this->wss_ns);    
        $username_token = new stdClass();    
        $username_token->UsernameToken = new SoapVar($auth, SOAP_ENC_OBJECT, NULL, $this->wss_ns, 'UsernameToken', $this->wss_ns);     
        $security_sv = new SoapVar(        
                                new SoapVar($username_token, SOAP_ENC_OBJECT, NULL, $this->wss_ns, 'UsernameToken', $this->wss_ns),        
                                SOAP_ENC_OBJECT, NULL, $this->wss_ns, 'Security', $this->wss_ns);    

        parent::__construct($this->wss_ns, 'Security', $security_sv, true);
    }
}

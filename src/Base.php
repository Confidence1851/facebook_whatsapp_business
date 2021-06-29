<?php

namespace Confidence\FacebookWhatsappBusiness;

class Base{
    public $baseUrlEndpoint;
    public $authToken;
    public function __construct($baseUrlEndpoint)
    {
        $this->baseUrlEndpoint = $baseUrlEndpoint;
    }

    public function setBaseUrl($url)
    {
        $this->baseUrlEndpoint = $url;
        return $this;
    }

    public function setAuthToken($token)
    {
        $this->authToken = $token;
        return $this;
    }



}

?>

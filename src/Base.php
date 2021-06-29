<?php 

namespace Confidence\FacebookWhatsappBusiness;

class Base{
    public $baseUrlEndpoint;
    public function __construct($baseUrlEndpoint)
    {
        $this->baseUrlEndpoint = $baseUrlEndpoint;
    }

    public function setBaseUrl($url)
    {
        $this->baseUrlEndpoint = $url;
        return $this;
    }



}

?>
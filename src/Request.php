<?php

namespace Confidence\FacebookWhatsappBusiness;

class Request
{
    private $baseUrlEndpoint, $curl, $url, $method, $headers;
    public function __construct($baseUrlEndpoint)
    {
        $this->curl = curl_init();
        $this->baseUrlEndpoint = $baseUrlEndpoint;
    }

    public function url($endpoint)
    {
        $this->url = $this->baseUrlEndpoint + $endpoint;
        return $this;
    }

    public function method($method)
    {
        $this->method = $method;
        return $this;
    }

    public function headers($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    public  function process($formData = null)
    {

        $curl = $this->curl;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => strtoupper($this->method),
            CURLOPT_POSTFIELDS => json_encode($formData),
            CURLOPT_HTTPHEADER => $this->headers
        ));


        $response = curl_exec($curl);

        if(curl_errno($curl)){
            $error_msg = curl_error($curl);
        }

        curl_close($curl);
        return json_decode($response);
    }
}
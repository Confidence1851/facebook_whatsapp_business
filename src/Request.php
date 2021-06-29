<?php

namespace Confidence\FacebookWhatsappBusiness;

use Exception;

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
        $this->url = $this->baseUrlEndpoint . "" . $endpoint;
        return $this;
    }

    public function method($method)
    {
        $this->method = $method;
        return $this;
    }

    public function headers(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }

    public  function process($formData = null)
    {
        try {
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

            // dd($this->headers);


            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);
                throw new Exception($error_msg);
            }
            $code  = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            return Response::success(json_decode($response) , $code);
        } catch (Exception $e) {
            curl_close($curl);
            return Response::failed("An error occurred!" , $e->getMessage());
        }
    }
}

<?php

namespace Confidence\FacebookWhatsappBusiness;

class Response {

    /**
     * Return a success message
     * @required $data
     * string $message
     */
    public static function success($data , $code = 200, $message = null){
        return [
            "success" => true,
            "data" => $data,
            "message" => $message,
            "error" => null,
            "status_code" => $code
        ];
    }


   /**
     * Return an error message
     * @required $message
     * string $error
     */
    public static function failed($message , $error = null , $code = 503){
        return [
            "success" => false,
            "data" => null,
            "message" => $message,
            "error" => $error,
            "status_code" => $code,
        ];
    }


}

?>

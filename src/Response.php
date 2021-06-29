<?php 

namespace Confidence\FacebookWhatsappBusiness;

class Response {

    /**
     * Return a success message
     * @required $data
     * string $message
     */
    public static function success($data , $message = null){
        return [
            "success" => true,
            "data" => $data,
            "message" => $message,
            "error" => null
        ];
    }


   /**
     * Return an error message
     * @required $message
     * string $error
     */
    public static function failed($message , $error){
        return [
            "success" => false,
            "data" => null,
            "message" => $message,
            "error" => $error
        ];
    }
    

}

?>
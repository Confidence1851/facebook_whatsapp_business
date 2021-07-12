<?php

namespace Confidence\FacebookWhatsappBusiness;

use Confidence\FacebookWhatsappBusiness\Base;
use Confidence\FacebookWhatsappBusiness\Endpoints;
use Confidence\FacebookWhatsappBusiness\Request;
use Confidence\FacebookWhatsappBusiness\Response;

class Contacts extends Base
{


    /**
     * Log an admin into the account
     * @required string $newPassword
     */
    public function validate(array $contacts, $blocking = "wait" , $force_check = false)
    {

      if(count($contacts) == 0){
         return Response::failed("Contacts list cannot be empty" , null , 400);
      }

        $request = new Request($this->baseUrlEndpoint);

        $response = $request->url(Endpoints::CONTACTS)
            ->method("POST")
            ->headers([
                "Content-Type: application/json",
                "Authorization: Bearer ".$this->authToken
            ])
            ->process([
                "blocking" => $blocking,
                "force_check" => $force_check,
                "contacts" => $contacts
            ]);

        return $response;
    }
}

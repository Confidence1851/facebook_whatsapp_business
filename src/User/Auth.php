<?php

namespace Confidence\FacebookWhatsappBusiness\User;

use Confidence\FacebookWhatsappBusiness\Base;
use Confidence\FacebookWhatsappBusiness\Endpoints;
use Confidence\FacebookWhatsappBusiness\Request;
use Confidence\FacebookWhatsappBusiness\Response;

class Auth extends Base
{

    /**
     * Log an admin into the account
     * @required string $newPassword
     */
    public function loginAdmin($newPassword)
    {

        $request = new Request($this->baseUrlEndpoint);

        $response = $request->url(Endpoints::LOGIN)
            ->method("POST")
            // ->headers()
            ->process([
                "new_password" => $newPassword
            ]);

        $returnData = null;
        if ($response) {
            $returnData = Response::success($response);
        } else {
            $returnData = Response::failed(null, null);
        }

        return $returnData;
    }
}

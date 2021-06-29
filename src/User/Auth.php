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
    public function loginAdmin($username, $password, $newPassword)
    {

        $request = new Request($this->baseUrlEndpoint);
        $basicToken = base64_encode($username.":".$password);

        $response = $request->url(Endpoints::LOGIN)
            ->method("POST")
            ->headers([
                "Content-Type: application/json",
                "Authorization: Basic $basicToken"
            ])
            ->process([
                "new_password" => $newPassword
            ]);

        if($response["success"] && !empty($data = $response["data"] ?? null)){
            $response["data"] = [
                "token" => $data->users[0]->token,
                "expires_after" => $data->users[0]->expires_after,
            ];
        }

        return $response;
    }
}

<?php

namespace Confidence\FacebookWhatsappBusiness;

use Confidence\FacebookWhatsappBusiness\Base;
use Confidence\FacebookWhatsappBusiness\Endpoints;
use Confidence\FacebookWhatsappBusiness\Request;
use Confidence\FacebookWhatsappBusiness\Response;

class Message extends Base
{

   private $template;
   private $textBody;
   private $documentBody;
   private $audioBody;

   public function setTemplate(
      $namespace,
      $name,
      $type,
      array $params,
      array $language = [
         "policy" => "deterministic",
         "code" => "en_US"
      ]
   ) {
      $this->template = [
         "namespace" => $namespace,
         "name" => $name,
         "language" => $language,
         "components" => [
            [
               "type" => $type,
               "parameters" => $params
            ]
         ]
      ];
      return $this;
   }

   public function setTextBody($value)
   {
      $this->textBody = $value;
      return $this;
   }

   public function setDocumentBody($value)
   {
      $this->documentBody = $value;
      return $this;
   }

   public function setAudioBody($value)
   {
      $this->audioBody = $value;
      return $this;
   }


   /**
    * Log an admin into the account
    * @required string $newPassword
    */

   public function send($contact, string $message)
   {


      $request = new Request($this->baseUrlEndpoint);

      $response = $request->url(Endpoints::MESSAGES)
         ->method("POST")
         ->headers([
            "Content-Type: application/json",
            "Authorization: Bearer " . $this->authToken
         ])
         ->process([
            "to" => $contact,
            "type" => "text",
            "recipient_type" => "individual",
            "text" => [
               "body" => $message
            ]
         ]);

      if ($response["success"] && !empty($data = $response["data"] ?? null)) {
         $parsedContacts = [];
         foreach ($data->contacts as $contact) {
            $parsedContacts[] = (array) $contact;
         }
         $response["data"] = $parsedContacts;
      }

      return $response;
   }


   public function sendWithTemplate($contact)
   {


      $request = new Request($this->baseUrlEndpoint);

      $response = $request->url(Endpoints::MESSAGES)
         ->method("POST")
         ->headers([
            "Content-Type: application/json",
            "Authorization: Bearer " . $this->authToken
         ])
         ->process([
            "to" => $contact,
            "type" => "template",
            "template" => $this->template
         ]);

      if ($response["success"] && !empty($data = $response["data"] ?? null)) {
         $messageIds = [];
         foreach ($data->messages as $message) {
            $messageIds[] = (array) $message;
         }
         $response["data"] = $messageIds;
      }

      return $response;
   }
}

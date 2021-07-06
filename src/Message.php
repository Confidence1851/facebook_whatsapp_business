<?php

namespace Confidence\FacebookWhatsappBusiness;

use Confidence\FacebookWhatsappBusiness\Base;
use Confidence\FacebookWhatsappBusiness\Endpoints;
use Confidence\FacebookWhatsappBusiness\Request;
use Confidence\FacebookWhatsappBusiness\Response;

class Message extends Base
{

   private $template;
   private $templateHeader;
   private $templateBody;

   /**
    * Build a template body after setting header and body
    * @param string $namespace
    * @param string $name
    * @param array $language
    */
   public function buildTemplate(
      $namespace,
      $name,
      array $language = [
         "policy" => "deterministic",
         "code" => "en"
      ]
   ) {
      $components = [];

      if (!empty($key = $this->templateHeader)) {
         $components[] = $key;
      }

      if (!empty($key = $this->templateBody)) {
         $components[] = $key;
      }

      $this->template = [
         "namespace" => $namespace,
         "name" => $name,
         "language" => $language,
         "components" => $components
      ];
      return $this;
   }

   /**
    * Build a template body after setting header and body
    * @param string $type e.g document , image , video , audio
    * @param string $link
    * @param string $fileName
    */
   public function setTemplateHeader($type, $link , $fileName)
   {
      $this->templateHeader = [
         "type" => "header",
         "parameters" => [
            [
               "type" => $type,
               $type => [
                  "link" => $link,
                  // "provider" => [
                  //    "name" => $provider
                  // ],
                  "filename" => $fileName
               ]

            ]
         ]
      ];
      return $this;
   }

   /**
    * Build a template body after setting header and body
    * @param string $type e.g text
    * @param array $parameters
    */
   public function setTemplateBody($type, array $parameters)
   {
      $this->templateBody = [
         "type" => $type,
         "parameters" => $parameters
      ];
      return $this;
   }


   /**
    * Send non template message to a contact
    * @param string $contact
    * @param string $message
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


   /**
    * Send a template message to a contact after setting template header and body
    * @param string $contact
    */
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
      return $response;
   }
}

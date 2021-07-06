# Easier way to implent Official whatsapp business api

public function FWBLogin()
{
$baseUrl = env("FWB_BASE_URL");
      $FWB = new FWBAuth($baseUrl);
$login = $FWB->loginAdmin("admin", "oldpassword", "newpassword");

      if ($login["success"] && $login["status_code"] == 200) {
         // Login successful
      }

      // Do some stuff

}

public function FWBContacts(array $contactsList)
   {
      $baseUrl = env("FWB_BASE_URL");
      $FWBContacts = new FWBContacts($baseUrl);
$FWBContacts->setAuthToken(env("FWB_TOKEN"));
      $process = $FWBContacts->validate($contactsList, "wait", true);
return $process;
}

public function FWBSend()
{
$baseUrl = env("FWB_BASE_URL");
      $FWBMessage = new FWBMessage($baseUrl);
$FWBMessage->setAuthToken(env("FWB_TOKEN"));

      // For template text message

      // $FWBMessage->setTemplateBody(
      //    "body",
      //    [
      //       [
      //          "type" => "text",
      //          "text" => "Hello Confidence"
      //       ],
      //    ]
      // );
      // $FWBMessage->buildTemplate(
      //    "my_namespace_id",
      //    "template_name"
      // );

      // $process = $FWBMessage->sendWithTemplate("234700000000");

      // dd($process);




      // For document

      $FWBMessage->setTemplateHeader("document", "http://www.africau.edu/images/default/sample.pdf" , "Sample.pdf");
      $FWBMessage->setTemplateBody(
         "body",
         [
            [
               "type" => "text",
               "text" => "Hello Confidence"
            ]
         ]
      );

      $FWBMessage->buildTemplate(
          "my_namespace_id",
         "template_name",
      );

      $process = $FWBMessage->sendWithTemplate("234700000000");
      return $process;

}

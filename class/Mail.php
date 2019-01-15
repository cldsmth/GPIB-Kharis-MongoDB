<?php
class Mail{

  public function forget_password($link){
    $result = "<!DOCTYPE html>
      <html>
      <head>
      <title></title>
      </head>
      <body>
      <span style='font-size:12px;'><em>*This is a message from system</em></span>
      <br/><br/>
      To change your password, please click the link below.
      <br/><br/>
      Reset Password : 
      <a href='".$link."'>Click here</a>
      <br/><br/>
      <em>*Do not reply to this e-mail.<br/><br/>Thank you!</em>
      </body>
      </html>";
    return $result;
  }

}
?>
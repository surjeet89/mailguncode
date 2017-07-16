<?php

$email_to_name = 'Surjeet';
$email_to = 'xxxxxx@gmail.com';
$email_from = 'noreply@xxxxxx.com';
$email_from_name = 'Quest Agency';
$attachment = $_SERVER['DOCUMENT_ROOT'].'/images/upload.png';
$email_cc = 'xxxxx@gmail.com';
$email_cc_name = 'surjeet';

send_mail ($email_to, $subject, $message, $email_to_name , $email_from, $email_from_name, $email_cc, $email_cc_name, $email_bcc = '', $email_bcc_name = '',$attachment,$attachment_name='');

 function send_mail ($email_to, $subject, $message, $email_to_name = '', $email_from = '', $email_from_name = '', $email_cc = '', $email_cc_name = '', $email_bcc = '', $email_bcc_name = '',$attachment = '',$attachment_name = '') {
  
  $url = 'https://api.mailgun.net/v3/xxx.xxxx.xxxx/messages';  

  if(($email_cc == 'xxx@xxxx.xxxx')){
   $email_cc_name = 'xxxx';
   $email_cc = 'xxx@xxxxx.com';
  }
  
  if($email_to == "xxxxx@quest.agency"){
   $email_bcc  = "xxx@xxxxx.com"; 
   $email_bcc_name  = "sean";
  }else{
   //$email_bcc  = "surjeet@gmail.com"; 
   $email_bcc  = "surjeet@gmail.com"; 
   $email_bcc_name  = "sean"; 
  }
  
  try{
  
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
   curl_setopt($ch, CURLOPT_USERPWD, 'api:key-xxxxxxxxxxxxxxxxxxxxxxx'); 
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_URL,$url); 
   
   if(($email_cc != '') && ($attachment != '' && file_exists($attachment) && is_file($attachment))){
    curl_setopt($ch, CURLOPT_POSTFIELDS,
    array( 
    'from' => ''.$email_from_name.' '.$email_from.'',
    'to' => ''.$email_to_name.' <'.$email_to.'>',
    'cc' => ''.$email_cc_name.' <'.$email_cc.'>',
    'bcc' => ''.$email_bcc_name.' <'.$email_bcc.'>',
    'subject' => ''.$subject.'', 
    'html' => ''.$message.'', 
    'attachment[1]' => '@'.$attachment  
    )); 
   }else if($email_cc != ''){
    curl_setopt($ch, CURLOPT_POSTFIELDS,
    array( 
    'from' => ''.$email_from_name.' '.$email_from.'',
    'to' => ''.$email_to_name.' <'.$email_to.'>',
    'cc' => ''.$email_cc_name.' <'.$email_cc.'>',
    'bcc' => ''.$email_bcc_name.' <'.$email_bcc.'>',
    'subject' => ''.$subject.'', 
    'html' => ''.$message.'', 
    )); 
   }else if ( $attachment != '' && file_exists($attachment) && is_file($attachment) ) {
    
    curl_setopt($ch, CURLOPT_POSTFIELDS,
    array( 
    'from' => ''.$email_from_name.' '.$email_from.'',
    'to' => ''.$email_to_name.' <'.$email_to.'>',  
    'bcc' => ''.$email_bcc_name.' <'.$email_bcc.'>',
    'subject' => ''.$subject.'', 
    'html' => ''.$message.'', 
    'attachment[1]' => '@'.$attachment 
    )); 

   }else{
    curl_setopt($ch, CURLOPT_POSTFIELDS,
    array( 
    'from' => ''.$email_from_name.' '.$email_from.'',
    'to' => ''.$email_to_name.' <'.$email_to.'>',  
    'bcc' => ''.$email_bcc_name.' <'.$email_bcc.'>',
    'subject' => ''.$subject.'', 
    'html' => ''.$message.'', 
    )); 
   }  
   $result = curl_exec($ch);
   curl_close($ch); 
   
   return true;
   
  }catch (Exception $e){
   return true; 
  }
 
 } 
 
?>

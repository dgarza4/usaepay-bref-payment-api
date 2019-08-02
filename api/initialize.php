<?php
  // required headers
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST, GET");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  include_once '../usaepay.php';
  $tran=new umTransaction;
  $data = json_decode(file_get_contents("php://input"));

  $tran->key="sW4rZ250lRzRz5PpOlU345M8210rr1G0"; // source key
  $tran->pin="98761234"; // source key pin
  $tran->usesandbox=false; // Sandbox true/false

  // $tran->ip=$REMOTE_ADDR; // This allows fraud blocking on the customers ip address 
  $tran->testmode=1;

  $token;
?>
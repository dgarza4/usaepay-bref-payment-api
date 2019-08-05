<?php
  include_once dirname(__FILE__).'/initialize.php';

  $tran->card = $data->token;
  
  $tran->exp='0000';

  if($tran->Process()) {
    http_response_code(201);
    echo json_encode(array(
      "message" => "Card Approved",
      "Authcode" => $tran->authcode,
      "TransactionID" => $tran->refnum,
      "AVS Result" => $tran->avs_result,
    ));
  } else {
    http_response_code(503);
    echo json_encode(array(
      "message" => "Card Declined.",
      "Card" => $data->card,
      "Reason" => $tran->error,
    ));

    if(@$tran->curlerror) {
      echo json_encode(array(
        "Curl Error:" => $tran->curlerror,
      ));
    }
  }
?>
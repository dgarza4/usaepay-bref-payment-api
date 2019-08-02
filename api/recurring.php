<?php
  include_once './initialize.php';

  $tran->addcustomer='yes';
  $tran->exp='0000';
  $tran->isrecurring=true;

  $tran->card=$data->token;
  $tran->amount=$data->amount;
  $tran->invoice=$data->invoice;
  $tran->schedule=$data->schedule;
  $tran->start=$data->start; // format: 'YYYYMMDD'
  $tran->end=$data->end; // format: 'YYYYMMDD'

  if($tran->Process()) {
    http_response_code(201);
    echo json_encode(array(
      "message" => "Card Approved",
      "Authcode" => $tran->authcode,
      "AVS Result" => $tran->avs_result,
      "Customer reference number" => $tran->custnum,
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
<?php
  include_once dirname(__FILE__).'/initialize.php';

  $tran->command='cc:save';
  $tran->savecard=true;

  $tran->card=$data->card;
  $tran->exp=$data->exp;

  if($tran->Process()) {
    http_response_code(201);
    echo json_encode(array(
      "message" => "Card Approved",
      "Card" => $data->card,
      "token" => $tran->cardref,
    ));

    $token = $tran->cardref;

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
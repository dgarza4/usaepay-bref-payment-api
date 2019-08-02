<?php
  include_once './initialize.php';

  $tran->addcustomer='yes';
  $tran->exp='0000';
  $tran->isrecurring=true;


  $recurringAmount = round((float)$data->amount / $data->occurrences, 2);
  $totalAmount = $recurringAmount * $data->occurrences;
  $difference = $amount - $totalAmount;
  $initialAmount = $recurringAmount + $difference;

  $tran->card=$data->token;
  $tran->invoice=$data->invoice;
  $tran->amount = number_format($initialAmount, 2);
  $tran->billamount = number_format($recurringAmount, 2);
  $tran->numleft = $data->occurrences - 1;
  $tran->schedule = $data->interval;
  $tran->start = isset($data->start) ? $data->start : 'next';

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

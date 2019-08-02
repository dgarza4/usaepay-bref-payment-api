<?php
  include_once './initialize.php';

  if($tran->clearData()) {
    http_response_code(201);
    echo json_encode(array(
      "message" => "Cleared",
    ));
  } else {
    http_response_code(503);
    echo json_encode(array(
      "message" => $tran->error,
    ));
  }
?>
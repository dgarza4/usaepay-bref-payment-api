<?php
if (in_array($_GET['endpoint'], ['tokenize', 'splitting', 'transaction'])) {
  include './api/'.$_GET['endpoint'].'.php';
}
else {
  echo "couldn't find ./api/".$_GET['endpoint'].".php";
}
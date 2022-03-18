<?php
namespace app\helper\functions;

  function addBodyClass() {
    global $bodyID;
    if (isset($bodyID)) {
      echo "class='$bodyID'";
    } else {
      echo "class='default-body'";
    }
  }

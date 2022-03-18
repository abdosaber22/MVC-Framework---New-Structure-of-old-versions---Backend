<?php
namespace app\helper\functions;

  function title() {
    global $title;
    if (isset($title)) {
      echo $title;
    } else {
      echo 'App';
    }
  }

?>

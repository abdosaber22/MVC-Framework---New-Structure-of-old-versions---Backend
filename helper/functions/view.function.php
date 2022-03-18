<?php
namespace app\helper\functions;

  function view($d, $type = ':session')
  {
    if ($type == ':session' && isset($_SESSION[$d])) {
      echo $_SESSION[$d];
    } elseif ($type == ':cookie' && isset($_COOKIE[$d])) {
      echo $_COOKIE[$d];
    }
  }

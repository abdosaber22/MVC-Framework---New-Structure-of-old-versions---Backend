<?php
namespace app\helper\functions;

  function replace($type, $str) {
    switch($type) {
      case 'slash':
        return str_replace("\\", '/', $str);
      break;
    }
  }
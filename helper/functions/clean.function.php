<?php
namespace app\helper\functions;

  function clean($__string) {
    $__string = str_replace(' ', '', $__string);
    return preg_replace('/[^A-Za-z0-9\-]/', '', $__string);
  }

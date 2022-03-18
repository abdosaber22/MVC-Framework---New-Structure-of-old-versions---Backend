<?php
namespace app\helper\functions;

  function redirect_js($to, $after = 0)
  {
    echo "<script> setTimeout(function () { window.location.href = '$to'; }, $after); </script>";
  }

  function redirect($to)
  {
    header("Location: '$to'");
  }

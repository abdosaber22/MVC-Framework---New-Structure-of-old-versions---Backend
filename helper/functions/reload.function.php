<?php
namespace app\helper\functions;

  function reload($after = 200)
  {
    echo "<script>setTimeout(function () {  window.location.reload(); }, {$after});</script>";
  }

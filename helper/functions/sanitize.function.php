<?php
namespace app\helper\functions;

  function defaultSantitze($target)
  {
    return htmlspecialchars(strip_tags($target));
  }

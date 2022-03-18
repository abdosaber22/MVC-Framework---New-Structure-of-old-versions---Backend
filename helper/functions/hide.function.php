<?php
namespace app\helper\functions;

  function hide($element) {
    echo "<style> $element { display: none; } </style>";
  }

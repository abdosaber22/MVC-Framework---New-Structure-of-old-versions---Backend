<?php

use app\core\Response;

session_start();
session_unset();
session_destroy();

Response::redirect('/framework');
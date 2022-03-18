<?php

namespace app\helper\functions;

function message($msg, $type = 'error') {
	echo "<div class='alert alert-$type' style='background-color: #e6bebe; color: darkred' role='alert'>$msg</div>";
}

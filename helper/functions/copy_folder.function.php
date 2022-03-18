<?php
namespace app\helper\functions;

	function cp_folder($src, $dst) {
    $dir = opendir($src);
    @mkdir($dst);
    while ( $file = readdir($dir) ):
    	if (( $file != '.' ) && ( $file != '..' )) {
        if (is_dir($src . '/' . $file)):
          custom_copy($src . '/' . $file, $dst . '/' . $file);
       	else:
          copy($src . '/' . $file, $dst . '/' . $file);
        endif;
      }
		endwhile;
  	closedir($dir);
	}

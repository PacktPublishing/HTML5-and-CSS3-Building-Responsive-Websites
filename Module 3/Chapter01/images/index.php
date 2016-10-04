<?php
  $device_width = 0;
  $device_height = 0;
  $file = $_SERVER['QUERY_STRING'];

  if (file_exists($file)) {

    // Read the device viewport dimensions
    if (isset($_COOKIE['device_dimensions'])) {
      $dimensions = explode('x', $_COOKIE['device_dimensions']);
      if (count($dimensions)==2) {
        $device_width = intval($dimensions[0]);
        $device_height = intval($dimensions[1]);
      }
    }

    if ($device_width > 0) {

      $fileext = pathinfo($file, PATHINFO_EXTENSION);

      // Low resolution image
      if ($device_width <= 800) {
        $output_file = substr_replace($file, '-low', -strlen($fileext)-1, 0);
      } 

      // Medium resolution image
      else if ($device_width <= 1024) {
        $output_file = substr_replace($file, '-med', -strlen($fileext)-1, 0);
      }

      // check the file exists
      if (isset($output_file) && file_exists($output_file)) {
        $file = $output_file;
      }
    }

    // return the file;
    readfile($file);
  }

?>
<?php

  header("Content-Type: image/jpeg");
   if (isset($_GET["pDelay"]))
   {
      $preview_delay = $_GET["pDelay"];
   } else {
      $preview_delay = 10000;
   }
   usleep($preview_delay);
   $pcDebug = 0;
   if ($pcDebug == 1)
   {
     readfile("cam.jpg");
   }
   else
   {
     readfile("/dev/shm/mjpeg/cam.jpg");
   }


?>

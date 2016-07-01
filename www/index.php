<?php
define('BASE_DIR', dirname(__FILE__));
require_once(BASE_DIR.'/header.php');
?>

      <div class="container-fluid text-center liveimage">
         <div><img id="mjpeg_dest" <?php echo getLoadClass() . getImgWidth();?> <?php if(file_exists("pipan_on")) echo "ontouchstart=\"pipan_start()\""; ?> onclick="toggle_fullscreen(this);" src="./loading.jpg"></div>
         <div id="main-buttons" <?php echo $displayStyle; ?> >
            <input id="video_button" type="button" class="btn btn-primary">
            <input id="image_button" type="button" class="btn btn-primary">
            <input id="timelapse_button" type="button" class="btn btn-primary">
            <input id="md_button" type="button" class="btn btn-primary">
            <input id="halt_button" type="button" class="btn btn-danger">
         </div>
      </div>
      <div id="secondary-buttons" class="container-fluid text-center" <?php echo $displayStyle; ?> >
         <?php pan_controls(); ?>
      </div>
      <?php if ($debugString != "") echo "$debugString<br>"; ?>
   </body>
</html>

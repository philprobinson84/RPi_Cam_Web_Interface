<!DOCTYPE html>
<?php
   $config = array();
   $debugString = "";

   $options_mm = array('Average' => 'average', 'Spot' => 'spot', 'Backlit' => 'backlit', 'Matrix' => 'matrix');
   $options_em = array('Off' => 'off', 'Auto' => 'auto', 'Night' => 'night', 'Nightpreview' => 'nightpreview', 'Backlight' => 'backlight', 'Spotlight' => 'spotlight', 'Sports' => 'sports', 'Snow' => 'snow', 'Beach' => 'beach', 'Verylong' => 'verylong', 'Fixedfps' => 'fixedfps');
   $options_wb = array('Off' => 'off', 'Auto' => 'auto', 'Sun' => 'sun', 'Cloudy' => 'cloudy', 'Shade' => 'shade', 'Tungsten' => 'tungsten', 'Fluorescent' => 'fluorescent', 'Incandescent' => 'incandescent', 'Flash' => 'flash', 'Horizon' => 'horizon');
//   $options_ie = array('None' => 'none', 'Negative' => 'negative', 'Solarise' => 'solarise', 'Sketch' => 'sketch', 'Denoise' => 'denoise', 'Emboss' => 'emboss', 'Oilpaint' => 'oilpaint', 'Hatch' => 'hatch', 'Gpen' => 'gpen', 'Pastel' => 'pastel', 'Watercolour' => 'watercolour', 'Film' => 'film', 'Blur' => 'blur', 'Saturation' => 'saturation', 'Colourswap' => 'colourswap', 'Washedout' => 'washedout', 'Posterise' => 'posterise', 'Colourpoint' => 'colourpoint', 'ColourBalance' => 'colourbalance', 'Cartoon' => 'cartoon');
// Remove Colourpoint and colourbalance as they kill the camera
   $options_ie = array('None' => 'none', 'Negative' => 'negative', 'Solarise' => 'solarise', 'Sketch' => 'sketch', 'Denoise' => 'denoise', 'Emboss' => 'emboss', 'Oilpaint' => 'oilpaint', 'Hatch' => 'hatch', 'Gpen' => 'gpen', 'Pastel' => 'pastel', 'Watercolour' => 'watercolour', 'Film' => 'film', 'Blur' => 'blur', 'Saturation' => 'saturation', 'Colourswap' => 'colourswap', 'Washedout' => 'washedout', 'Posterise' => 'posterise', 'Cartoon' => 'cartoon');
   $options_ce_en = array('Disabled' => '0', 'Enabled' => '1');
   $options_ro = array('No rotate' => '0', 'Rotate_90' => '90', 'Rotate_180' => '180', 'Rotate_270' => '270');
   $options_fl = array('None' => '0', 'Horizontal' => '1', 'Vertical' => '2', 'Both' => '3');
   $options_bo = array('Off' => '0', 'Background' => '2');
   $options_av = array('V2' => '2', 'V3' => '3');
   $options_at_en = array('Disabled' => '0', 'Enabled' => '1');
   $options_ac_en = array('Disabled' => '0', 'Enabled' => '1');
   $options_ab = array('Off' => '0', 'On' => '1');
   $options_vs = array('Off' => '0', 'On' => '1');
   $options_rl = array('Off' => '0', 'On' => '1');
   $options_vp = array('Off' => '0', 'On' => '1');
   $options_mx = array('Internal' => '0', 'External' => '1');
   $options_mf = array('Off' => '0', 'On' => '1');
   $options_cn = array('First' => '1', 'Second' => '2');
   $options_st = array('Off' => '0', 'On' => '1');

   function initCamPos() {
      $tr = fopen("pipan_bak.txt", "r");
      if($tr){
         while(($line = fgets($tr)) != false) {
           $vals = explode(" ", $line);
           echo '<script type="text/javascript">init_pt(',$vals[0],',',$vals[1],');</script>';
         }
         fclose($tr);
      }
   }

   function pan_controls() {
      $mode = 0;
      if (file_exists("pipan_on")){
         initCamPos();
         $mode = 1;
      } else if (file_exists("servo_on")){
         $mode = 2;
      }
      if ($mode <> 0) {
         echo '<script type="text/javascript">set_panmode(',$mode,');</script>';
         echo "<div class='container-fluid text-center liveimage'>";
         echo "<div alt='Up' id='arrowUp' style='margin-bottom: 2px;width: 0;height: 0;border-left: 20px solid transparent;border-right: 20px solid transparent;border-bottom: 40px solid #428bca;font-size: 0;line-height: 0;vertical-align: middle;margin-left: auto; margin-right: auto;' onclick='servo_up();'></div>";
         echo "<div>";
         echo "<div alt='Left' id='arrowLeft' style='margin-right: 22px;display: inline-block;height: 0;border-top: 20px solid transparent;border-bottom: 20px solid transparent;border-right: 40px solid #428bca;font-size: 0;line-height: 0;vertical-align: middle;' onclick='servo_left();'></div>";
         echo "<div alt='Right' id='arrowRight' style='margin-left: 22px;display: inline-block;height: 0;border-top: 20px solid transparent;border-bottom: 20px solid transparent;border-left: 40px solid #428bca;font-size: 0;line-height: 0;vertical-align: middle;' onclick='servo_right();'></div>";
         echo "</div>";
         echo "<div alt='Down' id='arrowDown' style='margin-top: 2px;width: 0;height: 0;border-left: 20px solid transparent;border-right: 20px solid transparent;border-top: 40px solid #428bca;font-size: 0;line-height: 0;vertical-align: middle;margin-left: auto; margin-right: auto;' onclick='servo_down();'></div>";
         echo "</div>";
      }
   }

   function pilight_controls() {
      echo "<tr>";
        echo "<td>Pi-Light:</td>";
        echo "<td>";
          echo "R: <input type='text' size=4 id='pilight_r' value='255'>";
          echo "G: <input type='text' size=4 id='pilight_g' value='255'>";
          echo "B: <input type='text' size=4 id='pilight_b' value='255'><br>";
          echo "<input type='button' value='ON/OFF' onclick='led_switch();'>";
        echo "</td>";
      echo "</tr>";
   }

   function getExtraStyles() {
      $files = scandir('css');
      foreach($files as $file) {
         if(substr($file,0,3) == 'es_') {
            echo "<option value='$file'>" . substr($file,3, -4) . '</option>';
         }
      }
   }


   function makeOptions($options, $selKey) {
      global $config;
      switch ($selKey) {
         case 'flip':
            $cvalue = (($config['vflip'] == 'true') || ($config['vflip'] == 1) ? 2:0);
            $cvalue += (($config['hflip'] == 'true') || ($config['hflip'] == 1) ? 1:0);
            break;
         case 'MP4Box':
            $cvalue = $config[$selKey];
            if ($cvalue == 'background') $cvalue = 2;
            break;
         default: $cvalue = $config[$selKey]; break;
      }
      if ($cvalue == 'false') $cvalue = 0;
      else if ($cvalue == 'true') $cvalue = 1;
      foreach($options as $name => $value) {
         if ($cvalue != $value) {
            $selected = '';
         } else {
            $selected = ' selected';
         }
         echo "<option value='$value'$selected>$name</option>";
      }
   }

   function makeInput($id, $size, $selKey='') {
      global $config, $debugString;
      if ($selKey == '') $selKey = $id;
      switch ($selKey) {
         case 'tl_interval':
            if (array_key_exists($selKey, $config)) {
               $value = $config[$selKey] / 10;
            } else {
               $value = 3;
            }
            break;
         case 'watchdog_interval':
            if (array_key_exists($selKey, $config)) {
               $value = $config[$selKey] / 10;
            } else {
               $value = 0;
            }
            break;
         default: $value = $config[$selKey]; break;
      }
      echo "<input type='text' class='form-control' size=$size id='$id' value='$value'>";
   }

   function getImgWidth() {
      global $config;
      if($config['vector_preview'])
         return 'style="width:' . $config['width'] . 'px;"';
      else
         return '';
   }

   function getLoadClass() {
      global $config;
      if(array_key_exists('fullscreen', $config) && $config['fullscreen'] == 1)
         return 'class="fullscreen" ';
      else
         return '';
   }

   if (isset($_POST['extrastyle'])) {
      if (file_exists('css/' . $_POST['extrastyle'])) {
         $fp = fopen(BASE_DIR . '/css/extrastyle.txt', "w");
         fwrite($fp, $_POST['extrastyle']);
         fclose($fp);
      }
   }

   $toggleButton = "Simple";
   $displayStyle = 'style="display:block;"';
   if(isset($_COOKIE["display_mode"])) {
      if($_COOKIE["display_mode"] == "Simple") {
         $toggleButton = "Full";
         $displayStyle = 'style="display:none;"';
      }
   }

   $streamButton = "MJPEG-Stream";
   $mjpegmode = 0;
   if(isset($_COOKIE["stream_mode"])) {
      if($_COOKIE["stream_mode"] == "MJPEG-Stream") {
         $streamButton = "Default-Stream";
         $mjpegmode = 1;
      }
   }
   $config = readConfig($config, CONFIG_FILE1);
   $config = readConfig($config, CONFIG_FILE2);
   $video_fps = $config['video_fps'];
   $divider = $config['divider'];
  ?>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
      <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />

      <!-- iOS home screen application support -->
      <link rel="apple-touch-icon" href="apple-touch-icon.png">
      <link rel="apple-touch-startup-image" href="startup.png">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="apple-mobile-web-app-title" content="SmartCam">
      <meta name="apple-mobile-web-app-status-bar-style" content="black">
      <script>
      (function(document,navigator,standalone) {
        // prevents links from apps from oppening in mobile safari
        // this javascript must be the first script in your <head>
        if ((standalone in navigator) && navigator[standalone]) {
          var curnode, location=document.location, stop=/^(a|html)$/i;
          document.addEventListener('click', function(e) {
            curnode=e.target;
            while (!(stop).test(curnode.nodeName)) {
              curnode=curnode.parentNode;
            }
            // Conditions to do this only on links to your own app
            // if you want all links, use if('href' in curnode) instead.
            if('href' in curnode && ( curnode.href.indexOf('http') || ~curnode.href.indexOf(location.host) ) ) {
              e.preventDefault();
              location.href = curnode.href;
            }
          },false);
        }
      })(document,window.navigator,'standalone');
      </script>

      <!-- Android / Chrome home screen application support -->
      <link rel="manifest" href="manifest.json">
      <meta name="mobile-web-app-capable" content="yes">

      <title><?php echo CAM_STRING; ?></title>
      <link rel="stylesheet" href="css/style_minified.css" />
      <link rel="stylesheet" href="css/preview.css" />
      <link rel="stylesheet" href="<?php echo getStyle(); ?>" />
      <script src="js/style_minified.js"></script>
      <script src="js/script.js"></script>
      <script src="js/pipan.js"></script>
      <script src="js/preview.js"></script>
      <?php if (isset($thumbnails)):?>
      <script>
         var thumbnails = <?php echo json_encode($thumbnails) ?>;
         var linksBase = 'preview.php?preview=';
         var mediaBase = "<?php echo MEDIA_PATH . '/' ?>";
         var previewWidth = <?php echo $previewSize ?>;
         var convertCmd = "<?php echo file_get_contents(BASE_DIR . '/' . CONVERT_CMD) ?>";
      </script>
    <?php endif;?>
   </head>
   <?php
   $onloadString = "";
switch ($thisPage)
{
  case "schedule.php":
    $onloadString = "schedule_rows()";
    break;
  case "index.php":
    $onloadString = "setTimeout('init($mjpegmode, $video_fps, $divider)', 100)";
    break;
}
   ?>
   <body onload="<?php echo $onloadString;?>">

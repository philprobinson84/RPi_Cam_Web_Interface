<?php
define('BASE_DIR', dirname(__FILE__));
require_once(BASE_DIR.'/config.php');
$thisPage = "settings.php";
require_once(BASE_DIR.'/header.php');
require_once(BASE_DIR.'/menu.php');
?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
             <div class="panel-group">
                <div class="panel panel-default">
                   <div class="panel-heading">
                      <h2 class="panel-title">
                         Camera Settings
                      </h2>
                   </div>
                   <div class="panel-collapse">
                      <div class="panel-body">
                         <table class="table table-bordered table-striped">
                            <tr>
                              <th>Resolutions:</th>
                              <td>
                                <form>
                                  <div class="form-group">
                                    <label for="selectPreset">Load Preset</label>
                                    <select class="form-control" id="selectPreset" onchange="set_preset(this.value)">
                                       <option value="1920 1080 25 25 2592 1944">Select option...</option>
                                       <option value="1920 1080 25 25 2592 1944">Full HD 1080p 16:9</option>
                                       <option value="1280 0720 25 25 2592 1944">HD-ready 720p 16:9</option>
                                       <option value="1296 972 25 25 2592 1944">Max View 972p 4:3</option>
                                       <option value="768 576 25 25 2592 1944">SD TV 576p 4:3</option>
                                       <option value="1920 1080 01 30 2592 1944">Full HD Timelapse (x30) 1080p 16:9</option>
                                    </select>
                                  </div>
                                  <hr>
                                  <div class="form-group">
                                    <label for="selectPreset">Custom Values</label>
                                  </div>
                                </form>
                                <form class="form-inline">
                                  <div class="form-group">
                                    <label for="video_width">Video res: </label>
                                    <?php makeInput('video_width', 4); ?>
                                  </div>
                                  <div class="form-group">
                                    <label for="video_height">x</label>
                                    <?php makeInput('video_height', 4); ?>
                                    <label for="video_height">px</label>
                                  </div>
                                </form>
                                <form class="form-inline">
                                  <div class="form-group">
                                    <label for="video_fps">Image res: </label>
                                    <?php makeInput('video_fps', 2); ?>
                                  </div>
                                  <div class="form-group">
                                    <label for="MP4Box_fps">recording, </label>
                                    <?php makeInput('MP4Box_fps', 2); ?>
                                    <label for="MP4Box_fps">boxing</label>
                                  </div>
                                </form>
                                <form class="form-inline">
                                  <div class="form-group">
                                    <label for="image_width">Video fps: </label>
                                    <?php makeInput('image_width', 4); ?>
                                  </div>
                                  <div class="form-group">
                                    <label for="image_height">x</label>
                                    <?php makeInput('image_height', 4); ?>
                                    <label for="image_height">px</label>
                                  </div>
                                </form>
                                <input type="button" class="btn btn-default" value="OK" onclick="set_res();">
                               </td>
                            </tr>
                            <?php  if($config['camera_num'] > 0): ?>
                            <tr>
                               <th>Camera select (Compute module only)</th>
                               <td>
                                  Use camera: <select class="form-control" onchange="send_cmd('cn ' + this.value)"><?php makeOptions($options_cn, 'camera_num'); ?></select>
                               </td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                               <th>Timelapse-Interval (0.1...3200):</th>
                               <td><?php makeInput('tl_interval', 4); ?>s <input type="button" value="OK" onclick="send_cmd('tv ' + 10 * document.getElementById('tl_interval').value)"></td>
                            </tr>
                            <tr>
                               <th>Annotation (max 127 characters):</th>
                               <td>
                                  Text: <?php makeInput('annotation', 20); ?><input type="button" value="OK" onclick="send_cmd('an ' + encodeURI(document.getElementById('annotation').value))"><input type="button" value="Default" onclick="document.getElementById('annotation').value = 'RPi Cam %Y.%M.%D_%h:%m:%s'; send_cmd('an ' + encodeURI(document.getElementById('annotation').value))"><br>
                                  Background: <select class="form-control" onchange="send_cmd('ab ' + this.value)"><?php makeOptions($options_ab, 'anno_background'); ?></select>
                               </td>
                            </tr>
                            <?php if (file_exists("pilight_on")) pilight_controls(); ?>
                            <tr>
                               <th>Buffer (1000... ms), default 0:</th>
                               <td><?php makeInput('video_buffer', 4); ?><input type="button" value="OK" onclick="send_cmd('bu ' + document.getElementById('video_buffer').value)"></td>
                            </tr>                        <tr>
                               <th>Sharpness (-100...100), default 0:</th>
                               <td><?php makeInput('sharpness', 4); ?><input type="button" value="OK" onclick="send_cmd('sh ' + document.getElementById('sharpness').value)"></td>
                            </tr>
                            <tr>
                               <th>Contrast (-100...100), default 0:</th>
                               <td><?php makeInput('contrast', 4); ?><input type="button" value="OK" onclick="send_cmd('co ' + document.getElementById('contrast').value)">
                               </td>
                            </tr>
                            <tr>
                               <th>Brightness (0...100), default 50:</th>
                               <td><?php makeInput('brightness', 4); ?><input type="button" value="OK" onclick="send_cmd('br ' + document.getElementById('brightness').value)"></td>
                            </tr>
                            <tr>
                               <th>Saturation (-100...100), default 0:</th>
                               <td><?php makeInput('saturation', 4); ?><input type="button" value="OK" onclick="send_cmd('sa ' + document.getElementById('saturation').value)"></td>
                            </tr>
                            <tr>
                               <th>ISO (100...800), default 0:</th>
                               <td><?php makeInput('iso', 4); ?><input type="button" value="OK" onclick="send_cmd('is ' + document.getElementById('iso').value)"></td>
                            </tr>
                            <tr>
                               <th>Metering Mode, default 'average':</th>
                               <td><select class="form-control" onchange="send_cmd('mm ' + this.value)"><?php makeOptions($options_mm, 'metering_mode'); ?></select></td>
                            </tr>
                            <tr>
                               <th>Video Stabilisation, default: 'off'</th>
                               <td><select class="form-control" onchange="send_cmd('vs ' + this.value)"><?php makeOptions($options_vs, 'video_stabilisation'); ?></select></td>
                            </tr>
                            <tr>
                               <th>Exposure Compensation (-10...10), default 0:</th>
                               <td><?php makeInput('exposure_compensation', 4); ?><input type="button" value="OK" onclick="send_cmd('ec ' + document.getElementById('exposure_compensation').value)"></td>
                            </tr>
                            <tr>
                               <th>Exposure Mode, default 'auto':</th>
                               <td><select class="form-control" onchange="send_cmd('em ' + this.value)"><?php makeOptions($options_em, 'exposure_mode'); ?></select></td>
                            </tr>
                            <tr>
                               <th>White Balance, default 'auto':</th>
                               <td><select class="form-control" onchange="send_cmd('wb ' + this.value)"><?php makeOptions($options_wb, 'white_balance'); ?></select></td>
                            </tr>
                            <tr>
                               <th>White Balance Gains (x100):</th>
                               <td> gain_r <?php makeInput('ag_r', 4, 'autowbgain_r'); ?> gain_b <?php makeInput('ag_b', 4, 'autowbgain_b'); ?>
                                  <input type="button" value="OK" onclick="set_ag();">
                               </td>
                            </tr>
                            <tr>
                               <th>Image Effect, default 'none':</th>
                               <td><select class="form-control" onchange="send_cmd('ie ' + this.value)"><?php makeOptions($options_ie, 'image_effect'); ?></select></td>
                            </tr>
                            <tr>
                               <th>Colour Effect, default 'disabled':</th>
                               <td><select class="form-control" id="ce_en"><?php makeOptions($options_ce_en, 'colour_effect_en'); ?></select>
                                  u:v = <?php makeInput('ce_u', 4, 'colour_effect_u'); ?>:<?php makeInput('ce_v', 4, 'colour_effect_v'); ?>
                                  <input type="button" value="OK" onclick="set_ce();">
                               </td>
                            </tr>
                            <tr>
                               <th>Image Statistics, default 'Off':</th>
                               <td><select class="form-control" onchange="send_cmd('st ' + this.value)"><?php makeOptions($options_st, 'stat_pass'); ?></select></td>
                            </tr>
                            <tr>
                               <th>Rotation, default 0:</th>
                               <td><select class="form-control" onchange="send_cmd('ro ' + this.value)"><?php makeOptions($options_ro, 'rotation'); ?></select></td>
                            </tr>
                            <tr>
                               <th>Flip, default 'none':</th>
                               <td><select class="form-control" onchange="send_cmd('fl ' + this.value)"><?php makeOptions($options_fl, 'flip'); ?></select></td>
                            </tr>
                            <tr>
                               <th>Sensor Region, default 0/0/65536/65536:</th>
                               <td>
                                  x<?php makeInput('roi_x', 5, 'sensor_region_x'); ?> y<?php makeInput('roi_y', 5, 'sensor_region_y'); ?> w<?php makeInput('roi_w', 5, 'sensor_region_w'); ?> h<?php makeInput('roi_h', 4, 'sensor_region_h'); ?> <input type="button" value="OK" onclick="set_roi();">
                               </td>
                            </tr>
                            <tr>
                               <th>Shutter speed (0...330000), default 0:</th>
                               <td><?php makeInput('shutter_speed', 4); ?><input type="button" value="OK" onclick="send_cmd('ss ' + document.getElementById('shutter_speed').value)">
                               </td>
                            </tr>
                            <tr>
                               <th>Image quality (0...100), default 10:</th>
                               <td>
                                  <?php makeInput('image_quality', 4); ?><input type="button" value="OK" onclick="send_cmd('qu ' + document.getElementById('image_quality').value)">
                               </td>
                            </tr>
                            <tr>
                               <th>Preview quality (1...100) Default 10:<br>Width (128...1024) Default 512:<br>Divider (1-16) Default 1:</th>
                               <td>
                                  Qu: <?php makeInput('quality', 4); ?>
                                  Wi: <?php makeInput('width', 4); ?>
                                  Di: <?php makeInput('divider', 4); ?>
                                  <input type="button" value="OK" onclick="set_preview();">
                               </td>
                            </tr>
                            <tr>
                               <th>Raw Layer, default: 'off'</th>
                               <td><select class="form-control" onchange="send_cmd('rl ' + this.value)"><?php makeOptions($options_rl, 'raw_layer'); ?></select></td>
                            </tr>
                            <tr>
                               <th>Video bitrate (0...25000000), default 17000000:</th>
                               <td>
                                  <?php makeInput('video_bitrate', 10); ?><input type="button" value="OK" onclick="send_cmd('bi ' + document.getElementById('video_bitrate').value)">
                               </td>
                            </tr>
                            <tr>
                               <th>MP4 Boxing mode :</th>
                               <td><select class="form-control" onchange="send_cmd('bo ' + this.value)"><?php makeOptions($options_bo, 'MP4Box'); ?></select></td>
                            </tr>
                            <tr>
                               <th>Annotation size(0-99):</th>
                               <td>
                                  <?php makeInput('anno_text_size', 3); ?><input type="button" value="OK" onclick="send_cmd('as ' + document.getElementById('anno_text_size').value)">
                               </td>
                            </tr>
                            <tr>
                               <th>Custom text color:</th>
                               <td><select  class="form-control" id="at_en"><?php makeOptions($options_at_en, 'anno3_custom_text_colour'); ?></select>
                                  y:u:v = <?php makeInput('at_y', 3, 'anno3_custom_text_Y'); ?>:<?php makeInput('at_u', 4, 'anno3_custom_text_U'); ?>:<?php makeInput('at_v', 4, 'anno3_custom_text_V'); ?>
                                  <input type="button" value="OK" onclick="set_at();">
                               </td>
                            </tr>
                            <tr>
                               <th>Custom background color:</th>
                               <td><select  class="form-control" id="ac_en"><?php makeOptions($options_ac_en, 'anno3_custom_background_colour'); ?></select>
                                  y:u:v = <?php makeInput('ac_y', 3, 'anno3_custom_background_Y'); ?>:<?php makeInput('ac_u', 4, 'anno3_custom_background_U'); ?>:<?php makeInput('ac_v', 4, 'anno3_custom_background_V'); ?>
                                  <input type="button" value="OK" onclick="set_ac();">
                               </td>
                               </tr>
                            <tr>
                               <th>Watchdog, default interval 3s, errors 3</th>
                               <td>Interval <?php makeInput('watchdog_interval', 3); ?>s&nbsp;&nbsp;&nbsp;&nbsp;Errors <?php makeInput('watchdog_errors', 3); ?>
                               <input type="button" value="OK" onclick="send_cmd('wd ' + 10 * document.getElementById('watchdog_interval').value + ' ' + document.getElementById('watchdog_errors').value)">
                               </td>
                            </tr>
                            <tr>
                               <th>Motion detect mode :</th>
                               <td><select class="form-control" onchange="send_cmd('mx ' + this.value);setTimeout(function(){location.reload(true);}, 1000);"><?php makeOptions($options_mx, 'motion_external'); ?></select></td>
                            </tr>
                         </table>
                      </div>
                   </div>
                </div>
             </div>
           </div>
         </div>
      </div>
      <?php if ($debugString != "") echo "$debugString<br>"; ?>
   </body>
</html>

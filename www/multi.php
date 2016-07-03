<?php
define('BASE_DIR', dirname(__FILE__));
require_once(BASE_DIR.'/config.php');
$thisPage = "multi.php";
require_once(BASE_DIR.'/header.php');
?>

    <div class="container-fluid full-size">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 full-size">
          <div class="h_iframe">
            <iframe width="2" height="2" src="http://sanamu.co.uk:80" frameborder="0" allowfullscreen="" scrolling="no"></iframe>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 full-size">
          <div class="h_iframe">
            <iframe width="2" height="2" src="http://sanamu.co.uk:81" frameborder="0" allowfullscreen="" scrolling="no"></iframe>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 full-size">
          <div class="h_iframe">
            <iframe width="2" height="2" src="http://sanamu.co.uk:82" frameborder="0" allowfullscreen="" scrolling="no"></iframe>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 full-size">
          <div class="h_iframe">
            <iframe width="2" height="2" src="http://sanamu.co.uk:83" frameborder="0" allowfullscreen="" scrolling="no"></iframe>
          </div>
        </div>
      </div>
    </div>
  <?php if ($debugString != "") echo "$debugString<br>"; ?>
  </body>
</html>

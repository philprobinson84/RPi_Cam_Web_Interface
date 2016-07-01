<div class="navbar navbar-default navbar-fixed-top" role="navigation">
   <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><?php echo CAM_STRING; ?></a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="preview.php"><span class="glyphicon glyphicon-eye-open"></span> Browse</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><p class="navbar-btn"><a type="button" href="settings.php" class="btn btn-default"><span class="glyphicon glyphicon-camera"></span> Camera</a></p></li>
              <li><p class="navbar-btn"><a type="button" href="motion.php" class="btn btn-default"><span class="glyphicon glyphicon-user"></span> Motion</a></p></li>
              <li><p class="navbar-btn"><a type="button" href="schedule.php" class="btn btn-default"><span class="glyphicon glyphicon-time"></span> Schedule</a></p></li>
              <li role="separator" class="divider"></li>
              <li><p class="navbar-btn"><a id="reset_button" type="button" onclick="send_cmd('rs 1');setTimeout(function(){location.reload(true);}, 1000);" class="btn btn-warning"><span class="glyphicon glyphicon-warning-sign"></span> Reset Settings</a></p></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Power <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><p class="navbar-btn"><a id="shutdown_button" type="button" onclick="sys_shutdown();" class="nav-btn btn btn-danger"><span class='glyphicon glyphicon-off'></span> Shutdown</a></p></li>
              <li><p class="navbar-btn"><a id="reboot_button" type="button" onclick="sys_reboot();" class="btn btn-danger"><span class="glyphicon glyphicon-repeat"></span> Reboot</a></p></li>
            </ul>
          </li>
        </ul>
      </div>
   </div>
</div>

<style type="text/css">
  kbd.notification{
   background-color: red;
   position: absolute;right: -2px;
   top: 3px;
  }
  @media (max-width: 768px) {
    kbd.notification{
      position: relative;
     bottom: 5px;
    }
  }
}
</style>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php">Annayat Traders</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">

      <li><a href="notifications.php"><i class="fa fa-globe fa-fw"></i> Notifications
          <?php
            if($currType=='booking'){
              $q="select count(*) from bookings where employee='$currUsername' AND status=0";
            }
            else if($currType=='supplier')
            {
              $q="select count(*) from supplies where employee='$currUsername' AND status=0";
            }
              $r=mysqli_query($con,$q);
              $row=mysqli_fetch_array($r);
              if($row[0]>0 && $row[0]<9)
                echo "<kbd class='notification'>".$row[0]."</kbd>";
              else if($row[0]>9)
                echo "<kbd class='notification'>9+</kbd>";
          ?>
      </a></li>

      <li><a href="employee_profile.php"><i class="fa fa-user fa-fw"></i> Profile</a></li>

      <li><a href="logout.php"><i class="fa fa-fw fa-power-off"></i>  Log Out</a></li>

      </ul>
    </div>
  </div>
</nav>
<div style="position: fixed;left: 10px;bottom: 10px;padding: 10px;background: #101010;color: white;border-radius: 10px;cursor: pointer;">
  <h4>Employee : <?php echo $currUsername?></h4>
</div>
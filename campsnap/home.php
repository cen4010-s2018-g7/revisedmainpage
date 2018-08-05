<?php

session_start();
 
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html>

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta author="Group 7">
    <title>CampSnap - Posts</title>

    <link rel='stylesheet' href='http://codepen.io/assets/libs/fullpage/jquery-ui.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" type="text/css">

  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <a href = "http://www.fau.edu"> <img class = "img-responsive" src = "images/logo.jpg" alt="FAU Logo" style="height: 100px; width: 175px; display:inline-block"></a>
            <p class="navbar-brand" > <i class="fas fa-camera-retro small-logo"></i><span style ="font-weight:bold">CampSnap</span><i class="fas fa-id-badge small-logo"></i></p>
          </div>
          <div class="float-right">
          <a href="logout.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-danger">Log Out</button></a>
          <br>
          <p>Logged In As: <?php echo $_SESSION['username']; ?></p>
        </div>
      </nav>

    <div class="jumbotron">
      <h1 class="display-4">Welcome To CampSnap</h1>
      <p class="lead">We are a service dedicated to help make everyones lives at FAU a little better. If you see a problem around campus simply make a report about it
      using our service. You'll be able to see comments from fellow students or even faculty! It will be updated in real time once the issue has been resolved so keep
      checking back to see the status.</p>
      <hr class="my-4">
      <div class="float-mid">
        <p class="lead">
          <a class="btn btn-primary btn-lg" href="create-report.php" role="button">Make A Report</a>
        </p>
      </div>
    </div>
    <div class="container-fluid bckgrnd">
      <br/>
      <h1 class="float-mid">Issues In Progress</h1>
      <hr class="my-4">
 

<?php
include 'Db.php';
$d = Db::getReports();
while($row = mysqli_fetch_array($d))
{
$img = base64_encode( $row['photo'] );
$loc = $row['name'];
$desc = $row['description'];
$rId = $row['id'];
echo <<<EOT

      <div class="card" >
        <div class="img-container">
          <img class="img" src="data:image/jpeg;base64,$img" alt="Card image cap">
        </div>
        <div class="card-body">
          <h5 class="card-title">Area: $loc</h5>
          <p class="card-text">$desc</p>
          <a href="report.php?id=$rId" class="btn btn-primary">View Status</a>
        </div>
      </div>
      <br/>
EOT;
}
?>

     <br/>
    <br/>
   </div>

    <script src='http://codepen.io/assets/libs/fullpage/jquery_and_jqueryui.js'></script>

  </body>

</html>

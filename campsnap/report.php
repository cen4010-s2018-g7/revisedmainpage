<?php

session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}

include 'Db.php';
$r = Db::getReportById($_GET["id"]);
$reportid = $r['id'];
$img = base64_encode( $r['photo'] );
$desc = $r['description'];
$loc = $r['name'];
$status = $r['status'];
$created = $r['created'];

?>
<!DOCTYPE html>
<html>

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta author="Group 7">
    <title>CampSnap - Status</title>

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
            <p class="navbar-brand"><i class="fas fa-camera-retro small-logo"></i> <span style ="font-weight:bold">CampSnap</span><i class="fas fa-id-badge small-logo"></i></p>
          </div>
          <div class="float-right">
          <a href="logout.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-danger">Log Out</button></a>
          <br>
          <p>Logged In As: <?php echo $_SESSION['username']; ?></p>
          <p><a href="home.php">HOME</a></p>
        </div>
       </div>
      </nav>

    <div class="container-fluid bckgrnd">
      <br/>
      <h1 class="float-mid"><?php echo $desc; ?></h1>
      <hr class="my-4">
      <div class="card" >
        <div class="img-container">
          <img class="img" src="data:image/jpeg;base64,<?php echo $img; ?>" alt="Card image cap">
        </div>
        <div class="card-body">
          <ul>
            <li><b>Description:</b> <?php echo $desc; ?></li>
            <li><b>Posted on:</b> <?php echo $created; ?> </li>
            <li><b>Status:</b> <?php echo $status; ?></li>
            <li><b>Location:</b> <?php echo $loc; ?></li>
          </ul>
          <hr class="my-4">
          <h3>Comments</h3>

<?php 

$c = Db::getReportCommentsById($_GET["id"]);
while($row = mysqli_fetch_array($c))
{

echo "<p>";
echo $row['comment'];
echo " -- from ";
echo "<i>";
echo $row['username'];
echo "</i>";
echo "</p>";

}

?>




          <div>
            <form method="POST" action="create-comment.php">
              <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea name="createcomment" class="form-control" rows="5" id="comment" placeholder="Make A Comment"></textarea>
                <input id="reportid" name="reportid" type="hidden" value="<?php echo $_GET["id"]; ?>"/>
                <br>
                <button class="btn btn-primary" type="submit" name="comment-submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
          <br/>
          <br/>
         <br/>
        <br/>
        <br/>
       <br/>
       <br/>
      <br/>
      <br/>
     <br/>
     <br/>
    <br/>
   </div>

    <script src='http://codepen.io/assets/libs/fullpage/jquery_and_jqueryui.js'></script>

  </body>

</html>

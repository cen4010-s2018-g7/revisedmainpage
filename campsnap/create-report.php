<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}

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
    <title>CampSnap - Create Report</title>

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
      <br>
        <br>
        <br>
        <br>
      <br>
      <div class="jumbotron">
        <h1 class="display-4">Create A Report</h1>
        <form method="POST" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleSelect1">Location</label>
            <select class="form-control" id="exampleSelect1" name="location">
              <option selected disabled>Choose Campus Location</option>


<?php
include 'Db.php';
$d = Db::getLocations();
while($row = mysqli_fetch_array($d))
{
  echo "<option value=\"".$row['id']."\">".$row['name']."</option>";
}

?>

            </select>
          </div>
          <div class="form-group">
            <label for="exampleTextarea">Description</label>
            <textarea class="form-control" id="exampleTextarea" rows="3" name="description"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Upload Image</label>
            <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name="image">
          </div>
          <div class="float-mid">
            <p class="lead">
              <button class="btn btn-primary btn-lg" type="submit" name="upload">Submit</button>
            </p>
          </div>
        </form>

<?php
  //include 'Db.php';

  if (isset($_POST['upload'])) {
        $image = addslashes (file_get_contents($_FILES['image']['tmp_name']));
        $locationid = (int) $_POST["location"];
        $description = $_POST["description"];
        Db::addReport($locationid, $description, $image);
        echo "Report Added <a href=\"home.php\">See Reports</a>";
  }
?>

        <hr class="my-4">
      </div>
    <script src='http://codepen.io/assets/libs/fullpage/jquery_and_jqueryui.js'></script>

  </body>

</html>

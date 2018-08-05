<?php

include 'Db.php';

session_start();

if(isset($_SESSION['username'])){
  header("location: home.php");
  exit;
}


$username = $password = "";
$username_err = $password_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    if(empty($username_err) && empty($password_err)){
        
        $li = Db::login($username, $password);
        if (!isset($li))
        {
             $username_err = 'No account found with that username and password';
        }
        else{
            
            session_start();
            $_SESSION['username'] = $li['username'];
            $_SESSION['firstname'] = $li['firstname'];
            $_SESSION['admin'] = $li['admin'];
            $_SESSION['userid'] = $li['id'];
            header("location: home.php");
        }
        
    }
    
}
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>CampSnap - Log-in</title>

  <link rel='stylesheet' href='http://codepen.io/assets/libs/fullpage/jquery-ui.css'>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>

<body>

  <div class="login-card">
    <p class="camp-snap-logo"><i class="fas fa-camera-retro logo-icons"></i><span class="camp-snap-title">CampSnap</span><i class="fas fa-id-badge logo-icons"></i>
    <h1>Log-in</h1><br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="text" name="username" placeholder="Username">
      <div><?php echo $username_err; ?></div>
    <input type="password" name="password" placeholder="Password">
     <div><?php echo $password_err; ?></div>
    <input type="submit" name="login" class="login login-submit" value="Login">
  </form>

  <div class="login-help">
    <a href="#">Register</a> • <a href="#">Forgot Password</a>
  </div>
</div>

  <script src='http://codepen.io/assets/libs/fullpage/jquery_and_jqueryui.js'></script>

</body>

</html>

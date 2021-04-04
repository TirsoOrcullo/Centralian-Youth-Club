<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    include_once("connections/connections.php");
    $con = connections();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
      <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <title>Centralian Youth Club</title>
</head>
<body>
    <div class="home">
        <div class="upper-nav">
            <div class="greet">
                <?php  if(isset($_SESSION['UserLogin'])){ ?>
                <?php  echo "Welcome, ".$_SESSION['UserLogin']; ?>
                <?php } else { ?>
                <?php echo "Welcome Guest"; }?>
            </div>
            <div class="login-box">
                <?php if(isset($_SESSION['UserLogin'])) { ?>
                    <button class="logout-button"><a href="logout.php">Logout</a></button>
                <?php } else { ?>
                    <button class="login-button"><a href="login.php">Login</a></button>
                <?php } ?>
            </div>
        </div>
        <nav>
          <ul class="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="members.php">Members</a></li>
            <div class="relateUs">
            <li class="relatebut"><a href="#">Relate with Us<i class="fas fa-sort-down"></i></a></li>
                <ul class="relate-dropdown">
                    <li><a href="news.php">News</a></li>
                    <li><a href="suggestion.php">Suggestion</a></li>
                </ul>
            </div>
           
            <li><a href="aboutus.php">About Us</a></li>
          </ul>
        </nav>
        <!-- Home Content -->
        <div class="content">
            <div class="content-photo">
                <img src="./img/cover.jpg" alt="Coverphoto">
            </div>
            <div class="content-info">
                <h3>Welcome to</h3>
                <h1>Centralian Youth Club</h1>
            </div>
        </div>
    </div>

    <script src="./js/index.js"></script>
</body>
</html>
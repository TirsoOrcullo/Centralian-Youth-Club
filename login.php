<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    include_once("connections/connections.php");
    $con = connections();

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM admin_list WHERE username = '$username' AND password = '$password'";
        $user = $con->query($sql) or die ($con->error);
        $row = $user->fetch_assoc();
        $total = $user->num_rows;

        if($total > 0){
            $_SESSION['UserLogin'] = $row['username'];
            $_SESSION['access'] = $row['access'];
            echo header("Location: index.php");
        } else {
            echo "No users Found.";  
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="login">
        <div class="login-container">
        <h1>Admin Login</h1>
            <form action="" method="post">
                <label for="">Username</label>
                <input type="text" name="username" id="username" autocomplete="off" required>
                <label for="">Password</label>
                <input type="password" name="password" id="password" autocomplete="off" required>
                <button type="submit" name="login" id="login">Login</button>
                <a href="index.php">I'm not admin, go back to Home Page</a>
            </form>
        </div>
    </div>
</body>
</html>
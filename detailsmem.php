<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['access']) && $_SESSION['access'] == "administrator"){
        echo "Welcome, ".$_SESSION['UserLogin'];
    } else {
        echo header("Location: members.php");
    }

    include_once("connections/connections.php");
    $con = connections();

    $id = $_GET['ID'];

    $sql = "SELECT * FROM `member_list` WHERE id = '$id'";
    $member = $con->query($sql) or die ($con->error);
    $row = $member->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Centralians Youth Club</title>
</head>
<body>
    <div class="detailsMem-container">
        <div class="detailsmem-form">
            <h1>Details Form</h1>
            <form action="delete.php" method="post">
                <input type="hidden" name="ID" value="<?php echo $row['id']; ?>">
                <label for="">First Name</label>
                <p><?php echo $row['first_name']; ?></p>
                <label for="">Last Name</label>
                <p><?php echo $row['last_name']; ?></p>
                <label for="">Gender</label>
                <p><?php echo $row['gender']; ?></p>
                <label for="">Date Added</label>
                <p><?php echo $row['added_at']; ?></p>
                <div class="detailsMem-button">
                    <div class="detailsMem-edit">
                        <a href="edit.php?ID=<?php echo $row['id']; ?>">Edit</a>
                    </div>
                    <button type="submit" name="delete" class="detailsMem-delete">Delete</button>
                </div>
         
                <a href="members.php" class="details-back">Back to Member Page</a>
            </form>
        </div>
    </div>
</body>
</html>
<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['access']) && $_SESSION['access'] == "administrator"){
        echo "Welcome, ".$_SESSION['UserLogin'];
    } else {
        echo "Welcome Guest";
    }

    include_once("connections/connections.php");
    $con = connections();

    $id = $_GET['ID'];

    $sql = "SELECT * FROM `suggestion_list` WHERE id = '$id'";
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
            <form action="deletesug.php" method="post">
                <input type="hidden" name="ID" value="<?php echo $row['id']; ?>">
                <label for="">Suggestion Title</label>
                <p><?php echo $row['suggestion_title']; ?></p>
                <label for="">Sender</label>
                <p><?php echo $row['sender']; ?></p>
                <label for="">Suggestion</label>
                <p><?php echo $row['suggestion_details']; ?></p>
                
                <?php if(isset($_SESSION['access']) && $_SESSION['access'] == "administrator"){ ?>
                <div class="detailsMem-button">
                    <div class="detailsMem-edit">
                        <a href="editsug.php?ID=<?php echo $row['id']; ?>">Edit</a>
                    </div>
                    <button type="submit" name="deletesuggestion" class="detailsMem-delete">Delete</button>
                </div>
                <?php } else { ?>
                <div style="display: none" class="detailsMem-button">
                    <div class="detailsMem-edit">
                        <a href="editsug.php?ID=<?php echo $row['id']; ?>">Edit</a>
                    </div>
                    <button type="submit" name="deletesuggestion" class="detailsMem-delete">Delete</button>
                </div>
                <?php } ?>
                    
         
                <a href="suggestion.php" class="details-back">Back to Suggestion Page</a>
            </form>
        </div>
    </div>
</body>
</html>
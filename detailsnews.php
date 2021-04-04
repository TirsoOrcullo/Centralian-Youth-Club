<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['access']) && $_SESSION['access'] == "administrator"){
        echo "Welcome, ".$_SESSION['UserLogin'];
    } else {
        echo "Welcome, Guest";
    }

    include_once("connections/connections.php");
    $con = connections();

    $id = $_GET['ID'];

    $sql = "SELECT * FROM `news_list` WHERE id = '$id'";
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
            <form action="deletenews.php" method="post">
                <input type="hidden" name="ID" value="<?php echo $row['id']; ?>">
                <label for="">News Title</label>
                <p><?php echo $row['news_title']; ?></p>
                <label for="">News For</label>
                <p><?php echo $row['news_for']; ?></p>
                <label for="">News Details</label>
                <p><?php echo $row['news_details']; ?></p>

                <?php if(isset($_SESSION['access']) && $_SESSION['access'] == "administrator"){ ?>
                <div class="detailsMem-button">
                    <div class="detailsMem-edit">
                        <a href="editnews.php?ID=<?php echo $row['id']; ?>">Edit</a>
                    </div>
                    <button type="submit" name="deletenews" class="detailsMem-delete">Delete</button>
                </div>
                <?php } else { ?>
                    <div style="display: none" class="detailsMem-button">
                    <div class="detailsMem-edit">
                        <a href="editnews.php?ID=<?php echo $row['id']; ?>">Edit</a>
                    </div>
                    <button type="submit" name="deletenews" class="detailsMem-delete">Delete</button>
                </div>
                <?php } ?>
                <a href="news.php" class="details-back">Back to News Page</a>
            </form>
        </div>
    </div>
</body>
</html>
<?php 
    include_once("connections/connections.php");
    $con = connections();
    $id = $_GET['ID'];

    $sql = "SELECT * FROM `news_list` WHERE id = '$id'";
    $member = $con->query($sql) or die ($con->error);
    $row = $member->fetch_assoc();

    if(isset($_POST['editnews'])){
        $newstitle = $_POST['newstitle'];
        $newsfor = $_POST['newsfor'];
        $newsdetails = $_POST['newsdetails'];

        $sql = "UPDATE news_list SET news_title = '$newstitle', news_for = '$newsfor', news_details = '$newsdetails' WHERE id = '$id'";
        $con->query($sql) or die ($con->error);

        echo header ("Location: detailsnews.php?ID=".$id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Centralian Youth Club</title>
</head>
<body>
    <div class="editMem-container">
        <div class="editMem-form">
            <h1>Edit Form</h1>
            <form action="" method="post">
                    <label for="">News Title</label>
                    <input type="text" name="newstitle" id="newstitle" value="<?php echo $row['news_title']; ?>" required>
                    <label for="">News For</label>
                    <input type="text" name="newsfor" id="newsfor" value="<?php echo $row['news_for']; ?>">
                    <label for="">Details</label>
                    <textarea name="newsdetails" id="newsdetails" ><?php echo $row['news_details'];?></textarea>
                <div class="editmem-buttons">
                        <button type="submit" name="editnews" class="editmem-but">Edit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
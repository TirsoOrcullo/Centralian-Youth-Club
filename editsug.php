<?php 
    include_once("connections/connections.php");
    $con = connections();
    $id = $_GET['ID'];

    $sql = "SELECT * FROM `suggestion_list` WHERE id = '$id'";
    $member = $con->query($sql) or die ($con->error);
    $row = $member->fetch_assoc();

    if(isset($_POST['edit'])){
        $suggestiontitle = $_POST['suggestiontitle'];
        $sender = $_POST['sender'];
        $suggestiondetails = $_POST['suggestiondetails'];

        $sql = "UPDATE suggestion_list SET suggestion_title = '$suggestiontitle', sender = '$sender', suggestion_details = '$suggestiondetails' WHERE id = '$id'";
        $con->query($sql) or die ($con->error);

        echo header ("Location: detailssug.php?ID=".$id);
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
                    <label for="">Suggestion Title</label>
                    <input type="text" name="suggestiontitle" id="suggestiontitle" value="<?php echo $row['suggestion_title']; ?>" required>
                    <label for="">Sender</label>
                    <input type="text" name="sender" id="sender" value="<?php echo $row['sender']; ?>">
                    <label for="">Suggestion</label>
                    <textarea name="suggestiondetails" id="suggestiondetails"><?php echo $row['suggestion_details'] ?></textarea>
                <div class="editmem-buttons">
                        <button type="submit" name="edit" class="editmem-but">Edit</button>
                </div>
            </form>
            <a href="detailsmem.php">Back</a>
        </div>
    </div>
</body>
</html>
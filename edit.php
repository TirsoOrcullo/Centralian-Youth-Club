<?php 
    include_once("connections/connections.php");
    $con = connections();
    $id = $_GET['ID'];

    $sql = "SELECT * FROM `member_list` WHERE id = '$id'";
    $member = $con->query($sql) or die ($con->error);
    $row = $member->fetch_assoc();

    if(isset($_POST['edit'])){
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $gender = $_POST['gender'];

        $sql = "UPDATE member_list SET first_name = '$fname', last_name = '$lname', gender = '$gender' WHERE id = '$id'";
        $con->query($sql) or die ($con->error);

        echo header ("Location: detailsmem.php?ID=".$id);
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
                    <label for="">First Name</label>
                    <input type="text" name="firstname" id="firstname" value="<?php echo $row['first_name']; ?>" required>
                    <label for="">Last Name</label>
                    <input type="text" name="lastname" id="lastname" value="<?php echo $row['last_name']; ?>">
                    <label for="">Gender</label>
                    <select name="gender" id="gender">
                        <option value="Male" <?php echo ($row['gender'] == "Male")? 'selected':''; ?>>Male</option>
                        <option value="Female" <?php echo ($row['gender'] == "Female")? 'selected':''; ?>>Female</option>
                    </select>
                <div class="editmem-buttons">
                        <button type="submit" name="edit" class="editmem-but">Edit</button>
                </div>
            </form>
            <a href="detailsmem.php">Back</a>
        </div>
    </div>
</body>
</html>
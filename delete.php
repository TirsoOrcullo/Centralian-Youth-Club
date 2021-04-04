<?php
    include_once("connections/connections.php");
    $con = connections();

    $id = ($_POST['ID']);

    if(isset($_POST['delete'])){

        $sql = "DELETE FROM member_list WHERE id = '$id'";
        $con->query($sql) or die ($con->error);

        echo header ("Location: members.php");
    }
?>
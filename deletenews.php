<?php
    include_once("connections/connections.php");
    $con = connections();

    $id = ($_POST['ID']);

    if(isset($_POST['deletenews'])){

        $sql = "DELETE FROM news_list WHERE id = '$id'";
        $con->query($sql) or die ($con->error);

        echo header ("Location: news.php");
    }
?>
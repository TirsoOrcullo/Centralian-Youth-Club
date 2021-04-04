<?php
    include_once("connections/connections.php");
    $con = connections();

    $id = ($_POST['ID']);

    if(isset($_POST['deletesuggestion'])){

        $sql = "DELETE FROM suggestion_list WHERE id = '$id'";
        $con->query($sql) or die ($con->error);

        echo header ("Location: suggestion.php");
    }
?>
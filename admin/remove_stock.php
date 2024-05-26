<?php
    include("./connect.php");
    $stock = $_GET["stock"];

    $query = $conn->query("DELETE FROM `datas` WHERE `stock`='$stock' ");

    if($query){
        echo "We successfully updated the data.";
    }
    else{
        echo "There is server error.";
    }
?>
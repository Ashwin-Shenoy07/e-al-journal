<?php
    $conn = mysqli_connect("localhost", "root", "", "e_al");
    if($conn === false){
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }

    $id1 = $_GET['id'];
    //echo "$id1";
        $q1 = " DELETE FROM `admin_details` WHERE id ='$id1';";
        if($conn -> query($q1) === true){
        //echo "reader,area of intrest deleted ";
        header('Location: crud_displayEditor.php');
    }
?>
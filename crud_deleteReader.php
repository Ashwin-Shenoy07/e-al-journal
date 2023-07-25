<?php
    $conn = mysqli_connect("localhost", "root", "", "e_al");
    if($conn === false){
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }

    $id1 = $_GET['id'];
    //echo "$id1";
    $q = " DELETE FROM `readers_area_of_intrest` WHERE reader_id ='$id1';";
    
    if($conn -> query($q) === true){
        $q1 = " DELETE FROM `reader_registration` WHERE reader_id ='$id1';";
        if($conn -> query($q1) === true){
        //echo "reader,area of intrest deleted ";
        header('location:crud_displayReader.php');
    }
}   
?>
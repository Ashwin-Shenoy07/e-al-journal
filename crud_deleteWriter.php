<?php
    $conn = mysqli_connect("localhost", "root", "", "e_al");
    if($conn === false){
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }

    $id1 = $_GET['id'];
    //echo "$id1";
    $q = " DELETE FROM `writers_area_of_intrest` WHERE writer_id ='$id1';";
    
    if($conn -> query($q) === true){
        $q1 = " DELETE FROM `writer_registration` WHERE writer_id ='$id1';";
        if($conn -> query($q1) === true){
        //echo "reader,area of intrest deleted ";
        header('Location: crud_displayWriter.php');
    }
}  
?>
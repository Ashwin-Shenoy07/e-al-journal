<?php
    $conn = mysqli_connect("localhost", "root", "", "e_al");
    if($conn === false){
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }

    $id1 = $_GET['id'];
    echo "$id1";
    $q = " DELETE FROM `approved_reviewers` WHERE registration_no ='$id1';";
    if($conn -> query($q) === true){
    $q1 = " DELETE FROM `reviewers_area_of_intrest` WHERE registration_no ='$id1';";
    
    if($conn -> query($q1) === true){
        $q2 = " DELETE FROM `reviewer_registration` WHERE registration_no ='$id1';";
        if($conn -> query($q2) === true){
        //echo "reader,area of intrest deleted ";
        header('Location: crud_displayReviewer.php');
    }
    } 
 } 
?>
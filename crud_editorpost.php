<?php

$conn = mysqli_connect("localhost", "root", "", "e_al");
            if($conn === false){
                die("ERROR: Could not connect. ". mysqli_connect_error());
            }
if(isset($_POST['register'])){
    $name =  $_POST['name'];
    $gender =  $_POST['gender'];
    $email = $_POST['email'];
    $qualification = $_POST['qualification'];
    $user = $_POST['user'];
    $a_pass = $_POST['a_pass'];
    
    $countsql = "select count(id) as count from admin_details;";
    $result = mysqli_query($conn,$countsql);
    $val = $result->fetch_array();
    
    $sql="SELECT `type_shortform` FROM `user_type` WHERE type='Admin'";
    $result1 = mysqli_query($conn,$sql);
    $res = $result1->fetch_array();
    $c=1+$val['count'];
    $admin = $res['type_shortform'].$c;
    if($admin != NULL && $name != NULL &&  $gender != NULL && $email != NULL && $a_pass != NULL && $qualification != NULL && $user != NULL){
        $new_admin = "INSERT INTO admin_details  VALUES ('$admin','$name','$gender','$qualification','$email','$user','$a_pass')";
        if($conn -> query($new_admin) === true)
            {
                //echo "inserted successfully";
                    header("Location: crud_displayEditor.php");
                }
                
    }
}

?>
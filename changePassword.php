<?php
    $conn = mysqli_connect("localhost", "root", "", "e_al");
    if($conn === false){
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }

    if(isset($_POST['save'])){
        $writer_id = $_POST['writer_id'];
        $old_pass= "select password from writer_registration where email='$writer_id';";
        $old_pass_res = mysqli_query($conn,$old_pass);
        $old_pass_row = $old_pass_res->fetch_assoc();
        $oldPass = $old_pass_row['password'];

        //echo $oldPass."<br>";



        $new_pass = $_POST['new_pass'];

        //echo $new_pass."<br>";
        if($oldPass != $new_pass){
            $updatePass = "update writer_registration set password='".$new_pass."' where email = '$writer_id'";
            if($conn->query($updatePass) === true){
                $result =  "success";
            }
            else{
                $result = "error";
            }
        }
        else{
            $result = "error";
        }
        if($result == "success"){
            echo '<script type="text/javascript">';
            echo 'setTimeout(function(){window.location.replace("writer_profile.php");});';
            echo '</script>';
        }else{
            echo "error";
            echo '<script type="text/javascript">';
            //echo ' alert("JavaScript Alert Box by PHP")';
            echo 'setTimeout(function(){window.location.replace("writer_profile.php");});';
            echo '</script>';
        }
}
elseif(isset($_POST['save1'])){
    $r_id = $_POST['r_id'];
    $old_pass= "select password from reviewer_registration where email='$r_id';";
    $old_pass_res = mysqli_query($conn,$old_pass);
    $old_pass_row = $old_pass_res->fetch_assoc();
    $oldPass = $old_pass_row['password'];

    //echo $oldPass."<br>";



    $new_pass = $_POST['new_pass'];

    //echo $new_pass."<br>";
    if($oldPass != $new_pass){
        $updatePass = "update reviewer_registration set password='".$new_pass."' where email = '$r_id'";
        if($conn->query($updatePass) === true){
            $result =  "success";
        }
        else{
            $result = "error";
        }
    }
    else{
        $result = "error";
    }
    if($result == "success"){
        echo '<script type="text/javascript">';
        echo 'setTimeout(function(){window.location.replace("reviewer_profile.php");});';
        echo '</script>';
    }else{
        echo "error";
        echo '<script type="text/javascript">';
        //echo ' alert("JavaScript Alert Box by PHP")';
        echo 'setTimeout(function(){window.location.replace("reviewer_profile.php");});';
        echo '</script>';
    }
}
elseif(isset($_POST['save3'])){
    $e_id = $_POST['e_id'];
    //echo $e_id;
    $old_pass= "select password from admin_details where username='$e_id';";
    $old_pass_res = mysqli_query($conn,$old_pass);
    $old_pass_row = $old_pass_res->fetch_assoc();
    $oldPass = $old_pass_row['password'];

    //echo $oldPass."<br>";



    $new_pass = $_POST['new_pass'];

    //echo $new_pass."<br>";
    if($oldPass != $new_pass){
        $updatePass = "update admin_details set password='".$new_pass."' where username = '$e_id'";
        if($conn->query($updatePass) === true){
            $result =  "success";
        }
        else{
            $result = "error";
        }
    }
    else{
        $result = "error";
    }
    if($result == "success"){
        echo '<script type="text/javascript">';
        echo 'setTimeout(function(){window.location.replace("editor_profile.php");});';
        echo '</script>';
    }else{
        echo "error";
        echo '<script type="text/javascript">';
        //echo ' alert("JavaScript Alert Box by PHP")';
        echo 'setTimeout(function(){window.location.replace("editor_profile.php");});';
        echo '</script>';
    }
}
?>

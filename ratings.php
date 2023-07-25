<?php
$mysqli=new mysqli("localhost","root","","e_al");
if($mysqli===false)
{
    echo "ERROR: Could Not Connect.".mysqli_connect_error();
}
    if(isset($_POST['comment'])){
        $rid = $_POST['rid'];
        $pid = $_POST['pid'];
        $rate = $_POST['star'];
        $com = $_POST['com'];

        $sql = "SELECT `reader_id` FROM `reader_registration`";
        $count_res= mysqli_query($mysqli,$sql);
        $row_count = $count_res->fetch_array();
        $read = $row_count[0];
        //echo $read;
            $sql1 = "insert into ratings_and_feedback(`reader_id`,`paper_id`,`ratings`,`feedback`) values ('$read','$pid','$rate','$com');";
            //echo $sql1;
            if($mysqli->query($sql1)=== true){
                echo "<script>alert('Your feedback has been recorded');setTimeout(function(){location.href = 'reader_profile.php';});</script>";
                
            }

    }
?>
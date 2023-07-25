<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background: #1a2238;
            color:white;
        }
        /*.b1{
            background:#1a2238;
            border-top-right-radius:50%;
        }*/
        .admin{
            display: grid;
    grid-template-columns: repeat(3,1fr);
    margin:2px;
        }
        .admin-details{
    border: 5px solid white;
    padding: 10px;
    font-size: 16px;
    font-weight: 600;
    margin: 5px;
        }
        #img{
            position: relative;
            left: 40%;
            transform: translateX(-40%);
            width:150px;
            height:150px;
            padding-right: 5px;
            border-radius:50%;
        }
        .admin-title{
            text-transform: uppercase;
            border-top: 2.5px solid white;
            text-align: center;
            text-decoration: underline ;
    font-size: 40px;
    padding: 10px;
        }
    </style>
</head>
<body>
<?php
$conn=mysqli_connect("localhost","root","","e_al");
if($conn==false){
    die("ERROR: Could not connect.".mysqli_connect_error());
}
include "header.php";
?>
<!--<div class="b1">-->
<h3 class="admin-title">Cheif Editors</h3>

<div class="admin">
<?php
$sql = "select * from admin_details";
$result = mysqli_query($conn,$sql);
while ($row= $result->fetch_array()){ 
    ?>
    
    <table class="admin-details">
    <?php 
        echo "<tr><td colspan='2' rowspan='5'><img src='images/profile.jfif' alt='image' id='img'></td></tr>"; 
        echo "<tr><td>Name</td><td>: $row[1]</td></tr>";
        echo "<tr><td>Qualification</td><td>: $row[2]</td></tr>";
        echo "<tr><td>Gender</td><td>: $row[3]</td></tr>";
        echo "<tr><td>Email</td><td>: $row[4]</td></tr>";
}
?>
</table>
<!--</div>-->
</div>
<h3 class="admin-title">Reviewers</h3>

<div class="admin">
<?php
$sql = "select * from reviewer_registration as rr,approved_reviewers as ar where rr.registration_no=ar.registration_no";
$result = mysqli_query($conn,$sql);
while ($row= $result->fetch_array()){ 
    ?>
    
    <table class="admin-details">
    <?php 
        echo "<tr><td colspan='2' rowspan='5'><img src='images/profile.jfif' alt='image' id='img'></td></tr>"; 
        echo "<tr><td>Name</td><td>: $row[1]</td></tr>";
        echo "<tr><td>Qualification</td><td>: $row[3]</td></tr>";
        echo "<tr><td>Gender</td><td>: $row[2]</td></tr>";
        echo "<tr><td>Email</td><td>: $row[7]</td></tr>";
}
?>
</table>
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container{
            display:flex;
            justify-content:space-around;
        }
        .profile_details{
            width: 100%;
            border: 1px solid #1a2238;
            margin: 50px;
            padding: 10px;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 15px;
        }
        .profile_details_img{
            width: 200px;
    height: 200px;
    /* border: 10px solid; */
    position: relative;
            left: 50%;
            transform: translateX(-50%);
    border-radius: 50%;
        }
        table tr td{
            padding: 10px;
            font-weight:600;
        }
        .cpass{
    position: absolute;
    left: 50%;
    top: 25%;
    transform: translateX(-20%);
    padding: 10px;
    border: 5px solid #169c7b;
    border-radius: 20px;
}

.cpass_tab{
    padding: 10px;
    margin: 5px;
    border: 1px solid #1a2238;
    position: relative;
    transform: translateY(35%);
    border-radius: 15px;
}

.cpass_tab_td{
    padding: 10px 20px;
    color: black;
}
.save-btn{
    background-color: #1a2238;
    border-radius: 0 0px 10px 10px !important;
    padding: 10px;
    width: 50%;
    position: relative;
    left: 50% ;
    transform: translateX(-50%);
    color: aliceblue;
    font-weight: bold;
    border: none;
    
}



.save-btn:hover{
    background-color: #1a2238;
    color:#ff6a3d;
    cursor: pointer;
}

input[type="password"]{
    border-style: none;
    border-bottom: 2px solid #1a2238;
    background: none;
    color: aliceblue;
    padding: 5px;
    margin: 1px 10px;
    width: 100%;

}
    </style>
</head>
<body>
    <?php
        include "reader_menu.html";
        $conn=new mysqli("localhost","root","","e_al");
    if($conn===false)
    {
        echo "ERROR: Could Not Connect.".mysqli_connect_error();
    }
        
    ?>
    <?php

$email=$_COOKIE["username"];
$reader_details = "select * from reader_registration where email='$email';";
$result = mysqli_query($conn,$reader_details);
$val = $result->fetch_array();

$writer_intrest = "select * from readers_area_of_intrest where reader_id='$val[0]';";
$result1 = mysqli_query($conn,$writer_intrest);
$value1 = $result1->fetch_array();
?>
<div class="container">
    <div class="leftbox">
<table class="profile_details">
<tr>
    <td colspan="4"><img src="images/profile.jfif"  alt="" class="profile_details_img"></td>
</tr>
<tr>
    <td id="profile_details_heading">id : </td><td id="profile_details_value"><?php echo $val[0]?></td>
    <td id="profile_details_heading">Name : </td><td id="profile_details_value"><?php echo $val[1]?></td>
</tr>
<tr>
<td id="profile_details_heading">Gender : </td><td id="profile_details_value"><?php echo $val[2]?></td>
    <td id="profile_details_heading">Email : </td><td id="profile_details_value"><?php echo $val[4]?></td>
</tr>
<tr>
    <td id="profile_details_heading" colspan="2">area of interest : </td><td id="profile_details_value" colspan="2"><?php echo $value1[2].", ".$value1[3].", ".$value1[4]."."?></td>
</tr>
</table>
</div>
<div class="rightbox">
<form action="changePassword.php" method="post">
                        <table class="cpass_tab">
                            <tr>
                                <th colspan="2" style="font-size:18px;border-bottom:1px solid #1a2238;padding:5px;">Change password here!!!!!</th>
                            </tr>
                            <tr>
                                <td style="display:none;"><input type="hidden" name="e_id" value="<?php echo $_COOKIE['username'];?>"></td>
                                <td class="cpass_tab_td">Old Password</td>
                                <td class="cpass_tab_td"><input type="password" name="old_pass" id="old_pass" required></td>
                            </tr>
                            <tr>
                                <td class="cpass_tab_td">New Password</td>
                                <td class="cpass_tab_td"><input type="password" name="new_pass" id="password" reduired></td>
                            </tr>
                            <tr>
                                <td class="cpass_tab_td">Repeat Password</td>
                                <td class="cpass_tab_td"><input type="password" name="repeat_pass" id="confirm_password"  onchange="validatepass()" required></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="cpass_tab_td"><button type="submit" name="save" value="save" class="save-btn" onclick="alert('Password changed successfully')">SAVE</button></td>
                            </tr>
                        </table>
                        </form>
</div>
</div>
    <?php
        include "footer.html";
    ?>
</body>
</html>
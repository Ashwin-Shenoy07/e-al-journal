<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Writer Profile</title>
	<link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/profile1.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
<?php
    include "wmenubar.html";
    $conn = mysqli_connect("localhost", "root", "", "e_al");
    if($conn === false){
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }
?>
<div class="wrapper">
    <div class="wrapper_left">
        <ul>
            <li data-li="dashboard" class="active"><p>Dashboard</p></li>
            <li data-li="profile"><p>Profile</p></li>
            <li data-li="article"><p>Article Status</p></li>
            <li data-li="notify"><p>Reviewed papers</p></li>
            <li data-li="reviewer"><p>Approved papers</p></li>
            <li data-li="password"><p>Change Password</p></li>
        </ul>
    </div>
    <div class="wrapper_right">
        <div class="container">
            <div class="item dashboard">
                <div class="item_info">
                <?php
                        echo "<div class='msg'>";
                        $uname=$_COOKIE["username"];
                        
                        $writer_name = "select name from writer_registration where email='$uname';";
                        $writer_name_res = mysqli_query($conn,$writer_name);
                        $writer_name_val = $writer_name_res->fetch_array();
                        date_default_timezone_set('Asia/Calcutta');
                        $Hour = date('G');

                        if ( $Hour >= 5 && $Hour <= 11 ) {
                            echo "<p>Good Morning, ". $writer_name_val[0] ."</p>";
                        } else if ( $Hour >= 12 && $Hour <= 14 ) {
                            echo "<p>Good Afternoon, ". $writer_name_val[0] ."</p>";
                        } else if ( $Hour >= 15 || $Hour <= 4 ) {
                            echo "<p>Good Evening, ". $writer_name_val[0] ."</p>";
                        }
                        $dt = new DateTime(); 
                        echo "<p> It's ".$dt->format('l')." today.</p>"; 
                        echo "</div>";
                        
                    ?>
                </div>  
            </div>
            <div class="item profile" style="display: none;">
                <div class="item_info">
                    <p>profile page</p>
                    <?php

                        $email=$_COOKIE["username"];
                        $reader_details = "select * from writer_registration where email='$email';";
                        $result = mysqli_query($conn,$reader_details);
                        $val = $result->fetch_array();

                        $writer_intrest = "select * from writers_area_of_intrest where writer_id='$val[0]';";
                        $result1 = mysqli_query($conn,$writer_intrest);
                        $value1 = $result1->fetch_array();
                    ?>
                    <table class="profile_details">
                        <tr>
                            <td colspan="2" rowspan="2"><img src="images/profile.jfif"  alt="" class="profile_details_img"></td>
                        </tr>
                        <tr>
                            <td id="profile_details_heading">id</td><td id="profile_details_value"><?php echo $val[0]?></td>
                        </tr>
                        <tr>
                            <td id="profile_details_heading">Name</td><td id="profile_details_value"><?php echo $val[1]?></td>
                        
                            <td id="profile_details_heading">Gender</td><td id="profile_details_value"><?php echo $val[2]?></td>
                        </tr>
                        <tr>
                            <td id="profile_details_heading">Qualification</td><td id="profile_details_value"><?php echo $val[3]?></td>
                        
                            <td id="profile_details_heading">Email</td><td id="profile_details_value"><?php echo $val[4]?></td>
                        </tr>
                        <tr>
                            <td id="profile_details_heading" colspan="2">area of interest</td><td id="profile_details_value" colspan="2"><?php echo $value1[2].", ".$value1[3].", ".$value1[4]."."?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="item article" style="display: none;">
                <div class="item_info">
                    <p>article status</p>
			        <div class="form-group">
		  		        <label for="title" class="label-title">select your paper to track status </label>
			        </div>
                    <?php
                    $email1=$_COOKIE["username"];
                    $wid = "select * from writer_registration where email='$email1';";
                    $widres = mysqli_query($conn,$wid);
                    $widval = $widres->fetch_array();

			            $title = "select article_title,category from article_submission where writer_id1='$widval[0]';";
                        $title_res = mysqli_query($conn,$title);
                        while($title_row=$title_res->fetch_array())
		                {
                                echo "<button type='button' class='collapsible'>".$title_row[0]."</button>";
                                echo "<div class='content' style='display:none;'>";
  					                echo"<div id='para'>";
                                    ?>
                                        <table class='article_status'>
                                            <tr>
                                                <th  class='article_status_th'>Paper Id</th>
                                                <th class='article_status_th'>Category</th>
                                                <th class='article_status_th'> Submission Status</th>
                                                <th class='article_status_th'> Review Status</th>
                                                <th class='article_status_th'> Publication Status</th>
                                            </tr>
                                            <?php
                                                $status_sql = "select paper_id,category,paper_status from article_submission where writer_id1='$widval[0]' and article_title='$title_row[0]';";
                                                //echo $status_sql;
                                                $status_sql_res = mysqli_query($conn,$status_sql);
                                                while($status_sql_row=$status_sql_res->fetch_array())
                                                {
                                                    echo "<tr>";
                                                        echo "<td class='article_status_td'>".$status_sql_row['paper_id']."</td><td class='article_status_td'>".$status_sql_row['category']."</td><td class='article_status_td'>".$status_sql_row['paper_status']."</td>";
                                                    

                                                
                                                $status_sql1 = "select status from article_review where paper_id='".$status_sql_row['paper_id']."'";
                                                //echo $status_sql1;
                                                $status_sql_res1 = mysqli_query($conn,$status_sql1);
                                                $status_sql_row1=$status_sql_res1->fetch_assoc();
                                                {
                                                    echo "<td class='article_status_td'>".$status_sql_row1['status']."</td>";

                                                }
                                                $status_sql2 = "select status from artical_final_submission where paper_id='".$status_sql_row['paper_id']."'";
                                                //echo $status_sql2;
                                                $status_sql_res2 = mysqli_query($conn,$status_sql2);
                                                $status_sql_row2=$status_sql_res2->fetch_assoc();
                                                {
                                                    echo "<td class='article_status_td'>".$status_sql_row2['status']."</td>";

                                                }
                                                echo "</tr>";
                                            }
                                            ?>
                                        </table>
                                        <?php
                                    echo "</div>";
				                echo "</div>";
                        
                    }
                    ?>
                </div>
            </div>
            <div class="item notify" style="display: none;">
                <div class="item_info">
                    <p>Reviewed Papers</p>
                    <div class="form-group">
		  		        <label for="title" class="label-title">Reviewed Papers</label>
			        </div>
                    <?php
                    $p_id = "select paper_id,article_title from article_submission where writer_id1=(select writer_id from writer_registration where email='$email1') ";
                    //echo $p_id;
                    $p_id_res = mysqli_query($conn,$p_id);
                    while($p_id_row = $p_id_res-> fetch_assoc()){
                        $reviewed_doc = "select reviewed_filepath,reviewed_filename,comment,status from article_review where paper_id='".$p_id_row['paper_id']."' and status='reviewed';";
                        //echo $reviewed_doc;                
                        $reviewed_doc_res = mysqli_query($conn,$reviewed_doc);
                        $reviewed_doc_row = $reviewed_doc_res->fetch_assoc();
                        $status = $reviewed_doc_row['status'];
                        //echo $p_id_row['paper_id']."<br>". $p_id_row['article_title'];
                        if($status == 'reviewed'){
                        echo '<button type="button" class="collapsible">'.$p_id_row['article_title'].'</button>';
				        echo '<div class="content" style="display:none;">';
        	                    echo '<div id="paper">';

                                        
                                        //echo $status;
                                        
                                        echo "<span class='reviewed_doc'>Reviewed Document</span>";
                                        echo "<a download='".$reviewed_doc_row['reviewed_filename']."' href='uploads/reviewed_file/".$reviewed_doc_row['reviewed_filepath']."' style='color: black;padding: 15px;font-size: 16px;'>Download  <img src='images/download.png' width='15' height='15' alt='D'></a>";
                                        echo "<div id='r_para'><h3>comments</h3><p style='color: crimson !important;'>".$reviewed_doc_row['comment']."</p></div>";
                                        echo "<div class='form-group'>";
                                            echo "<label for='title' class='label-title'>Resubmit Article</label>";
                                        echo "</div>";
                                        echo '<div class="wrapper1">';
			                            echo '<form action="resubmission_details.php" method="post" enctype="multipart/form-data">';
    			                            echo '<header>Upload Article</header>';
                                            echo '<input type="hidden" name="paper_id" value="'.$p_id_row['paper_id'].'">';
				                            echo '<input type="file" name="re_file">';
                                            echo '<input type="submit" name="submit" value="submit">';
			                            echo '<input type="reset" name="cancel" value="cancel">';
			                            echo '</form>';
			                            
 		                            echo "</div>";
                                     echo "</div>";
                                     echo "</div>";
                                        }
			                    
                    }
                
                
                    ?>
            </div>
            </div>
            <div class="item reviewer" style="display: none;">
                <div class="item_info">
                    <p>Approved Papers</p>
                    <?php
                    $p_id1 = "select paper_id,article_title from article_submission where writer_id1=(select writer_id from writer_registration where email='$email1') ";
                    //echo $p_id1;
                    $p_id_res1 = mysqli_query($conn,$p_id1);
                    while($p_id_row1 = $p_id_res1-> fetch_assoc()){
                        //echo $p_id_row1['paper_id'];
                        $final = "select status from article_review where paper_id='".$p_id_row1['paper_id']."' AND status='approved'";
                        //echo $final;
                        $final_res = mysqli_query($conn,$final);
                        $final_row = $final_res->fetch_assoc();
                        $final_status = $final_row['status'];
                        if($final_status == 'approved'){
                        echo '<button type="button" class="collapsible">'.$p_id_row1['article_title'].'</button>';
				        echo '<div class="content" style="display:none;">';
        	                    echo '<div id="paper">';
                                echo '<label for="title" class="label-title">upload the following documents.</label>';
                                echo '<div class="wrapper1">';
                    
                                echo '<form action="final_submission_details.php" method="post" enctype="multipart/form-data">';
                                echo '<table>';
                                echo '  <input type="hidden" name="paper_id" value="'. $p_id_row1['paper_id'].'">';
                                echo ' <tr>';
                                echo '    <td><label for="title" class="label-title">Acceptance Letter </label></td>';
                                echo ' <td><input type="file" name="accept"></td>';
                                echo '</tr>';
                                echo '<tr>';
                                        echo '    <td><label for="title" class="label-title">Copyrights </label></td>';
                                        echo '    <td><input type="file" name="copy"></td>';
                                        echo '</tr>';
                                        echo '<tr>';
                                            echo '<td><label for="title" class="label-title">Cover Page </label></td>';
                                            echo '<td><input type="file" name="cover"></td>';
                                        echo '</tr>';
                                        echo '<tr>';
                                            echo '<td><label for="title" class="label-title">Final File </label></td>';
                                            echo '<td><input type="file" name="final_file"></td>';
                                        echo '</tr>';
                                        echo '<tr>';
                                            echo '<td colspan="2" class="sub-btn"><input type="submit" value="Submit" name="submit"><input type="reset" value="Cancel" name="Cancel"></td>';
                                        echo '</tr>';
                                    echo '</table>';
                                    echo '</form>';
                                    
                                echo "</div>";
                            echo "</div>";
                            echo "</div>";
                    
                    }
                    
                    
                }
                
                    ?>
				        
                        
                        
                </div>   
            </div>
            <div class="item password" style="display: none;">
                <div class="item_info">
                    <p>change password</p>
                    <div class="cpass">
                        <form action="changePassword.php" method="post">
                        <table class="cpass_tab">
                            <tr>
                                <td style="display:none;"><input type="hidden" name="_id" value="<?php echo $_COOKIE['username'];?>"></td>
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
            </div>
        </div>
    </div>
</div>

<?php
    include "footer.html";
?>
	<script src="js/profile.js"></script>
    <script src="js/password_validation.js"></script>
    <script src="js/changePass.js"></script>
</body>
</html>
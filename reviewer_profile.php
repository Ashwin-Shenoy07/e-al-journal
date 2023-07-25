<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Review Profile</title>
	<link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/profile1.css">
    <link rel="stylesheet" href="css/editor_profile.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
<?php
    include "rmenubar.html";
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
            <li data-li="article"><p>Assigned Article</p></li>
            <li data-li="reviewer"><p>Approvals</p></li>
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
                        
                        $writer_name = "select name from reviewer_registration where email='$uname';";
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
                        $reader_details = "select * from reviewer_registration where email='$email';";
                        $result = mysqli_query($conn,$reader_details);
                        $val = $result->fetch_array();

                        $writer_intrest = "select * from reviewers_area_of_intrest where registration_no='$val[0]';";
                        $result1 = mysqli_query($conn,$writer_intrest);
                        $value1 = $result1->fetch_array();

                        
                        $writer_intrest = "select * from writers_area_of_intrest where writer_id='W1';";
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
                        
                            <td id="profile_details_heading">Email</td><td id="profile_details_value"><?php echo $val[7]?></td>
                        </tr>
                        <tr>
                            <td id="profile_details_heading">area of interest</td><td id="profile_details_value"><?php echo $value1[2].", ".$value1[3].", ".$value1[4]."."?></td>
                        
                            <td id="profile_details_heading">Approval Status</td><td id="profile_details_value"><?php echo $val[9]?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="item article" style="display: none;">
                <div class="item_info">
                    <p>Assigned Article</p>
			        <div class="form-group">
		  		        <label for="title" class="label-title">select the paper to review </label>
			        </div>
                    <?php
                    $reviewer_id = "SELECT `reviewer_id` FROM `approved_reviewers` where `registration_no`=(SELECT `registration_no` from `reviewer_registration` where `email`='$email');";
                    $reviewer_id_res = mysqli_query($conn,$reviewer_id);
                    $reviewer_id_row = $reviewer_id_res->fetch_assoc();
                    $reviewer_id1 = $reviewer_id_row['reviewer_id'];
                    //echo $reviewer_id1;

                    $paper_id = "select paper_id from article_assignment where reviewed_id='$reviewer_id1'";
                    //echo $paper_id;
                    $paper_id_res = mysqli_query($conn,$paper_id);
                    $paper_id_row = $paper_id_res->fetch_assoc();
                    $paper_id1 = $paper_id_row['paper_id'];
                    //echo $paper_id1;
                    
                    $title ="select article_title from article_submission where paper_id='$paper_id1' and paper_status='assigned'";
                    $title_res = mysqli_query($conn,$title);
                    while($title_row = $title_res->fetch_array()){
                    $title1 = $title_row[0];
                    //echo $title1;
                    echo "<button type='button' class='collapsible'>".$title_row[0]."</button>";

                    echo "<div class='content' style='display:none;'>";
  					    echo"<div id='para'>";
                            $file = "select file1_path,file1_name from submission_files where paper_id='$paper_id1'";
                            $file_res = mysqli_query($conn,$file);
                            $file_row = $file_res->fetch_assoc();
                            $file_path = $file_row['file1_path'];
                            $file_name = $file_row['file1_name'];
                            //echo $file1;
                            echo "<table>";
                            echo "<tr><th>Paper Id</th><th>File</th></tr>";
                            echo "<tr><td>".$paper_id1."</td><td><a download='$file_name' href='$file_path'>Download <img src='images/download.png' width='15' height='15' alt='D'></a></tr>";
                            echo "</table>";
                            echo "<div>";
                                echo "<lable for='title' class='label-title'>Upload Reviewed File</lable>";
                                echo "<form method='post' action='reviewdetails.php' enctype='multipart/form-data'>";
                                    ?>
                                    <input type="hidden" name="paper_id" value="<?php echo $paper_id1;?>">
                                    <input type="hidden" name="r_id" value="<?php echo $reviewer_id1;?>">
                                    <textarea name='comment' rows='10' cols='100' onkeydown="remainingChars(500, this)"></textarea>
                                    <div><span id="remainingChars"> </span></div>
                                    <?php
                                    
                                    echo '<input type="file" name="re_file">';
                                    echo '<input type="submit" name="submit" value="submit">';
                                    echo '<input type="reset" name="cancel" value="cancel">';
                                echo "</form>";
                            echo "</div>";
                        echo "</div>";
				    echo "</div>";
                    }                 
                    ?>
                    <script type="text/javascript">
                        var remainingChars= function(maxChars, input){
                        var totalChars= input.value.length;
                        var remaining= (maxChars - totalChars);
                        var displayChars=document.getElementById('remainingChars');
     
                        if(remaining>0){
                            displayChars.innerHTML="Remaining characters: "+remaining;
                            displayChars.style.color="green";
                            input.style.borderColor = "green";
                        }else{
                            displayChars.innerHTML="Remaining character: 0";
                            displayChars.style.color="red";
                            input.style.borderColor = "red";
                        }
                        }
  </script>
                </div>
            </div>
            <div class="item reviewer" style="display: none;">
                <div class="item_info">
                    <p>Approved Papers</p>
                    <div id="app"></div>
                    <div class="form-group">
		  		        <label for="title" class="label-title">Approve paper for final submission</label>
			        </div>
                        <table class="approve_reviewers_tb">
                            <tr>
                                <th>Paper ID</th>
                                <th>Title</th>
                                <th>File Name</th>
                                <th>File</th>
                                <th colspan="2">Status</th>
                                
                            </tr>
                            <?php
                            //echo $_COOKIE['username'];
                            $con_sql = "select reviewed_id,paper_id from article_review where reviewed_id=(select reviewer_id from approved_reviewers where registration_no=(select registration_no from reviewer_registration where email='$email')) and status='reviewed'";
                            $con_res = mysqli_query($conn,$con_sql);
                            $con_row = $con_res->fetch_assoc();
                            
                            //select paper_id,article_title from article_submission
                            //select file2_name,file2_path submission_files where paper_id='$r_row[0]'
                            $p_details = "select paper_id,article_title from article_submission where paper_id='".$con_row['paper_id']."'";
                            $p_result = mysqli_query($conn,$p_details);

                            $p_rowcount = 0;
                            while($p_row=$p_result->fetch_array())
		                    {
			                    $p_rowcount++;
		                        echo "<tr class='approve_reviewers_tr' name=$p_rowcount>";
			                    for($i=0;$i<=11;$i++){
				                    if($i == 0)
				                    { 
                                        echo "<td class='approve_reviewers_td' id=$p_row[$i]>".$p_row[$i]."</td>";
        
                                        
				                    }
                                    if($i == 1){
                                        echo "<td class='approve_reviewers_td' id=$p_row[$i]>".$p_row[$i]."</td>";
                                    }
                                }

                                $file_sql = "select `file2_name`, `file2_path` FROM `submission_files` where paper_id='$p_row[0]'";
                                //echo "<td>".$file_sql."</td>";
                                $file_sql_res = mysqli_query($conn,$file_sql);
                                while($f_sql_row=$file_sql_res->fetch_array())
		                        {
	    		                    for($j=0;$j<=7;$j++){
                                        if($j == 0)
                                        { 
                                            echo "<td class='approve_reviewers_td' id=$f_sql_row[$j]>".$f_sql_row[$j]."</td>";
                                        }
                                        if($j == 1){
                                            $num1 = $j-1;
                                            echo "<td class='approve_reviewers_td' id=$f_sql_row[$j]><a download='$f_sql_row[$num1]' href='$f_sql_row[$j]' class='approve_reviewers_a'>Download <img src='images/download.png' width='15' height='15' alt='D'></a></td>";
                                        }
			                        }
                                }
                            
                            echo "<td class='approve_reviewers_td'><button type='submit' class='approve' id='$p_row[0]' name='approve' value='approve' onclick='approve_art(\"$p_row[0]\")'>Approve</button></td><td class='approve_reviewers_td'><button type='submit' class='reject' id='$p_row[0]' name='reject' value='reject' onclick='reject_art($p_row[0])'>Reject</button></td>";
                            //echo $p_row[0];
                            echo "</tr>";
                            
                            }
                            
                            ?>
                        </table>
                        <div id="returnVal"></div>
				</div>
            </div>
            <div class="item password" style="display: none;">
                <div class="item_info">
                    <p>change password</p>
                    <div class="cpass">
                        <form action="changePassword.php" method="post">
                        <table class="cpass_tab">
                            <tr>
                                <td style="display:none;"><input type="hidden" name="r_id" value="<?php echo $_COOKIE['username'];?>"></td>
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
                                <td colspan="2" class="cpass_tab_td"><button type="submit" name="save1" value="save" class="save-btn" onclick="alert('Password changed successfully')">SAVE</button></td>
                            </tr>
                        </table>
                        </form>
                    </div>

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
    <script src="js/approve_articles.js"></script>
    <script src="js/changePass.js"></script>
</body>
</html>
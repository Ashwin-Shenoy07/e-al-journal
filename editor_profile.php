<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Editor Profile</title>
	<link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/profile1.css">
    <link rel="stylesheet" href="css/editor_profile.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <style>
        /*.hide {
            display: none;
        }
    
        .myDIV:hover + .hide {
            position: absolute;
            display: block;
            background:white;
            width:250px;
            height:auto;
            color: red;
        }*/

        #A_returnVal{
            position: absolute;
            bottom: 10%;
        }
        div.successmsg {
                background: green;
    			border: 1px solid #169c7b;
    			font-weight: bold;
    			padding: 10px;
    			margin: 5px;
    			width: 50%;
    			position: absolute;
                color:white;
			}
			div.errmsg {
                background: crimson;
    			border: 1px solid #169c7b;
                color:white;
    			font-weight: bold;
    			padding: 10px;
    			margin: 5px;
			}
    </style>
</head>
<body>
<?php
    include "editor_menu.html";
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
            <li data-li="article"><p>Assign Article</p></li>
            <li data-li="notify"><p>Approve Reviewer</p></li>
            <li data-li="reviewer"><p>Publish Article</p></li>
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
                        
                        $admin_name = "select name from admin_details where username='$uname';";
                        $admin_name_res = mysqli_query($conn,$admin_name);
                        $admin_name_val = $admin_name_res->fetch_array();
                        date_default_timezone_set('Asia/Calcutta');
                        $Hour = date('G');

                        if ( $Hour >= 5 && $Hour <= 11 ) {
                            echo "<p>Good Morning, ". $admin_name_val[0] ."</p>";
                        } else if ( $Hour >= 12 && $Hour <= 14 ) {
                            echo "<p>Good Afternoon, ". $admin_name_val[0] ."</p>";
                        } else if ( $Hour >= 15 || $Hour <= 4 ) {
                            echo "<p>Good Evening, ". $admin_name_val[0] ."</p>";
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
                        $uname=$_COOKIE["username"];
                        $admin_details = "select * from admin_details where username='$uname';";
                        $result = mysqli_query($conn,$admin_details);
                        $val = $result->fetch_array();
                    ?>
                    <table class="profile_details">
                        <tr>
                            <td rowspan="2" colspan="2" id="profile_details_heading"><img src="images/profile.jfif" class="profile_details_img"></td><td id="profile_details_heading">id</td><td  id="profile_details_value"><?php echo $val[0]?></td>
                        </tr>
                        <tr>
                            <td id="profile_details_heading">Name</td><td id="profile_details_value" colspan="2"><?php echo $val[1]?></td>
                        </tr>
                        <tr>
                            <td id="profile_details_heading">Qualification</td><td id="profile_details_value"><?php echo $val[2]?></td>
                            <td id="profile_details_heading">Gender</td><td id="profile_details_value"><?php echo $val[3]?></td>
                        </tr>
                        <tr>
                            <td id="profile_details_heading">Email</td><td id="profile_details_value"><?php echo $val[4]?></td>
                            <td id="profile_details_heading">Username</td><td id="profile_details_value"><?php echo $val[5]?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="item article" style="display: none;">
                <div class="item_info">
                    <p>Assign Article</p>
                    <div id='msg'></div>
			        <div class="form-group">
		  		        <label for="title" class="label-title">Assign articles or journals to reviewer based on area of interest. </label>
			        </div>
			        <?php
                        $interest_in = "select slno, area from interest_in;";
                        $res = mysqli_query($conn,$interest_in);
                        while($row=$res->fetch_assoc())
		                {
                                $art_count = "select count(paper_id) as count from article_submission where category='".$row['area']."' AND paper_status='pending';";
                                $art_res = mysqli_query($conn,$art_count);
                                $art_row = $art_res->fetch_assoc();
                                $count_art = $art_row['count'];
                                //echo "<span class='count'>".$count_art."</span>";
                                echo "<button type='button' class='collapsible'>".$row['area']."<span class='count'>".$count_art."</span></button>";
                                $tableNo = $row['slno'];
                                
                                echo "<div class='content' style='display:none;'>";
  					                echo"<div id='para'>";
                                        

                                        $article = "select * from article_submission where category='".$row['area']."' AND paper_status='pending';";
                                        $res1 = mysqli_query($conn,$article);
                                        $rowcount1 = 0;
                                        echo "<table class='assign_article' id='".$row['slno']."'>";
                                        echo "<tr><th>Paper ID</th><th>Title</th><th>Select Reviewer</th><th>Status</th></tr>";
                                        while($row1=$res1->fetch_array())
		                                {
                                            $rowcount1++;
                                            echo "<tr name='row$rowcount1'>";
	    		                            for($j=0;$j<11;$j++){
			    	                            if($j == 0)
                                                {
                                                    echo "<td class='assign_article_td' id='papername'>".$row1[$j]."</td>";
                                                }
                                                elseif($j == 3)
                                                {
                                                    echo "<td class='assign_article_td' id=$row1[$j]>".$row1[$j]."</td>";
                                                }
                                                else
                                                {
                                                    continue;
                                                }   
                                            }
                                            echo "<td id='reviewerName' class='assign_article_td'>";
                                            $reviewer = "SELECT reviewer_id,name FROM reviewer_registration as rr, approved_reviewers as ap, reviewers_area_of_intrest as ra where rr.registration_no=ra.registration_no and rr.registration_no= ap.registration_no  and (ra.intrest1='".$row['area']."' or ra.intrest2='".$row['area']."' or ra.intrest3='".$row['area']."');";
                                            $res2 = mysqli_query($conn,$reviewer);
                                            //$row2=$res2->fetch_assoc();
                                            //echo $row2['name'];//select reviewer_id from reviewer_registration as rr, approved_reviewers as ap where rr.registration_no = ap.registration_no and name='".$row2['name']."';
                                            //$rid = "SELECT reviewer_id FROM approved_reviewers as ap, reviewer_registration as rr where ap.registration_no=rr.registration_no and name='".$row2['name']."'";
                                            //echo $rid;
                                            //$result3 = mysqli_query($conn,$rid);
                                            //$reviewer_id = 0;
                                            //echo $row3['reviewer_id'];
                                            echo "<select >";
                                            echo "<option value='#'>select...</option>";
                                            while($row2=$res2->fetch_assoc())
                                            {
                                                    
                                            ?>
                                                <option value="<?php echo $row2['reviewer_id']?>"><?php echo $row2['name']?></option>
                                            <?php
                                            }   
                                            echo "</select>";
                                            echo "</td>";
                                            //echo "<td>".$reviewer_id."</td>";
                                            echo "<td class='assign_article_td'><button type='submit' class='approve' name='assign' value='assign' onclick='assign($rowcount1,$tableNo)'>Assign</button></td>";
                                        }
                                            //echo "<td id='msg'></td>";
                                            echo "</tr>";
                                            //echo "<tr><td id='msg' colspan='5'></td></tr>";
                                        echo "</table>";
                                        
                                    echo "</div>";
				                echo "</div>";
                        
                    }
                    ?>
                    
                </div>
            </div>
            <div class="item notify" style="display: none;">
                <div class="item_info">
                    <p>Approve Reviewers</p>
                    <div id='A_returnVal'></div>
                    <div class="form-group">
		  		        <label for="title" class="label-title">Registered Reviewers</label>
			        </div>
                    
                        <table class="approve_reviewers_tb">
                            <tr>
                                <th>Registration No</th>
                                <th>Name</th>
                                <th>Resume</th>
                                <th>Area Of Interest</th>
                                <th colspan="2">Status</th>
                                
                            </tr>
                            <?php
                            $reviewer_details = "select * from reviewer_registration where status='pending' OR status='rejected'";
                            $result = mysqli_query($conn,$reviewer_details);

                            $rowcount = 0;
                            while($row=$result->fetch_array())
		                    {
			                    $rowcount++;
		                        echo "<tr class='approve_reviewers_tr' name=$rowcount>";
			                    for($i=0;$i<=6;$i++){
				                    if($i == 0)
				                    { 
                                        echo "<td class='approve_reviewers_td' id=$row[$i]>".$row[$i]."</td>";
        
                                        
				                    }
                                    elseif($i == 1){
                                        echo "<td class='approve_reviewers_td' id=$row[$i]>".$row[$i]."</td>";
                                    }
                                    elseif($i == 6)
                                    {
                                        $num = $i-1;
                                        echo "<td class='approve_reviewers_td' id=$row[$i]><a download=".$row[$num]." href='".$row[$i]."' class='approve_reviewers_a'>Download <img src='images/download.png' width='15' height='15' alt='D'></a></td>";
                                    }
				                    else
				                    {
                                        echo "<td style='display:none' id=$row[$i]>".$row[$i]."</td>";   
                                    }
                                }

                                $reviewer_intrest = "select * from reviewers_area_of_intrest where registration_no='$row[0]';";
                                $result1 = mysqli_query($conn,$reviewer_intrest);
                                $rowcount1 = 0;
                                while($row1=$result1->fetch_array())
		                        {
                                    echo"<td class='approve_reviewers_td'>";
	    		                    $rowcount1++;
		    	                    for($j=0;$j<=4;$j++){
			    	                    if($j < 2)
                                        {
                                            continue;
                                        }
                                        else
                                        {
                                            $no = $j-1;
                                            echo "$no. ".$row1[$j]."<br>";
                                        }   
                                    }
			                    }
                            echo "</td>";
                            echo "<td class='approve_reviewers_td'><button type='submit' class='approve' id='$row[0]' name='approve' value='approve' onclick='approve($row[0])'>Approve</button></td><td class='approve_reviewers_td'><button type='submit' class='reject' id='$row[0]' name='reject' value='reject' onclick='reject($row[0])'>Reject</button></td>";
                            echo "</tr>";
                            //echo "<tr><td id='A_returnVal' colspan='6'></td</tr>";
                            
                            }
                            
                            ?>
                        
                        </table>
                    
            </div>
            </div>
            <div class="item reviewer" style="display: none;">
                <div class="item_info">
                    <p>Approve Paper</p>
                    <div id='P_returnVal'></div>
                    <div class="form-group">
		  		        <label for="title" class="label-title">Approve the papers for publication.</label>
			        </div>
                        <table class="approve_reviewers_tb">
                            <tr>
                                <th>Paper ID</th>
                                <th>Article Title</th>
                                <th>File</th>
                                <th>Acceptance Letter</th>
                                <th colspan="2">Status</th>
                                
                            </tr>
                            <?php
                                $final_sql = "select paper_id,	final_filename, final_filepath,accept_filename,accept_filepath from artical_final_submission where status='pending';";
                                $final_sql_res = mysqli_query($conn,$final_sql) ;
                                $final_rowcount=0;
                                while($final_sql_row = $final_sql_res->fetch_array()){
                                    $final_rowcount++;
                                    echo "<tr class='approve_reviewers_tr' name=$final_rowcount>";
                                    for($i=0;$i<5;$i++){
                                        if($i == 0)
                                        { 
                                            echo "<td class='approve_reviewers_td' id=$final_sql_row[$i]>".$final_sql_row[$i]."</td>";
                                            $final_title = "select article_title from article_submission where paper_id = '".$final_sql_row[$i]."'";
                                            $final_title_res = mysqli_query($conn,$final_title) ;
                                            $final_title_row = $final_title_res->fetch_assoc();
                                            echo "<td class='approve_reviewers_td' id='".$final_title_row['article_title']."'>".$final_title_row['article_title']."</td>";
                                            
                                        }
                                        elseif($i == 2)
                                        {
                                            $num = $i-1;
                                            echo "<td class='approve_reviewers_td' id=$final_sql_row[$i]><a download=".$final_sql_row[$num]." href='".$row[$i]."' class='approve_reviewers_a'>Download <img src='images/download.png' width='15' height='15' alt='D'></a></td>";
                                        }
                                        elseif($i == 4)
                                        {
                                            $num2 = $i-1;
                                            echo "<td class='approve_reviewers_td' id=$final_sql_row[$i]><a download=".$final_sql_row[$num2]." href='".$row[$i]."' class='approve_reviewers_a'>Download <img src='images/download.png' width='15' height='15' alt='D'></a></td>";
                                        }
                                        else
                                        {
                                            echo "<td style='display:none' id=$final_sql_row[$i]>".$final_sql_row[$i]."</td>";   
                                        }
                                    }
    
                                    /*$reviewer_intrest = "select * from reviewers_area_of_intrest where registration_no='$row[0]';";
                                    $result1 = mysqli_query($conn,$reviewer_intrest);
                                    $rowcount1 = 0;
                                    while($row1=$result1->fetch_array())
                                    {
                                        echo"<td class='approve_reviewers_td'>";
                                        $rowcount1++;
                                        for($j=0;$j<=4;$j++){
                                            if($j < 2)
                                            {
                                                continue;
                                            }
                                            else
                                            {
                                                $no = $j-1;
                                                echo "$no. ".$row1[$j]."<br>";
                                            }   
                                        }
                                    }
                                echo "</td>";*/
                                echo "<td class='approve_reviewers_td'><button type='submit' class='approve' id='$final_sql_row[0]' name='publish' value='PUBLISH' onclick='publish_art(\"$final_sql_row[0]\")'>Publish</button></td><td class='approve_reviewers_td'><button type='submit' class='reject' id='$final_sql_row[0]' name='reject' value='reject' onclick='reject_art(\"$final_sql_row[0]\")'>Reject</button></td>";
                                echo "</tr>";
                                //echo "<tr><td id='returnVal' colspan='6'></td</tr>";
                                }
                            ?>
                        
                        </table>
                        
            </div>
                            </div>
            <div class="item password" style="display: none;">
                <div class="item_info">
                    <p>change password</p>
                    <div class="cpass">
                        <form action="changePassword.php" method="post">
                        <table class="cpass_tab">
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
                                <td colspan="2" class="cpass_tab_td"><button type="submit" name="save3" value="save" class="save-btn" onclick="alert('Password changed successfully')">SAVE</button></td>
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
    <script src="js/approve_reviewer.js"></script>
    <script src="js/publish_article.js"></script>
    <script src="js/changePass.js"></script>
</body>
</html>
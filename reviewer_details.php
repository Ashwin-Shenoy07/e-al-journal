<link rel="stylesheet" href="css/style.css">
<?php
include "header.php";

    class Reviewer{
        var $conn = "false";

        function connection(){
            $this -> conn = mysqli_connect("localhost", "root", "", "e_al");
            if($this -> conn === false){
                die("ERROR: Could not connect. ". mysqli_connect_error());
            }
        }
        function register(){
            if(isset($_POST['register'])) {
                $fname =  $_POST['fname'];
                $lname = $_POST['lname'];
                $gender =  $_POST['gender'];
                $email = $_POST['email'];
                $rqualification = $_POST['rqualification'];
                $r_pass = $_POST['password_r'];
                $cpass = $_POST['password_c'];
                $file_name = $_FILES['resume']['name'];
                $file_tmp_name = $_FILES['resume']['tmp_name'];
                $file_path = "uploads/resume/" . $file_name;
                move_uploaded_file($file_tmp_name,"uploads/resume/" . $file_name);
                $name = $fname." ".$lname;
                $rarea_of_interest = $_POST['rarea'];
                //echo $rarea_of_interest[0];
                $status = "pending";
                $countsql = "select count(registration_no) as count from reviewer_registration;";
                $result = mysqli_query($this->conn,$countsql);
                $val = $result->fetch_array();
                
                $sql="SELECT type_shortform FROM user_type WHERE type='Reviewer'";
                $result1 = mysqli_query($this->conn,$sql);
                $res = $result1->fetch_array();
                $c=1+$val['count'];
                $registration_no = date('Y').date('n').$c;

                /*echo "<br>".$file_name."<br>".$file_tmp_name."<br>".$file_path;*/
                if($registration_no !=NULL && $name !=NULL && $gender!=NULL && $rqualification!=NULL && $file_name !=NULL && $file_path !=NULL && $email !=NULL && $r_pass != NULL && $status != NULL ){
                    $sql = "INSERT INTO reviewer_registration VALUES ('$registration_no','$name','$gender','$rqualification','$file_name','$file_name','$file_path','$email','$r_pass','$status') ";
                

                    $len= count($rarea_of_interest);
                //echo $len;
                if( $len == 1){
                    $w1 = $rarea_of_interest[0];
                    $w2 = NULL;
                    $w3 = NULL;
                }
                elseif($len == 2){
                    $w1 = $rarea_of_interest[0];
                    $w2 = $rarea_of_interest[1];
                    $w3 = NULL;
                }
                else{
                    $w1 = $rarea_of_interest[0];
                    $w2 = $rarea_of_interest[1];
                    $w3 = $rarea_of_interest[2];
                }
                if($this->conn->query($sql)===true)
                {
                    //echo "inserted successfully";
                    $countquery = "select count(sl_no) as count from reviewers_area_of_intrest;";
                    $result2 = mysqli_query($this->conn,$countquery);
                    $val1 = $result2->fetch_array();
                    $sl_no = 1 + $val1['count'];

                    

                    $reviewer_intrest = "INSERT INTO reviewers_area_of_intrest VALUES ('$sl_no','$registration_no','$w1','$w2','$w3')";
                    $this->conn -> query($reviewer_intrest);
                    ?>
                    <div id='card' class="animated fadeIn">
                        <div id='upper-side'>
                            <img src="images/greenTick.png" alt="tick" id="w">
                                <h3 id='status'>Success</h3>
                        </div>
                        <div id='lower-side'>
                            <p id='message'>Your account has been successfully created.</p>
                            <p>Please LOGIN to Continue.</p>
                            <a href="login_reviewer.php" id="contBtn-r">LOGIN</a>
                            <script>
                                setTimeout(function(){
                                    location.href = "login_reviewer.php";
                                }, 8000);
                            </script>
                        </div>
                    </div>
                    <?php
                    }      
                
            }
            else{
                
                   ?>
                    <div id='card' class="animated fadeIn">
                        <div id='upper-side'>
                            <img src="images/wrong.png" alt="tick" id="r">
                            <h3 id='status'>Error 404!</h3>
                        </div>
                        <div id='lower-side'>
                            <p id='message'>Couldn't create an accout.</p>
                            <p>Please try again.</p>
                            <a href="reviewer_reg.php" id="contBtn-w">TRY AGAIN!!</a>
                            <script>
                                setTimeout(function(){
                                    location.href = "reviewer_reg.php";
                                }, 8000);
                            </script>
                        </div>
                    </div>

                    <?php
                
                //echo "Error....Please try again.";
            }
        }
                }
                
    }
    $rev_reg = new Reviewer();
    $rev_reg -> connection();
    $rev_reg -> register();    
?>


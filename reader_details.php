<link rel="stylesheet" href="css/style.css">
<?php
    include "header.php";
    class Reader{
        var $conn = "false";

        function connection(){
            $this -> conn = mysqli_connect("localhost", "root", "", "e_al");
            if($this -> conn === false){
                die("ERROR: Could not connect. ". mysqli_connect_error());
            }
        }
        function register(){
            if(isset($_POST['register'])){
                $fname =  $_POST['fname'];
            $lname = $_POST['lname'];
            $gender =  $_POST['gender'];
            $email = $_POST['email'];
            $rarea_of_interest = $_POST['reader_area'];
            $rpass = $_POST['reader_pass'];
            $cpass = $_POST['c_pass'];
            $name = $fname." ".$lname;
            
            $countsql = "select count(reader_id) as count from reader_registration;";
            $result = mysqli_query($this->conn,$countsql);
            $val = $result->fetch_array();
            
            $sql="SELECT `type_shortform` FROM `user_type` WHERE type='Reader'";
            $result1 = mysqli_query($this->conn,$sql);
            $res = $result1->fetch_array();
            $c=1+$val['count'];
            $reader_id = $res['type_shortform'].$c;

            if($reader_id != NULL && $name != NULL &&  $gender != NULL && $email != NULL && $rpass != NULL){
                $new_reader = "INSERT INTO reader_registration  VALUES ('$reader_id','$name','$gender','$email','$rpass')";
                
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

            if($this->conn -> query($new_reader) === true)
            {
                //echo "inserted successfully";
                $countquery = "select count(sl_no) as count from readers_area_of_intrest;";
                $result2 = mysqli_query($this->conn,$countquery);
                $val1 = $result2->fetch_array();
                $sl_no = 1 + $val1['count'];
                $reader_intrest = "INSERT INTO readers_area_of_intrest VALUES ('$sl_no','$reader_id','$w1','$w2','$w3')";
                $this->conn -> query($reader_intrest);
                ?>
                    <div id='card' class="animated fadeIn">
                        <div id='upper-side'>
                            <img src="images/greenTick.png" alt="tick" id="r">
                                <h3 id='status'>Success</h3>
                        </div>
                        <div id='lower-side'>
                            <p id='message'>Your account has been successfully created.</p>
                            <p>Please LOGIN to Continue.</p>
                            <a href="login_reader.php" id="contBtn-r">LOGIN</a>
                            <script>
                                setTimeout(function(){
                                    location.href = "login_reader.php";
                                }, 8000);
                            </script>
                        </div>
                    </div>
                    <?php
            }
            else
            {
                ?>
                    <div id='card' class="animated fadeIn">
                        <div id='upper-side'>
                            <img src="images/wrong.png" alt="tick" id="w">
                            <h3 id='status'>Error 404!</h3>
                        </div>
                        <div id='lower-side'>
                            <p id='message'>Couldn't create an accout.</p>
                            <p>Please try again.</p>
                            <a href="reader_reg.php" id="contBtn-w">TRY AGAIN!!</a>
                            <script>
                                setTimeout(function(){
                                    location.href = "reader_reg.php";
                                }, 8000);
                            </script>
                        </div>
                    </div>

                    <?php
            }
            }
            }
        }
    }
    $reg = new Reader();
    $reg -> connection();
    $reg -> register();
?>
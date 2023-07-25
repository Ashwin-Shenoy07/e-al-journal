<link rel="stylesheet" href="css/style.css">
<?php
include "header.php";

    class Writer{
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
            $qualification = $_POST['wqualification'];
            $warea_of_interest = $_POST['warea'];
            $wpass = $_POST['wpass'];
            $cpass = $_POST['cpass'];
            
            $name = $fname." ".$lname;
            
            $countsql = "select count(writer_id) as count from writer_registration;";
            $result = mysqli_query($this->conn,$countsql);
            $val = $result->fetch_array();
            
            $sql="SELECT type_shortform FROM user_type WHERE type='Writer'";
            $result1 = mysqli_query($this->conn,$sql);
            $res = $result1->fetch_array();
            $c=1+$val['count'];
            $writer_id = $res['type_shortform'].$c;

            if($writer_id != NULL && $name != NULL &&  $gender != NULL && $qualification != NULL && $email != NULL && $wpass != NULL ){
                $len= count($warea_of_interest);
                //echo $len;
                if( $len == 1){
                    $w1 = $warea_of_interest[0];
                    $w2 = NULL;
                    $w3 = NULL;
                }
                elseif($len == 2){
                    $w1 = $warea_of_interest[0];
                    $w2 = $warea_of_interest[1];
                    $w3 = NULL;
                }
                else{
                    $w1 = $warea_of_interest[0];
                    $w2 = $warea_of_interest[1];
                    $w3 = $warea_of_interest[2];
                }

                //echo $w1." ".$w2." ".$w3; 
                $sql = "INSERT INTO writer_registration VALUES ('$writer_id','$name','$gender','$qualification','$email','$wpass')";
                if($this->conn->query($sql)===true)
                {
                //echo "inserted successfully";
                $countquery = "select count(sl_no) as count from writers_area_of_intrest;";
                $result2 = mysqli_query($this->conn,$countquery);
                $val1 = $result2->fetch_array();
                $sl_no = 1 + $val1['count'];

                $writer_intrest = "INSERT INTO writers_area_of_intrest VALUES ('$sl_no','$writer_id','$w1','$w2','$w3')";
                if($this->conn -> query($writer_intrest)){
                    //echo "<br>"."inserted successfully";
                    ?>
                    <div id='card' class="animated fadeIn">
                        <div id='upper-side'>
                            <img src="images/greenTick.png" alt="tick" id="r">
                                <h3 id='status'>Success</h3>
                        </div>
                        <div id='lower-side'>
                            <p id='message'>Your account has been successfully created.</p>
                            <p>Please LOGIN to Continue.</p>
                            <a href="login_writer.php" id="contBtn-r">LOGIN</a>
                            <script>
                                setTimeout(function(){
                                    location.href = "login_writer.php";
                                }, 8000);
                            </script>
                        </div>
                    </div>
                    <?php
                }
            }else{               
            
        ?>
                    <div id='card' class="animated fadeIn">
                        <div id='upper-side'>
                            <img src="images/wrong.png" alt="tick" id="w">
                            <h3 id='status'>Error 404!</h3>
                        </div>
                        <div id='lower-side'>
                            <p id='message'>Couldn't create an accout.</p>
                            <p>Please try again.</p>
                            <a href="writer_reg.php" id="contBtn-w">TRY AGAIN!!</a>
                            <script>
                                setTimeout(function(){
                                    location.href = "writer_reg.php";
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
    $writer_reg = new Writer();
    $writer_reg -> connection();
    $writer_reg -> register();
?>
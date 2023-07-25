<link rel="stylesheet" href="css/style.css">
<?php
    class Reader{
        var $conn = "false";

        function connection(){
            $this -> conn = mysqli_connect("localhost", "root", "", "e_al_journal");
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
                    $w2 = '-';
                    $w3 = '-';
                }
                elseif($len == 2){
                    $w1 = $rarea_of_interest[0];
                    $w2 = $rarea_of_interest[1];
                    $w3 = '-';
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
                if($this->conn -> query($reader_intrest)){
                    header("Location: display.php");
                }
                
            }
            else
            {
                ?>
                    <div>
                        
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
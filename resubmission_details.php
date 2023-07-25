<link rel="stylesheet" href="css/style.css">
<?php
include "header.php";
    class Article_submission{
        var $conn = "false";

        function connection(){
            $this -> conn = mysqli_connect("localhost", "root", "", "e_al");
            if($this -> conn === false){
                die("ERROR: Could not connect. ". mysqli_connect_error());
            }
        }
        function ReSubmit(){
            if(isset($_POST['submit'])){
                $paper_id = $_POST['paper_id'];
                //echo $paper_id;
                $file_name = $_FILES['re_file']['name'];
                $file_tmp_name = $_FILES['re_file']['tmp_name'];
                $file_path = "uploads/resubmission/" . $file_name;
                move_uploaded_file($file_tmp_name,"uploads/resubmission/" . $file_name);
                        //echo "File uploaded successfully.";
                
                $sql ="select paper_id from submission_files where paper_id='$paper_id'";
                $sql_res = mysqli_query($this->conn,$sql);
                $sql_row = $sql_res->fetch_assoc();
                //echo $sql_row['paper_id'];
                if ($paper_id === $sql_row['paper_id']){
                    $update ="update submission_files set file2='$file_name',file2_name='$file_name',file2_path='$file_path' where paper_id='$paper_id';";
                    if($this->conn->query($update)===true)
                        {
                            //echo "inserted successfully";
                            ?>
                        <div id='card' class="animated fadeIn">
                            <div id='upper-side'>
                                <img src="images/greenTick.png" alt="tick" id="r">
                                    <h3 id='status'>Success</h3>
                            </div>
                            <div id='lower-side'>
                                <p id='message'>Resubmission Successful.</p>
                                <a href="writer_profile.php" id="contBtn-r">Continue</a>
                                <script>
                                    setTimeout(function(){
                                        location.href = "writer_profile.php";
                                    }, 8000);
                                </script>
                            </div>
                        </div>
                        <?php
                        }else
                        {
                            //echo "<div class='errmsg'><h3>Error in submitting file!</h3>ERROR: Could Not Connect Query: $sql.".$this->conn->error."</div>";
                            ?>
                        <div id='card' class="animated fadeIn">
                            <div id='upper-side'>
                                <img src="images/wrong.png" alt="tick" id="w">
                                <h3 id='status'>Error 404!</h3>
                            </div>
                            <div id='lower-side'>
                                <p id='message'>Couldn't Resubmit.</p>
                                <p>Please try again.</p>
                                <a href="writer_profile.php" id="contBtn-w">TRY AGAIN!!</a>
                                <script>
                                    setTimeout(function(){
                                        location.href = "writer_profile.php";
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
    $art_sub = new Article_submission();
    $art_sub -> connection();
    $art_sub -> ReSubmit();    
?>
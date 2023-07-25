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
        function FinalSubmit(){
            if(isset($_POST['submit'])){
                $paper_id = $_POST['paper_id'];
                //echo $paper_id;
                
                $finalfile_name = $_FILES['final_file']['name'];
                $finalfile_name_tmp_name = $_FILES['final_file']['tmp_name'];
                $finalfile_name_path = "uploads/final_submission/" . $finalfile_name;
                move_uploaded_file($finalfile_name_tmp_name,"uploads/final_submission/" . $finalfile_name);

                $copy_name = $_FILES['copy']['name'];
                $copy_tmp_name = $_FILES['copy']['tmp_name'];
                $copy_path = "uploads/final_submission/" . $copy_name;
               move_uploaded_file($copy_tmp_name,"uploads/final_submission/" . $copy_name);


                $cover_name = $_FILES['cover']['name'];
                $cover_tmp_name = $_FILES['cover']['tmp_name'];
                $cover_path = "uploads/final_submission/" . $cover_name;
                move_uploaded_file($cover_tmp_name,"uploads/final_submission/" . $cover_name);

                $acceptance = $_FILES['accept']['name'];
                $acceptance_tmp_name = $_FILES['accept']['tmp_name'];
                $acceptance_path = "uploads/final_submission/" . $acceptance;
                move_uploaded_file($acceptance_tmp_name,"uploads/final_submission/" . $acceptance);
 
                
                $status ="pending";
                $sql ="select paper_id from submission_files where paper_id='$paper_id'";
                $sql_res = mysqli_query($this->conn,$sql);
                $sql_row = $sql_res->fetch_assoc();
                $paper_id1 = $sql_row['paper_id'];
                //echo $paper_id1;

                $sql2 = "select status from article_review where paper_id='$paper_id';";
                $sql2_res = mysqli_query($this->conn,$sql2);
                $sql2_row = $sql2_res->fetch_assoc();
                $status1 = $sql2_row['status'];
                //echo $status1;


                $status ="pending";
                $date = Date('Y-m-d');
                if($paper_id === $paper_id1 && $status1 === 'approved'){

                $insert = "INSERT INTO artical_final_submission(`paper_id`, `final_file`, `final_filename`, `final_filepath`, `copyright`, `copy_filename`, `copy_filepath`,`coverletter`, `cover_filename`, `cover_filepath`, `acceptance_letter`, `accept_filename`, `accept_filepath`, `status`, `date`) VALUES ('$paper_id','$finalfile_name','$finalfile_name','$finalfile_name_path','$copy_name','$copy_name','$copy_path','$cover_name','$cover_name','$cover_path','$acceptance','$acceptance','$acceptance_path','$status','$date')";
                    //echo $insert;
                    if($this->conn->query($insert)===true)
                        {
                            //echo "inserted successfully";
                            ?>
                        <div id='card' class="animated fadeIn">
                            <div id='upper-side'>
                                <img src="images/greenTick.png" alt="tick" id="r">
                                    <h3 id='status'>Success</h3>
                            </div>
                            <div id='lower-side'>
                                <p id='message'>Final Submission Successful.</p>
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
                                <p id='message'>Couldn't submit.</p>
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
    $art_sub -> FinalSubmit();    
?>
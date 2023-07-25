<link rel="stylesheet" href="css/style.css">
<?php
include "header.php";
    $conn = mysqli_connect("localhost", "root", "", "e_al");
    if($conn === false){
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }
    
            if(isset($_POST['submit'])){
                $paper_id = $_POST['paper_id'];
                $r_id = $_POST['r_id'];
                //echo $paper_id;
                $comment = $_POST['comment'];
                //echo $paper_id;
                //echo $r_id;
                //echo $comment;
                $file_name = $_FILES['re_file']['name'];
                $file_tmp_name = $_FILES['re_file']['tmp_name'];
                $file_path = "uploads/reviewed_file/" . $file_name;
                move_uploaded_file($file_tmp_name,"uploads/reviewed_file/" . $file_name);
                        //echo "File uploaded successfully."; 
                $status = "reviewed";
                $insert ="INSERT INTO `article_review`(`paper_id`, `reviewed_id`, `reviewed_file`, `reviewed_filename`, `reviewed_filepath`, `comment`, `status`) 
                VALUES ('$paper_id','$r_id','$file_name','$file_name','$file_path','$comment','$status')";
                if($conn->query($insert)===true)
                {
                    //$update = "update article_review set paper_status='revivewed' where paper_id='$paper_id'";
                    //$conn->query($update);
                    //echo "inserted successfully";
                    ?>
                        <div id='card' class="animated fadeIn">
                            <div id='upper-side'>
                                <img src="images/greenTick.png" alt="tick" id="r">
                                    <h3 id='status'>Success</h3>
                            </div>
                            <div id='lower-side'>
                                <p id='message'>Reviewed successfully.</p>
                                <a href="reviewer_profile.php" id="contBtn-r">Continue</a>
                                <script>
                                    setTimeout(function(){
                                        location.href = "reviewer_profile.php";
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
                                <p id='message'>Review unsuccessful.</p>
                                <p>Please try again.</p>
                                <a href="reviewer_profile.html" id="contBtn-w">TRY AGAIN!!</a>
                                <script>
                                    setTimeout(function(){
                                        location.href = "reviewer_profile.html";
                                    }, 8000);
                                </script>
                            </div>
                        </div>
    
                        <?php
                }
    }
?>
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
        function InitialSubmit(){
            if(isset($_POST['submit'])){
                $title = $_POST['title'];
                $manuscript_type =  $_POST['manuscript_type'];
                $abstract =  $_POST['abstract'];
                $no_of_authors = $_POST['tt'];
    
                if( $no_of_authors == 1 ){
                    $id = $_POST['id1'];
                    $a_name = $_POST['a_name1'];
                    //echo "id=".$id;
                    //echo "name=".$a_name;
                }
                else{
                    $id1 = $_POST['id_1'];
                    $a_name1 = $_POST['a_name_1'];
                    $id2 = $_POST['id_2'];
                    $a_name2 = $_POST['a_name_2'];
                }
    
    
                $category = $_POST['category'];
                $no_of_pages = $_POST['no_of_pages'];
                $file_name = $_FILES['pdf_file']['name'];
                $file_tmp_name = $_FILES['pdf_file']['tmp_name'];
                $file_path = "uploads/initial_submission/" . $file_name;
                move_uploaded_file($file_tmp_name,"uploads/initial_submission/" . $file_name);
                        //echo "File uploaded successfully.";
                //}
                
                
                $countsql = "select count(paper_id) as count from article_submission;";
                $result = mysqli_query($this->conn,$countsql);
                $val = $result->fetch_array();
                
                
                $c=1+$val['count'];
                $paper_id = "P".$c;
                $paper_status = "pending";
                
    
                if ($paper_id != NULL && $title != NULL && $category != NULL && $manuscript_type != NULL &&  $abstract != NULL &&  $no_of_authors != NULL &&  $no_of_pages != NULL && $paper_status != NULL){
                    if( $no_of_authors == 1 ){
                        $writer_id2 = NULL;
                        $author_name2 = NULL;
             
                        $sql = "INSERT INTO `article_submission`(`paper_id`, `writer_id1`, `writer_id2`, `article_title`, `category`, `type`, `abstract`, `no_of_authors`, `author_name1`, `author_name2`, `no_of_pages`,`paper_status`) VALUES ('$paper_id','$id','$writer_id2','$title','$category','$manuscript_type','$abstract','$no_of_authors','$a_name','$author_name2','$no_of_pages','$paper_status');";
                        //echo $sql;
                        if($this->conn->query($sql)===true)
                        {
                            //echo "inserted successfully";
                            $filesql = "INSERT INTO `submission_files`(`paper_id`, `file1`,`file1_name`,`file1_path`) VALUES ('$paper_id','$file_name','$file_name','$file_path');";
                            $this->conn->query($filesql);
                            ?>
                        <div id='card' class="animated fadeIn">
                            <div id='upper-side'>
                                <img src="images/greenTick.png" alt="tick" id="r">
                                    <h3 id='status'>Success</h3>
                            </div>
                            <div id='lower-side'>
                                <p id='message'>Your Manuscript has been successfully submitted.</p>
                                <a href="writer_profile.php" id="contBtn-r">Continue</a>
                                <script>
                                    setTimeout(function(){
                                        location.href = "writer_profile.php";
                                    }, 8000);
                                </script>
                            </div>
                        </div>
                        <?php
                        }
                        else{
                            ?>
                        <div id='card' class="animated fadeIn">
                            <div id='upper-side1'>
                                <img src="images/wrong.png" alt="tick" id="w">
                                <h3 id='status'>Error 404!</h3>
                            </div>
                            <div id='lower-side'>
                                <p id='message'>Couldn't submit Manuscript.</p>
                                <p>Please try again.</p>
                                <a href="terms_conditions.html" id="contBtn-w">TRY AGAIN!!</a>
                                <script>
                                    setTimeout(function(){
                                        location.href = "terms_conditions.html";
                                    }, 8000);
                                </script>
                            </div>
                        </div>
    
                        <?php
    
                        }
                    }
                    else
                    {
                        $sql = "INSERT INTO `article_submission`(`paper_id`, `writer_id1`, `writer_id2`, `article_title`, `category`, `type`, `abstract`, `no_of_authors`, `author_name1`, `author_name2`, `no_of_pages`,`paper_status`) VALUES ('$paper_id','$id1','$id2','$title','$category','$manuscript_type','$abstract','$no_of_authors','$a_name1','$a_name2','$no_of_pages','$paper_status') ";
                        //echo $sql;
                        if($this->conn->query($sql)===true)
                        {
                            //echo "inserted successfully";
                            $filesql = "INSERT INTO `submission_files`(`paper_id`, `file1`,`file1_name`,`file1_path`) VALUES ('$paper_id','$file_name','$file_name','$file_path');";
                            $this->conn->query($filesql);
                            ?>
                        <div id='card' class="animated fadeIn">
                            <div id='upper-side'>
                                <img src="images/greenTick.png" alt="tick" id="r">
                                    <h3 id='status'>Success</h3>
                            </div>
                            <div id='lower-side'>
                                <p id='message'>Your Manuscript has been successfully submitted.</p>
                                <a href="writer_profile.php" id="contBtn-r">Continue</a>
                                <script>
                                    setTimeout(function(){
                                        location.href = "writer_profile.php";
                                    }, 8000);
                                </script>
                            </div>
                        </div>
                        <?php
                        }
                        else{
    
                            ?>
                        <div id='card' class="animated fadeIn">
                            <div id='upper-side1'>
                                <img src="images/wrong.png" alt="tick" id="w">
                                <h3 id='status'>Error 404!</h3>
                            </div>
                            <div id='lower-side'>
                                <p id='message'>Couldn't submit Manuscript.</p>
                                <p>Please try again.</p>
                                <a href="terms_conditions.html" id="contBtn-w">TRY AGAIN!!</a>
                                <script>
                                    setTimeout(function(){
                                        location.href = "terms_conditions.html";
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
}
    $art_sub = new Article_submission();
    $art_sub -> connection();
    $art_sub -> InitialSubmit();    
?>
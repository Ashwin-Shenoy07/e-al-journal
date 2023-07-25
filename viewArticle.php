<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ratings.css">
    <title>Document</title>
    <style>
        body{
            background: #1a2238;
        }
        .divide{
            display: flex;
            width: 100%;
        }
        .head-text{
            
    width: 30%;
    padding: 10px;
    border-top: 1px solid white;
    color: white;
        }
        .box{
            display: flex;
            
            padding: 5px;
            font-size: 18px;
        }
        #box{
            width:90%;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            border: 1px solid white;
            padding: 15px;
            font-size: 18px;
            border-radius: 5px;
        }
        .title{
            font-weight:600;
            
            /* border: 1px solid black; */
            padding: 5px;
        }
        .cen-title{
            text-align:center;
            padding: 5px;
            font-size:20px !important;
            text-decoration:underline;
        }
        .obj object{
            border-top: 1px solid white;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>
<?php
    $mysqli=new mysqli("localhost","root","","e_al");
    if($mysqli===false)
    {
        echo "ERROR: Could Not Connect.".mysqli_connect_error();
    }
        $val = $_POST['view'];
        //echo $val;
        
        


        $sql1 = "select * from published_article where publication_no = '$val'";
        $res1 = mysqli_query($mysqli, $sql1);
        $row1 = $res1->fetch_assoc();
        $sql2 = "select article_title,writer_id1,writer_id2,author_name1,author_name2,abstract,category,type,no_of_authors from article_submission where paper_id='".$row1['paper_id']."';";
        //echo $sql2;
        $res2 = mysqli_query($mysqli, $sql2);
        $row2 = $res2->fetch_assoc();
        $sql3 = "select final_filepath from artical_final_submission where paper_id='".$row1['paper_id']."';";
        $res3 = mysqli_query($mysqli, $sql3);
        $row3 = $res3->fetch_assoc();
            include "header.php";
            ?>
            <div class="divide">
                    <div class="head-text">
                        <div class="box">
                            <div class="title">Publication No : <?php echo $row1['publication_no'];?></div>
                            
                        </div>
                        <div class="box">
                            <div class="title">Paper ID : <?php echo $row1['paper_id'];?></div>
                        </div>
                        <div class="box">
                            <div class="title">Published Date : </td><td><?php echo $row1['date'];?></div>
                            
                        </div>
                        <div class="box">
                            <div class="title">Type : <?php echo $row2['type'];?></div>
                        </div>
                        <div class="box">
                            <div class="title">Category : <?php echo $row2['category'];?></div>
                        
                        </div>
                        <div class="box">
                            <div class="title">Author(s) : </div>
                            <div class="title">
                            <?php
                                if($row2['no_of_authors'] == 1){
                                    ?>
                                    <div id="cen-title"><?php echo $row2['author_name1'];?> (<?php echo $row2['writer_id1'];?>)</div>
                                    <?php
                                }else{
                                    ?>
                                    <div id="cen-title"><?php echo $row2['author_name1'];?> (<?php echo $row2['writer_id1'];?>)</div>
                                    <div id="cen-title"><?php echo $row2['author_name2'];?> (<?php echo $row2['writer_id2'];?>)</div>
                                    <?php
                                }
                            ?>
                            </div>
                        </div>
                        <div class="box">
                            <div class="title">Paper Title : <?php echo $row2['article_title'];?></div>
                            
                        </div>
                        
                        <div id="box">
                            <div class="cen-title">Abstract</div>
                            <div id="cen-title bk"><?php echo $row2['abstract'];?></div>
                        </div>
                        <div class="rating">
                        <form action="ratings.php" method="post">
                        <label class="rating-label"><strong>RATINGS</strong>
                        <?php
                            $reader_id = $_COOKIE['username'];
                        ?>
                            <input type="hidden" name="rid" value="<?php echo $reader_id;?>">
                            <input type="hidden" name="pid" value="<?php echo $row1['paper_id'];?>">
                            <input
                            class="rating rating--nojs"
                            max="5"
                            step="1"
                            type="range"
                            name="star">
                        </label>
                        <form action="ratings.php">
                            <p><label for="ratings"><strong>ADD FEEDBACK</strong></label></p>
                            <div class="textarea-container">
                                <textarea onkeydown="remainingChars(250, this)" placeholder="Enter Characters.." cols="52" rows="10" maxlength="250" name="com"></textarea>
                                <div><span id="remainingChars"> </span></div>
                            </div>
                            <input type="submit" name="comment" value="comment" class="comment">
                        </form>
                    </div>
                    </div>
                    
                <div class="obj">
                    <object data="<?php echo $row3['final_filepath']?>" type="application/pdf"  width="1250" height="1000">
                    </object>
                </div>
            </div>
            
            
            <?php
        
    
    include "footer.html";
?>
<script type="text/javascript">
            var remainingChars= function(maxChars, input){
              var totalChars= input.value.length;
              var remaining= (maxChars - totalChars);
              var displayChars=document.getElementById('remainingChars');
             
              if(remaining>0){
              displayChars.innerHTML="Remaining characters: "+remaining;
              displayChars.style.color="white";
              input.style.borderColor = "white";
              }else{
              displayChars.innerHTML="Remaining character: 0";
              displayChars.style.color="red";
              input.style.borderColor = "red";
              }
          }
          </script>
</body>
</html>
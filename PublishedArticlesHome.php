<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/published_article.css">
    <title>Document</title>
</head>
<body>
<h1 style="text-align:center;font-weight:600;padding:15px;">PUBLISHED</h1>
    <form action="viewArticle.php" method="post">
    <div class="article">
<?php
    $mysqli=new mysqli("localhost","root","","e_al");
    if($mysqli===false)
    {
        echo "ERROR: Could Not Connect.".mysqli_connect_error();
    }

    $sql = "select * from published_article";
    $sql_res = mysqli_query($mysqli,$sql);
    while($sql_row = $sql_res->fetch_array()){
        $p_no = $sql_row[0];
        $pap_no = $sql_row[1];
        
        $title = "select article_title,author_name1,author_name2,abstract from article_submission where paper_id='$pap_no';";
    $title_res = mysqli_query($mysqli,$title);
    $title_row = $title_res->fetch_array();

    $file = "select * from artical_final_submission where paper_id='$pap_no'";
    $file_res = mysqli_query($mysqli,$file);
    while($file_row = $file_res->fetch_array()){
        ?>
                <div class="art-card">
                    <img src="<?php echo $file_row[10]?>" id="img" alt="CoverLetter">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $title_row[0];?></h3>
                        <h4 class="card-ab" id="open" onclick='openAbstract("<?php echo $title_row[0];?>")'>Abstract</h4>
                        <p class="card-text" id="<?php echo $title_row[0];?>" style="display:none;"><?php echo $title_row[3];?></p>
                        <h4 class="card-text-title">Author(s)</h4>
                        <p class="card-text"><?php echo "<span>".$title_row[1]."</span><span style='float:right;'>".$title_row[2]."</span>"?></p>
                    </div>
                    
        <?php

    }
    ?>
                    <span class="btn-div">
                        <button type="submit" class="view-btn" name="view" value="<?php echo  $p_no?>">VIEW ARTICLE</button>
                    </span>
                </div>
    <?php
    
    }
    
    
?>
</form>
</div>
<script type="text/javascript">
    function openAbstract(a){
        var btn =document.getElementById(a);
        if(btn.style.display == "none"){
            btn.style.display = "block";
        }
    }
</script>
</body>
</html>
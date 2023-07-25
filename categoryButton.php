<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/published_article.css">
</head>
<body>
    <?php include "header.php";?>
    <form action="viewArticle.php" method="post">
<div class="article">
    <?php
    $conn=new mysqli("localhost","root","","e_al");
    if($conn===false)
    {
        echo "ERROR: Could Not Connect.".mysqli_connect_error();
    }
        $cat = $_POST['submit'];
        //echo $cat;
        $sql = "SELECT * from published_article as p,article_submission as a where p.paper_id=a.paper_id and a.category='$cat'";
        $sql_res = mysqli_query($conn,$sql);
        while($row = $sql_res->fetch_array()){
            ?>
                <div class="art-card">
                    <img src="<?php echo $file_row[10]?>" id="img" alt="CoverLetter">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $row[6];?></h3>
                        <h4 class="card-ab" id="open" onclick='openAbstract("<?php echo $row[6];?>")'>Abstract</h4>
                        <p class="card-text" id="<?php echo $row[6];?>" style="display:none;"><?php echo $row[9];?></p>
                        <h4 class="card-text-title">Author(s)</h4>
                        <p class="card-text"><?php echo "<span>".$row[11]."</span><span style='float:right;'>".$row[12]."</span>"?></p>
                    </div>
                    <span class="btn-div">
                        <button type="submit" class="view-btn" name="view" value="<?php echo  $p_no?>">VIEW ARTICLE</button>
                    </span>
                </div>
    <?php
        }
        
    ?>
</div>
</form>
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
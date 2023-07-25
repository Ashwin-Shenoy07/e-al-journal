<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
    <style>
        .cat-container{
            display: grid;
            grid-template-columns: repeat(6,5fr);  
        }
        .cat-btn{
            margin: 5px;
        }
        .cat-sub-btn{
            padding: 15px;
            width: 100%;
            background: #1a2238;
            color: white;
            text-transform: uppercase;
            border: 1px solid white;
            border-radius: 25px;
        }
        
    </style>
</head>
<body>
<h1 style="text-align:center;font-weight:600;padding:15px;">VISIT OUR TOPIC</h1>
    <div class="cat-container">
        
    <?php
    $mysqli=new mysqli("localhost","root","","e_al");
    if($mysqli===false)
    {
        echo "ERROR: Could Not Connect.".mysqli_connect_error();
    }


    $sql = "select area from interest_in";
    $res = mysqli_query($mysqli, $sql);
    while( $row = $res ->fetch_array()){
        ?>
        <div class="cat-btn">
            <form action="categoryButton.php" method="post">
                <input type="submit" name="submit" value="<?php echo $row['area'];?>" class="cat-sub-btn">
            </form>
        </div>
        <?php
    }
    ?>
    </div>
</body>
</html>
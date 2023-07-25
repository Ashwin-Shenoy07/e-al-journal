<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head Content</title>
    <style>
        body{
            padding:0;
            margin:0;
            
        }
        .head{
            display: flex;
            justify-content: space-around;
            padding: 5px;
            background: #1a2238;
            color: #ff6a3d;
        }
        .logo_img{
            margin: 25px 0px;
        }
        .head_text{
            margin-top: 15px;
            text-align: center;
        }
        .text{
            margin-top: 15px;
            font-size: 14px;
        }
        #logo_img{
            width:125px !important;
            height: 125px !important;
        }
    </style>
</head>
<body>
    <div class="head">
        <div class="logo_img">
            <img src="images/Alyosius.png" id="logo_img" alt="logo">
        </div>
        <div class="head_text">
            <h1>St Aloysius College (Autonomous), Mangaluru - 576003</h1>
            <p class="text">
                <?php
                    $file = fopen('aloysius.txt','r');
                    $a = 1;
                    while($line = fgets($file)){
                        echo($line)."<br>";
                        $a++;
                    }
                    fclose($file);


                ?>
            </p>
        </div>
    </div>
</body>
</html>
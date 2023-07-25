<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e Al Journal</title>
    <style>
        .search {
  width: 100%;
  position: relative;
  display: flex;
}

.searchTerm {
    width: 100%;
    border: 3px solid #1a2238;
    border-right: none;
    padding: 5px;
    height: 60px;
    border-radius: 5px 0 0 5px;
    outline: none;
    color: #ff6a3d;
}

.searchTerm:focus{
  color: #00B4CC;
}

.searchButton {
    width: 60px;
    height: 60px;
    border: 3px solid #1a2238;
    border-left: none;
    background: none;
    text-align: center;
    color: #fff;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    font-size: 20px;
}

/*Resize the wrap to see the search bar change!*/
.wrap{
    width: 50%;
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    margin-top: 2%;
}
.category{
    margin: 20px 10px;

}
.graphs{
    display: flex;
    margin-top:10px;
    position: relative;
}
.graph-right{
    position: relative;
    margin: 10px 75px;
}
.graph-right h2{
    position: relative;
    
    top: 30%;
    font-size: 48px;

}
.graph-right p{
    position: relative;
    top: 30%;
    width: 75%;
    font-size: 18px;
}
.graph-right a{
    position: relative;
    top: 40%;
    border: 1px solid #ff6a3d;
    padding: 20px 75px;
    font-size: 20px;
    text-decoration: none;
    background: #1a2238;
    margin: 15px;
    color: #ff6a3d;
}

.joinus{
    position: relative;
    margin-top: 100px;
    height: 20vh;
}
.joinus h2{
    text-align: center;
    width:75%;
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    font-size: 38px;
    padding: 20px;
}


.joinus-btn{
    text-align: center;
    margin-top:10px;
}

.joinus-btn a{
    border: 1px solid #ff6a3d;
    padding: 15px 50px;
    font-size: 20px;
    text-decoration: none;
    background: #1a2238;
    margin: 15px;
    color: #ff6a3d;
}

.joinus-btn a:hover,.graph-right a:hover{
    background: #ff6a3d;
    color: #1a2238;
    cursor: pointer;
}
.clgpic img{
    width: 100%;
    height: 25vh;
    margin-top: 5%;
}
    </style>
    
</head>
<body>
    <?php
        include 'header.php';
        include 'navbar.php';
    ?>
    
    <div class="wrap">
   <div class="search">
      <input type="text" class="searchTerm" placeholder="What are you looking for?">
      <button type="submit" class="searchButton">
        <img src="images/search.png" alt="S" width=30 height=30>
     </button>
   </div>
</div>
    <div class="category">
        <?php
            include "category.php";
        ?>
    </div>

    <div class="graphs">
        <div class="graph-right">
            <h2>Connect with your community</h2>
            <p>Share your journal,article or research, collaborate with your peers, and get the support you need to advance your career.</p>
            <a href="terms_conditions.html">Submit Manuscript</a>
        </div>
        <div class="graph1">
            <?php include "chart(submit).php";?>
        </div>
    </div>


    <div class="published">
        <?php include 'PublishedArticlesHome.php';?>
    </div>
    
    <div class="writers">
        <?php
            include "writers.php";
        ?>
    </div>

    
    <div class="graphs">
    
    <div class="graph1"><?php include "chart(reviewers).php";?></div>
    <div class="joinus ">
        <h2>Advance your research and join a community</h2>
        <div class="joinus-btn">
            <a href="writer_reg.php">Become An Author</a>
            <a href="reviewer_reg.php">Become An Editor</a>
        </div>
    </div>
    </div>
    <div class="clgpic">
        <img src="images/Collegepic.png" alt="">
    </div>
    <?php
        include 'footer.html';
    ?>
</body>
</html>
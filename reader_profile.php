<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reader Profile</title>
	<link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/profile1.css">
</head>
<body>
<?php
    include "header.php";
    include "reader_menu.html";
    $conn = mysqli_connect("localhost", "root", "", "e_al");
    if($conn === false){
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }
    include "PublishedArticlesHome.php";

    include "footer.html";
?>
	<script src="js/profile.js"></script>
</body>
</html>
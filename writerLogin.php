<link rel="stylesheet" href="css/style.css">
<?php
$mysqli=new mysqli("localhost","root","","e_al");
if($mysqli===false)
{
    echo "ERROR: Could Not Connect.".mysqli_connect_error();
}

if(!empty($_POST["username"])){
    setcookie("username",$_POST["username"],time()+300000);
}
else{
    setcookie("username","");
}
$user = $_POST['username'];
$pass = $_POST['password'];

$sql = "select email,password,name from writer_registration where email='$user' and password='$pass';";
$result = mysqli_query($mysqli,$sql);
$value = $result->fetch_array();

$name=$value['name'];

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if($value['email'] == $user && $value['password'] == $pass){
        header("Location: writer_profile.php");
    }
    else{
        ?>
                        <div id='card' class="animated fadeIn">
                            <div id='upper-side1'>
                                <img src="images/wrong.png" alt="tick" id="w" >
                                <h3 id='status'>Access Denied!</h3>
                            </div>
                            <div id='lower-side'>
                                <p id='message'>Invalid Username or Password.</p>
                                <p>Please try again.</p>
                                <a href="login_writer.php" id="contBtn-w">TRY AGAIN!!</a>
                                <script>
                                    
                                </script>
                            </div>
                        </div>
    
                        <?php
    }
}

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<div class="form">
  <h2>REVIEWER LOGIN</h2>
  <img src="images/login.png" alt="login_img" class="image">
  <form style="margin-block-start: 20px;display: flex;align-content: center;flex-direction: column;" method="post" action="reviewerLogin.php">
      <input type="text" name="username" placeholder="Username" value="<?php if(isset($_COOKIE["username"])){}?>" required>
      <input type="password" name="password" placeholder="Password" required>
	    <div class="forgot">
        <label>
        <input type="checkbox" name="rememberme" id="rem" value="remember" style="width: 30px;margin-left:-10px;" hidden>
         <a href="#" style="float: right;margin-block-start: 10px; font-size:12px;margin-right:50px;">Forgot Password?</a>
  	</div>
        <button type="submit" name="login">Login</button>
	<p class="message" style="color: #636663;text-align: center;font-size: 16px;"> Not registered? <a style="display: inline-block;width: 100px;text-align: center;padding: 3px 0;color:#1a2238;" href="reviewer_reg.php">Sign Up</a></p>
  </form>
</div> 
</body>
</html>
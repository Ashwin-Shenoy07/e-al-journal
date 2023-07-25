<html>
<head>
<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<div class="form">
  <h2>ADMIN LOGIN</h2>
  <img src="images/login.png" alt="login_img" class="image">
  <form style="margin-block-start: 20px;display: flex;align-content: center;flex-direction: column;" method="post" action="editorLogin.php">
      <input type="text" name="username" placeholder="Username" id="username"  value="<?php if(isset($_COOKIE["username"])){}?>" required>
      <input type="password" name="password" placeholder="Password" id="password" required>
	    <div class="forgot">
        <label>
        <input type="checkbox" name="rememberme" id="rem" value="remember" style="width: 30px;margin-left:-10px;" hidden>
        <a href="#" style="float: right;margin-block-start: 10px; font-size:12px;margin-right:50px;">Forgot Password?</a>
  	</div>
        <button type="submit" name="login">Login</button>
  </form>
</div> 
</body>
</html>
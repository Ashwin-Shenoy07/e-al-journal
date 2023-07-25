<html>
    <head>
        <title>writers registration</title>
        <link rel="stylesheet" type="text/css" href="css/registration.css">
        <script>
        function checkBoxLimit() {
	var checkBoxGroup = document.forms['writer_reg']['warea[]'];			
	var limit = 3;
	for (var i = 0; i < checkBoxGroup.length; i++) {
		checkBoxGroup[i].onclick = function() {
			var checkedcount = 0;
			for (var i = 0; i < checkBoxGroup.length; i++) {
				checkedcount += (checkBoxGroup[i].checked) ? 1 : 0;
			}
			if (checkedcount > limit) {
				console.log("You can select maximum of " + limit + " checkboxes.");
				alert("You can select maximum of " + limit + " checkboxes.");						
				this.checked = false;
			}
		}
	}
}
    </script>
    </head>
    <body>
        <?php
        include 'header.php';
        $conn = mysqli_connect("localhost", "root", "", "e_al");
        if($conn === false){
            die("ERROR: Could not connect. ". mysqli_connect_error());
        }
        ?>
        <div class="container">
            <div class="text-container">
                <p>
                    By registering yourself to this website you become a part of our community that will support you and 
                    unable you to share your research papers , journals and articles with a relevant global audience.
                </p>
                <p>
                    Our journals service niche and broader communities of researchers all over the world.
                    All of our journals are handled by dedicated editors and reviewers who are active in specific communities they serve.
                </p>
                <h5 class="text-container-head">Features</h5>
                <ul id="li-img">
                    <span class="li-img"><img src="images/li.jfif" alt="@">An easy-to-use submission process</span><br>
                    <span class="li-img"><img src="images/li.jfif" alt="@">Dedicated editors and reviewers who are active in their specific communities.</span><br>
                    <span class="li-img"><img src="images/li.jfif" alt="@">Retention of all ownership and copyright of your published research.</span><br>
                    <span class="li-img"><img src="images/li.jfif" alt="@">Greater impact, reach, and visibility of your research through open access.</span>
                </ul>
            </div>
            <div class="form-container">
                <h2 class="form-heading">REGISTER WITH US</h2>
                <div class="form-body">
                    <form action="writer_details.php" method="post" name="writer_reg">                
                        <fieldset class="field">
                            <legend>Name</legend>
                            <input type="text" name="fname" placeholder="First Name" onkeypress="return(event.charCode > 64 && event.charCode < 91 ) || (event.charCode > 96 && event.charCode < 123 )" required>
                            <input type="text" name="lname" placeholder="Last Name"  onkeypress="return(event.charCode > 64 && event.charCode < 91 ) || (event.charCode > 96 && event.charCode < 123 )" required>
                        </fieldset>    
                        <fieldset class="field">
                            <legend>Gender</legend>
                                <input type="radio" name="gender" id="gender" value="Male" checked="true"><label for="radioMale">Male</label>
                                <input type="radio" name="gender" id="gender" value="Female"><label for="radioFemale">Female</label>
                                <input type="radio" name="gender" id="gender" value="Others"><label for="radioOther">Other</label>
                        </fieldset>
                        <fieldset class="field">
                            <legend>Email</legend>
                                <input type="email" name="email" id="email" placeholder="abc@example.com"  required>
                        </fieldset>
                        <fieldset class="field">
                            <legend>Qualification</legend>
                                <select name="wqualification" id="qualification" class="drop-options">
                                    <option value="UG">Under Graduate</option>
                                    <option value="PG">Post Graduate</option>
                                    <option value="MD">Masters Degree</option>
                                    <option value="DOC">Doctorate</option>
                                    <option value="PD">Post Doctorate</option>
                                </select>
                        </fieldset>
                        <fieldset class="field">
                            <legend>Interest In</legend>
                                <span style="color:red; font-size:14px;">Select maximum 3.</span>
                                <br>
                                <?php
                                $a = "select * from interest_in;";
                                $res = mysqli_query($conn,$a);
                                while($row=$res->fetch_array())
		                        {
                                    for($i=0;$i<=1;$i++){
                                        if($i == 1)
				                        { 
                                            echo "<div><input type='checkbox' name='warea[]' value=$row[$i] id=$row[$i]>".$row[$i]."</div>";
                                        }
                                        else
                                        {
                                            continue;
                                        }
                                    }
                                }
                                ?>
                                <script type="text/javascript">checkBoxLimit()</script>
                            <br>
                        </fieldset>
                        <fieldset class="field">
                            <legend>Password</legend>
                                <input type="password" name="wpass" id="password" placeholder="password" required>
                                <input type="password" name="cpass" id="confirm_password" placeholder="confirm password" onchange="validatepass()" required>
                        </fieldset>
                        <div class="submit-btn">
                            Already Registered Please <a href="login_writer.php">LOGIN</a>
                            <input type="submit" value="Register" name="register">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
            include 'footer.html';
        ?>
        
        <script src="js/password_validation.js"></script> 
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/registration.css">
</head>
<body>
<div class="container">
            <div class="form-container">
                <h2 class="form-heading">ADD EDITOR</h2>
                <div class="form-body">
                    <form action="crud_editorpost.php" method="post" name="reader_reg">                
                        <fieldset class="field">
                            <legend>Name</legend>
                            <input type="text" name="name" placeholder="Name" onkeypress="return(event.charCode > 64 && event.charCode < 91 ) || (event.charCode > 96 && event.charCode < 123 )" required>
                        </fieldset>    
                        <fieldset class="field">
                            <legend>Gender</legend>
                                <input type="radio" name="gender" id="gender" value="Male" checked><label for="radioMale">Male</label>
                                <input type="radio" name="gender" id="gender" value="Female"><label for="radioFemale">Female</label>
                                <input type="radio" name="gender" id="gender" value="Others"><label for="radioOther">Other</label>
                        </fieldset>
                        <fieldset class="field">
                            <legend>Qualification</legend>
                                <select name="qualification" id="qualification" class="drop-options">
                                    <option value="UG">Under Graduate</option>
                                    <option value="PG">Post Graduate</option>
                                    <option value="MD">Masters Degree</option>
                                    <option value="DOC">Doctorate</option>
                                    <option value="PD">Post Doctorate</option>
                                </select>
                        </fieldset>
                        <fieldset class="field">
                            <legend>Email</legend>
                                <input type="email" name="email" id="email" placeholder="abc@example.com" required>
                        </fieldset>
                        <fieldset class="field">
                            <legend>Username</legend>
                                <input type="text" name="user" id="email" required>
                        </fieldset>
                        <fieldset class="field">
                            <legend>Password</legend>
                                <input type="password" name="a_pass"  placeholder="password" required>
                                <input type="password" name="c_pass" placeholder="confirm password" onchange="validatepass()" required>
                        </fieldset>
                        <div class="submit-btn">
                        <input type="submit" value="Register" name="register">
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="js/password_validation.js"></script>
</body>
</html>
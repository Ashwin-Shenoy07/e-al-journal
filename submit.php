<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title>submission</title>
      <link rel="stylesheet" href="css/submission.css">
  </head>
  
  <body class="page">
    <form class="signup-form" action="submission_details.php" method="post" name="sub-frm" enctype="multipart/form-data">
      <!-- form header -->
      <div class="form-header">
        <h1>Submit Your Work!!!!</h1>
      </div>

      <!-- form body -->
      <div class="form-body" style="margin-top: 0px;">
        <div class="horizontal-group">
          <div class="form-group left">
            <label for="title" class="label-title">Manuscript Title </label>
            <input type="text" name="title" id="title" class="form-input" placeholder="Title of the article" required>
          </div>
          <div class="form-group right">
            <label class="label-title">Manuscript Type </label>
            <select class="form-input" id="level" name="manuscript_type">
              <option value="journal">Journal</option>
              <option value="article">Review article</option>
              <option value="research_paper">Research paper</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="abstract" class="label-title">Abstract</label>
          <textarea class="form-input" rows="4" cols="50" name="abstract" style="height:auto" required></textarea>
        </div>

        <!-- Number of Authors -->
        <div class="horizontal-group">
	        <div class="form-group">
            <!--<label for="no_of_authors" class="label-title">No of Authors</label>
              <label for="chkNo">
                <input type="radio" id="chkNo" name="chk" value="1" checked>1
              </label>
              <label for="chkYes">
                <input type="radio" id="chkYes" name="chk" value="2">2
              </label>-->
              <label for="no_of_authors" class="label-title">No of Authors</label>
              <br>
              <input type="radio" name="tt" value="1" onclick="doDisplay(this);" /> 1
                
              <input type="radio" name="tt" value="2" onclick="doDisplay(this);"/> 2
              <br>  
              <span id="one_author" style="display:none">
                <span class="label-title">Writer ID</span>
                <input type="text" name="id1" class="form-input" placeholder="ID 1"/>
                <span class="label-title">Writer Name</span>
                <input type="text" name="a_name1" class="form-input" placeholder="name" />
              </span>
              <span id="two_author" style="display:none">
                <span class="label-title">Writer ID</span>
                <input type="text" name = "id_1" class="form-input" placeholder="ID 1" />
                <span class="label-title">Writer Name</span>
                <input type="text" name = "a_name_1" class="form-input" placeholder="name" />
                <span class="label-title">Writer ID</span>
                <input type="text" name = "id_2" class="form-input" placeholder="ID 2" />
                <span class="label-title">Writer Name</span>
                <input type="text" name = "a_name_2" class="form-input" placeholder="name"/>
              </span>
              <br>
          </div>
        </div>

        <!-- Category and number of pages section -->
        <div class="horizontal-group">
          <div class="form-group left">
            <label class="label-title">Category</label>
            <div class="input-group"> 
              <select class="form-input" id="level" name="category">
              <?php
                $conn = mysqli_connect("localhost", "root", "", "e_al");
                if($conn === false){
                    die("ERROR: Could not connect. ". mysqli_connect_error());
                }
                $interest_in = "select * from interest_in;";
                $res = mysqli_query($conn,$interest_in);
                echo "<option value=''>select...</option>";
                while($row=$res->fetch_assoc())
                {
                  $area=$row['area'];
                ?>
                  <option value="<?php echo $area;?>"><?php echo $area;?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group right">
            <label class="label-title">No of Pages</label>
            <div >
              <select class="form-input" id="level" name="no_of_pages">
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>	       
              </select>
            </div>
          </div>
        </div>

        <!--Upload article-->
        <div class="form-group">
	        <div class="form-group left" >
            <label for="file" class="label-title">Upload Manuscript</label>
	          <div>
              <input type="file" name="pdf_file" id="choose-file" required>
            </div>
          </div>
        </div>
      </div>
      <!-- form-footer -->
      <div class="form-footer">
        <span></span>
        <!--<button type="submit" name="submit" class="btn">Submit</button>-->
        <input type="submit" value="submit" name="submit"  class="btn">
      </div>
      <script src="js/radio.js"></script>
    </form>
  </body>
</html>
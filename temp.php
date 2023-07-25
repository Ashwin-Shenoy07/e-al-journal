<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title>submission</title>
      <link rel="stylesheet" href="css/submission.css">
  </head>
  
  <body class="page">
    <form class="signup-form" action="writer_profile.php" method="post" enctype="multipart/form-data">
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
            <label for="no_of_authors" class="label-title">No of Authors</label>
              <label for="chkNo">
                <input type="radio" id="chkNo" name="chk" onclick="ShowHideDiv()" value="1" checked="true"/>1
              </label>
              <label for="chkYes">
                <input type="radio" id="chkYes" name="chk" onclick="ShowHideDiv()" value="2" />2
              </label>
              <div id="dvtext">
                <fieldset>
                  <legend>Author Details</legend>
                  <table>
                      <tr>
                        <td>ID</td>
                        <td><input type="text" name="id" id="txtBox"  class="form-input" placeholder="ID " required></td>
                        <td>Name</td>
                        <td><input type="text" name="a_name" id="txtBox"  class="form-input" placeholder="Name" required></td>
                      </tr>
                  </table>
                </fieldset>
              </div>
              <div id="dvtext1" style="display: none;">
                <fieldset>
                  <legend>Author details</legend>
                    <table>
                      <tr>
                        <td>ID</td>
                        <td><input type="text" name="id1" id="txtBox"  class="form-input" placeholder="ID 1" required></td>
                        <td>Name</td>
                        <td><input type="text"  name="a_name1" id="txtBox"  class="form-input" placeholder="Name 1" required></td>
                      </tr>
                      <tr>
                        <td>ID</td>
                        <td><input type="text" name="id2" id="txtBox"  class="form-input" placeholder="ID 2" required></td>
                        <td>Name</td>
                        <td><input type="text" name="a_name2" id="txtBox"  class="form-input" placeholder="Name 2" required></td>
                      </tr>
                    </table>
                </fieldset>
              </div>
          </div>
        </div>

        <!-- Category and number of pages section -->
        <div class="horizontal-group">
          <div class="form-group left">
            <label class="label-title">Category</label>
            <div class="input-group"> 
              <select class="form-input" id="level" name="category">
                <option value="computer science">computer science</option>
                <option value="journalism">journalism</option>
                <option value="medical science">medical science</option>
                <option value="sports">sports</option>
                <option value="education">education</option>
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

        <!--Upload article
        <div class="form-group">
	        <div class="form-group left" >
            <label for="file" class="label-title">Upload Manuscript</label>
	          <div>
              <input type="file" name="pdf_file" id="choose-file" required>
            </div>
          </div>
        </div>-->
      </div>
      <!-- form-footer -->
      <div class="form-footer">
        <span></span>
        <!--<button type="submit" name="submit" class="btn">Submit</button>-->
        <input type="submit" value="submit" name="submit"  class="btn">
      </div>

    </form>
    <script type="text/javascript">
      function ShowHideDiv() {
        var chkYes = document.getElementById("chkYes");
        var dvtext = document.getElementById("dvtext");
        var dvtext1 = document.getElementById("dvtext1");
        dvtext1.style.display = chkYes.checked ? "block" : "none";
        dvtext.style.display = chkYes.checked ? "none" : "block";
    }
    </script>
  </body>
</html>
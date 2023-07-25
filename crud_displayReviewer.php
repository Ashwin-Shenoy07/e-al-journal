<!DOCTYPE html>
<html>
<head>
 <title></title>

 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

 <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
   <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

</head>
<body>
<?php include "editor_menu.html";?>
 <div class="container">
 <div class="col-lg-12">
 <br><br>
 <h1 style="text-align:center;color:#1a2238;"> REVIEWERS</h1>
 <br>
 <table  id="tabledata" class=" table table-striped table-hover table-bordered">
 
 <tr class="bg-dark text-white text-center">
 
 <th> Id </th>
 <th> Name </th>
 <th> Gender </th>
 <th> Email </th>
 <th> Qualification </th>
 
 <th colspan="3"> Area of Interest </th>
 <th> Operation </th>

 </tr >

 <?php

$conn = mysqli_connect("localhost", "root", "", "e_al");
if($conn === false){
    die("ERROR: Could not connect. ". mysqli_connect_error());
}
 $q = "select * from reviewer_registration as rr,approved_reviewers as ap where rr.registration_no=ap.registration_no;";

 $query = mysqli_query($conn,$q);

 while($res = mysqli_fetch_assoc($query)){
  $q1 = "select intrest1,intrest2,intrest3 from reviewers_area_of_intrest where registration_no='".$res['registration_no']."'";
  $query1 = mysqli_query($conn,$q1);
  $res1= $query1->fetch_assoc();
 ?>
 <tr class="text-center">
 <td> <?php echo $res['reviewer_id'];  ?> </td>
 <td> <?php echo $res['name'];  ?> </td>
 <td> <?php echo $res['gender'];  ?> </td>
 <td> <?php echo $res['email'];  ?> </td>

 <td> <?php echo $res['r_qualification'];  ?> </td>
 <td> <?php echo $res1['intrest1'];  ?> </td>
 <td> <?php echo $res1['intrest2'];  ?> </td>
 <td> <?php echo $res1['intrest3'];  ?> </td>
 <td> <button class="btn-danger btn"> <a href="crud_deleteReviewer.php?id=<?php echo $res['registration_no']; ?>" class="text-white"> Delete </a>  </button> </td>


 </tr>

 <?php 
 }
  ?>
 
 </table>  

 </div>
 </div>

 <script type="text/javascript">
 
 $(document).ready(function(){
 $('#tabledata').DataTable();
 }) 
 
 </script>

</body>
</html>






<?php
  $con=mysqli_connect("localhost","root","","e_al");
  if($con==false){
      die("ERROR: Could not connect.".mysqli_connect_error());
  }
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Gender','count'],
         <?php
         $sql = "SELECT count(*) as count,gender from reviewer_registration as a, approved_reviewers as i where a.registration_no = i.registration_no group by a.gender";
         $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['gender']."',".$result['count']."],";
          }

         ?>
        ]);
        var options = {
          title: 'Male and Female Reviwers'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
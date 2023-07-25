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
      google.charts.setOnLoadCallback(drawChart1);

      function drawChart1() {
        var data1 = google.visualization.arrayToDataTable([
          ['category', 'count'],
         <?php
         $sql = "SELECT count(*) as count,category from article_submission as a, interest_in as i where a.category = i.area GROUP by i.area";
         $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['category']."',".$result['count']."],";
          }

         ?>
        ]);
        var options1 = {
          title: 'Submitted Articles Based on Category'
        };

        var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));

        chart1.draw(data1, options1);
      }
    </script>
  </head>
  <body>
    <div id="piechart1" style="width: 900px; height: 500px;"></div>
  </body>
</html>
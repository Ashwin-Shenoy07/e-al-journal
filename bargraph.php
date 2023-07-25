<?php
  $con=mysqli_connect("localhost","root","","e_al_journal");
  if($con==false){
      die("ERROR: Could not connect.".mysqli_connect_error());
  }
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['date', 'count'],
          <?php
            $query = "SELECT paper_id,COUNT(*)AS COUNT FROM article_submission";
            $res=mysqli_query($conn,$query);
            while($data=mysqli_fetch_array($res)){
                $query2 = "SELECT date FROM published_article where paper_id='$data[1]'";
                $res2=mysqli_query($conn,$query2);
                $data2=mysqli_fetch_array($res2);
                $date=$data2['date'];
                $count=$data['count'];
              //  $count1=$data2['count1'];
                
             ?>
             ['<?php echo $date;?>',<?php echo $sale;?>,<?php// echo $count1;?>],   
             <?php   
              }
             ?> 
          ]);
          var options = {
          chart: {
            title: 'Submitted Articles',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="barchart_material" style="width: 900px; height: 500px;"></div>
  </body>
</html>
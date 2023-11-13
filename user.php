<?php
session_start();
include_once"headeruser.php";

    $host = 'localhost';
    $user = 'u690288683_pos_main';
    $pass = 'Pharmaciadimaano01.';
    $db = 'u690288683_pos_main';
    $mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
    
    $data1 = '';
    $data2 = '';
    $data3 = '';
    $data4 = '';
    $data5 = '';
    $data6 = '';
    $data7 = '';


    $sql = "SELECT order_date, SUM(total) AS total_due FROM tbl_invoice GROUP BY order_date";
    $sql1 = "SELECT product_name, SUM(qty) AS total FROM table_invoice_details GROUP BY product_name";
    $sql2 = "SELECT pcategory, SUM(pstock) AS total FROM tbl_product GROUP BY pcategory";
    $sql3 =  "SELECT SUM(total) AS total FROM `tbl_invoice`";

    $result = mysqli_query($mysqli, $sql);
    $result1 = mysqli_query($mysqli, $sql1);
    $result2 = mysqli_query($mysqli, $sql2);
    $result3 = mysqli_query($mysqli, $sql3);

    //loop through the returned data
    while ($row = mysqli_fetch_array($result)) {

        $data1 = $data1 . '"'. $row['order_date'].'",';
        $data2 = $data2 . '"'. $row['total_due'] .'",';
        
    }

    $data1 = trim($data1,",");
    $data2 = trim($data2,",");
    
    while ($row = mysqli_fetch_array($result1)) {

        $data3 = $data3 . '"'. $row['product_name'] .'",';
        $data4 = $data4 . '"'. $row['total'] .'",';
    }

  
    $data3 = trim($data3,",");
    $data4 = trim($data4,",");
    
    while ($row = mysqli_fetch_array($result2)) {

        $data5 = $data5 . '"'. $row['pcategory'] .'",';
         $data6 = $data6 . '"'. $row['total'] .'",';
         
      
    }

  
    $data5 = trim($data5,",");
     $data6 = trim($data6,",");
     
     while ($row = mysqli_fetch_array($result3)) {

        $data7 = $data7 . '"'. $row['total'] .'",';
     
      
    }

  
    $data7 = trim($data7,",");


?>

<style>
    .chart {
  float: left;
  width: 200%;  
}


/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
  
}
#box{
 
  justify-content: center;
  text-align: center;
}

</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"  style="overflow:scroll; height:400px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">SALES AND INVENTORY REPORT</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="logout.php">LOGOUT</a></li>
              <li class="breadcrumb-item active"><a href="#">Admin Dashboard</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row" >
          <div class="col-lg-6">
            <div class="card" style="width: 200%">
                <div class="row">
              <div id="box">
                  <h4 style="color:white;">REPORT</h4>
                
                 <canvas class="chart" id="myChart">
                     
                 </canvas>
            </div>
            <div id="box">
                 <h4>SALES PER DAY</h4>
                 <canvas class="chart" id="myChart1"></canvas>
            </div>
            <div id="box"  style="margin-left:30px;">
                 <h4>TOP PURCHASED ITEM</h4>
                 <canvas class="chart" id="myChart2"></canvas>
            </div>
            <div id="box">
                <h4>CATEGORY</h4>
                 <canvas class="chart" id="myChart3">
                     
                 </canvas>
            </div>
 
            </div>
              
              
            </div>

           
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
         
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
         <script>
                var ctx = document.getElementById("myChart1").getContext('2d');
                var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [<?php echo $data1; ?> ],
                    datasets: 
                    [{
                        label: 'ORDER DATE',
                        data: [<?php echo $data1; ?>],
                        backgroundColor: 'transparent',
                        borderColor:'rgba(255,99,132)',
                        borderWidth: 3
                    },

                    {
                        label: 'SALES',
                        data: [<?php echo $data2; ?>, ],
                        backgroundColor: 'transparent',
                        borderColor:'rgba(0,255,255)',
                        borderWidth: 3  
                    }]
                },

                options: {
                    scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                    tooltips:{mode: 'index'},
                    legend:{display: false},
                    plugins: {title: {display: true, text: 'Custom Chart Title'}}
                    
                }
            });
            </script>
            
            <script>
                var ctx = document.getElementById("myChart2").getContext('2d');
                var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php echo $data3; ?> ],
                    datasets: 
                    [

                    {
                        label: 'TOTAL PURCHASED',
                        data: [<?php echo $data4; ?>, ],
                        backgroundColor: 'transparent',
                        borderColor:'rgba(0,255,255)',
                        borderWidth: 3  
                    }]
                },

                options: {
                    scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                    tooltips:{mode: 'index'},
                    legend:{display: false},
                    plugins: {title: {display: true, text: 'Custom Chart Title'}}
                    
                }
            });
            </script>
            
            <script>
                var ctx = document.getElementById("myChart3").getContext('2d');
                var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [<?php echo $data5; ?> ],
                    datasets: 
                    [{
                        label: 'ORDER DATE',
                        data: [<?php echo $data6; ?>],
                        backgroundColor: 'transparent',
                        borderColor:'rgba(255,99,132)',
                        borderWidth: 3
                    }]
                },

                options: {
                    scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                    tooltips:{mode: 'index'},
                    legend:{display: false},
                    plugins: {title: {display: true, text: 'Custom Chart Title'}}
                    
                }
            });
            </script>
    
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

 <?php
include_once"footer.php";


?>
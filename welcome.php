<!--  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->

 <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> -->
  <script src="iAjax.js"></script>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-header">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php 
                /*Storage scan pending*/

                $Query1="SELECT * FROM grn WHERE status=0 AND grn_del=0";
                $Result1=mysql_query($Query1);
                $Num1=mysql_num_rows($Result1);


                 ?>
                <h3><?=$Num1.' Nos'?></h3>

                <p>Pending for Storage Scan</p>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-bag"></i>
              </div> -->
              <a href="index.php?act=grn_report_summary&status=0"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php
                $Query2="SELECT * FROM grn WHERE status=1 AND grn_del=0";
                $Result2=mysql_query($Query2);
                $Num2=mysql_num_rows($Result2);
              ?>
                <h3><?=$Num2.' Nos'?><!-- <sup style="font-size: 20px">%</sup> --></h3>

                <p>Pending For QC</p>
              </div>
             <!--  <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div> -->
              <a href="index.php?act=grn_report_summary&status=1"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">

                <?php 
                    $Query3="SELECT * FROM dispatch WHERE Dispatch_Status=0";
                    $Result3=mysql_query($Query3);
                    $Num3=mysql_num_rows($Result3);
                 ?>
                <h3><?=$Num3.' Nos'?></h3>

                <p>Dispatch Issue Not Picked</p>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
              <a href="index.php?act=dispatch_plan_report_summary&status=0" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <?php 
                    $Query4="SELECT * FROM prod_route_card WHERE STATUS=0";
                    $Result4=mysql_query($Query4);
                    $Num4=mysql_num_rows($Result4);
                 ?>
                <h3><?=$Num4.' Nos'?></h3>

                <p>Production Issue Not Picked</p>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div> -->
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
        
                <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title text-bold text-lg">Overview</h3>
                 <!--  <a href="javascript:void(0);">View Report</a> -->
                 
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                 <!--    <span class="text-bold text-lg">$18,230.00</span> -->
                    <span >Numbers</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <!-- <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span> -->
                    <select id="month_selection" name="month_selection" class=" form-control" onchange="Barchart_data();">
                      <option value="">--Select--</option>
                      <?php 
                        for($i=0;$i<=11;$i++){
                        $month=date('F',strtotime("first day of -$i month"));

                        $current_month= date('F');
                         ?>
                         <option value="<?=$month?>" <?php if($current_month==$month){  ?> selected="selected" <?php } ?> > <?=$month?></option>
                         <?php 
                        }

                       ?>
                    </select>
                    <span class="text-muted">In Month</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> Completed
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Pending
                  </span>
                </div>
              </div>
            </div>






          

          
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
            <!-- Calendar -->
           <!--  piechart -->


            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-bold text-lg">Stock Details</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <canvas id="pieChart" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix">
              <li><i class="fas fa-circle" style="color: #ff9999;"></i> Expired</li>
              <li><i class="fas fa-circle" style="color: #ffbf80;"></i> Less than 1 month</li>
              <li><i class="fas fa-circle" style="color: #ffff80;"></i> Less than 6 months</li>
              <li><i class="fas fa-circle" style="color: #80ff80;"></i> More than 6 months</li>
              <li><i class="fas fa-circle" style="color: #e6e6e6;"></i> QC Not Done</li>
                       </ul>
                       <span class="users-list-date">Value in Percentage (%)</span>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
           
              <!-- /.footer -->
            </div>


            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<!-- <script src="dist/js/pages/dashboard.js"></script>
  <script src="dist/js/demo.js"></script>  -->

  <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<!-- <script src="dist/js/adminlte.min.js"></script> -->
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- <script src="dist/js/pages/dashboard3.js"></script> -->

<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<!-- page script -->

<script>
  $(function () { 
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */



Barchart_data();

  
  })


var myChart=1;
  function Barchart_data()
{

  var selected_month = document.getElementById('month_selection').value;
//alert(selected_month);

  data = 'ask=get_storage_data&selected_month=' + selected_month;

        iAjax("ajax_welcome_data.php?" + data, getresult);
}



function getresult(result){
   var dt= JSON.parse(result);
   console.log(dt);
    var completed_scan=dt['completed_scan'];
    var pending_to_scan=dt['pending_to_scan'];

    var qc_completed=dt['qc_completed'];
    var qc_pending=dt['qc_pending'];

    var dispatch_pending=dt['dispatch_pending'];
    var dispatch_completed=dt['dispatch_completed'];

    var expired=dt['expired'];
    var qc_not_done=dt['qc_not_done'];
    var onemonthperiod=dt['onemonthperiod'];
    var moresixmonth=dt['moresixmonth'];
    var normal=dt['normal'];

    var total_val=dt['total_value'];

    var expired1=((expired/total_val) * 100).toFixed(3) ;
    var qc_not_done1=((qc_not_done/total_val) * 100).toFixed(3) ;
    var onemonthperiod1=((onemonthperiod/total_val) * 100).toFixed(3) ;
    var moresixmonth1=((moresixmonth/total_val) * 100).toFixed(3) ;
    var normal1=((normal/total_val) * 100).toFixed(3) ;



    //console.log(pending_to_scan);

'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }
  var mode      = 'index'
  var intersect = true

     var $salesChart = $('#sales-chart')
if(window.bar != undefined) 
window.bar.destroy();

  window.bar   = new Chart($salesChart, {
    type   : 'bar',
    data   : {
      labels  : ['PUT AWAY', 'QC', 'DESPATCH'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor    : '#007bff',
          data           : [completed_scan, qc_completed, dispatch_completed]
        },
        {
          backgroundColor: '#ced4da',
          borderColor    : '#ced4da',
          data           : [pending_to_scan, qc_pending, dispatch_pending]
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: true,
            /*maxTicksLimit: 20,*/
            labelString: 'Nos',

            // Include a dollar sign in the ticks
            callback: function (value, index, values) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }
              return  value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })




  /*piechart*/



      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = {
      labels: [
          'Expired', 
          'Less than 1 month',
          'Less than 6 months', 
          'More than 6 months', 
          'QC Not Done', 
          
      ],
      datasets: [
        {
          data: [expired1,onemonthperiod1,moresixmonth1,normal1,qc_not_done1],
          backgroundColor : ['#ff9999', '#ffbf80', '#ffff80', '#80ff80', '#e6e6e6'],
        }
      ]
    }
    var pieOptions     = {
      legend: {
        display: false
      }
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions      
    })


}




</script>

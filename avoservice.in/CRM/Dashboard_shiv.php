<?php session_start();
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include("header.php");?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
</head>
<body class="sidebar-pinned ">
 <?php include("vertical_menu.php")?>
<main class="admin-main">
    <!--site header begins-->
<header class="admin-header">




    <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>

    <nav class=" mr-auto my-auto">
        <ul class="nav align-items-center">

            <li class="nav-item">
                <a class="nav-link  " data-target="#siteSearchModal" data-toggle="modal" href="#">
                    <i class=" mdi mdi-magnify mdi-24px align-middle"></i>
                </a>
            </li>
        </ul>
    </nav>
  
    
    <nav class=" ml-auto">
        <ul class="nav align-items-center">
           
            <li class="nav-item">
                <div class="dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-24px mdi-bell-outline"></i>
                        <span class="notification-counter"></span>
                    </a>

                    <div class="dropdown-menu notification-container dropdown-menu-right">
                        <div class="d-flex p-all-15 bg-white justify-content-between border-bottom ">
                            <a href="#!" class="mdi mdi-18px mdi-settings text-muted"></a>
                            <span class="h5 m-0">Notifications</span>
                            <a href="#!" class="mdi mdi-18px mdi-notification-clear-all text-muted"></a>
                        </div>
                        <div class="notification-events bg-gray-300">
                            <div class="text-overline m-b-5">today</div>
                            <a href="#" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body"> <i class="mdi mdi-circle text-success"></i> All systems operational.</div>
                                </div>
                            </a>
                            <a href="#" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body"> <i class="mdi mdi-upload-multiple "></i> File upload successful.</div>
                                </div>
                            </a>
                            <a href="#" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="mdi mdi-cancel text-danger"></i> Your holiday has been denied
                                    </div>
                                </div>
                            </a>


                        </div>

                    </div>
                </div>
            </li>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#"   role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-sm avatar-online">
                        <span class="avatar-title rounded-circle bg-dark">V</span>

                    </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right"   >
                    <a class="dropdown-item" href="#">  Add Account
                    </a>
                    <a class="dropdown-item" href="#">  Reset Password</a>
                    <a class="dropdown-item" href="#">  Help </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"> Logout</a>
                </div>
            </li>

        </ul>

    </nav>
</header>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark ">
            <div class="container-fluid m-b-30">
                <div class="row">
                    <div class="text-white col-lg-6">
                        <div class="p-all-15">
                            <div class="text-overline m-t-10 opacity-75">
                                Your Portfolio Balance
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-md-12 p-b-60">
                        <div id="chart-09" class="chart-canvas invert-colors"></div>
                        
                        <div id="container1" class="chart-canvas invert-colors"></div>
                        
                    
                    </div>
                </div>
            </div>
        </div>
   <!-- <div id="chart">
</div>
-->

     <?php
       date_default_timezone_set('Asia/Kolkata');
       $dates = date('Y-m-d');
       
       $FirstDate=date('Y-m-01');
       $LastDate=date('Y-m-t');
       
      $start_year= date("Y-1-01");
     $end_year = date("Y-12-t", strtotime($start_year));

       
        $sql   ="select count(Lead_id) from Leads_table where date(Creation)='".$dates."'";
        $runsql  =mysqli_query($conn,$sql);
        $fetchrun=mysqli_fetch_array($runsql);
        
        $sqlLead   ="select count(Lead_id) from Leads_table where date(Creation) between '".$FirstDate."' and '".$LastDate."'";
        $runsqlLead  =mysqli_query($conn,$sqlLead);
        $fetchMonthLead=mysqli_fetch_array($runsqlLead);
        
         
       /* $yearLead   ="select count(Lead_id) from Leads_table where leadEntryef='".$_SESSION['id']."' and date(Creation) between '".$start_year."' and '".$end_year."'";
        $yearLead  =mysqli_query($conn,$yearLead);
        $fetchyearLead=mysqli_fetch_array($yearLead);
      
   */
          
         
         $sqldele  ="SELECT COUNT(LeadId) FROM `LeadDelegation` WHERE  LeadId  IN (select Lead_id from Leads_table WHERE Status='5') and date(DelegatedTIme)='".$dates."'";
        
        $runsqldel  =mysqli_query($conn,$sqldele);
        $fetchrundel=mysqli_fetch_array($runsqldel);
        
  
         $sqlmo  ="SELECT COUNT(LeadId) FROM `LeadDelegation` WHERE  LeadId  IN (select Lead_id from Leads_table WHERE Status='5') and  date(DelegatedTIme) between '".$FirstDate."' and '".$LastDate."'";
        // echo $sqldele;
        $runsqlmo  =mysqli_query($conn,$sqlmo);
        $fetchrunmo=mysqli_fetch_array($runsqlmo);
        
        
      
        
        $qry_reg1= mysqli_query($conn,"select COUNT(Lead_id) from Leads_table where Status='3' or Excel='1' ");
       $qry_fetch1= mysqli_fetch_array($qry_reg1);
        
        
        //echo $fetchrundel[0];
      
        ?>


        <div class="container-fluid pull-up">
            <div class="row">
                <a href="prospect_view.php">
                                <div class="col m-b-30">
                    <div class="card ">
                        <div class="   text-center card-body">
                            <div class="text-success   ">
                                <div class="avatar avatar-sm ">
                                    
                                   <?php if($fetchrun[0]!=0){?>
                                    <span class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                    <?php }else{ ?>
                                     <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                    <?php } ?>
                                </div>
                               <!-- <h6 class="m-t-5 m-b-0"> 19%</h6>-->
                            </div>


                            <div class=" text-center">
                                <h3><?php echo $fetchrun[0];?> </h3>
                            </div>
                            <div class="text-overline ">
                                TODAY'S LEADS
                            </div>
                        </div>
                    </div>
                </div></a>
                <a href="prospect_view.php">
                <div class="col m-b-30">
                    <div class="card ">
                        <div class="   text-center card-body">
                            <div class="text-danger   ">
                                <div class="avatar avatar-sm ">
                                    <?php if($fetchMonthLead[0]!=0){?>
                                    <span class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                    <?php }else{ ?>
                                     <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                    <?php } ?>
                                </div>
                                <!--<h6 class="m-t-5 m-b-0"> 32%</h6>-->
                            </div>


                            <div class=" text-center">
                                <h3><?php echo $fetchMonthLead[0];?> </h3>
                            </div>
                            <div class="text-overline ">
                                MONTHLY LEADS
                            </div>
                        </div>
                    </div>
                </div></a>
                <a href="Members_view.php">
                <div class="col m-b-30">
                    <div class="card ">
                        <div class="   text-center card-body">
                            <div class="text-warning   ">
                                <div class="avatar avatar-sm ">
                                    <?php if($fetchrundel[0]!=0){?>
                                    <span class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                    <?php }else{ ?>
                                     <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                    <?php } ?>
                                </div>
                                <!--<h6 class="m-t-5 m-b-0"> 74%</h6>-->
                            </div>


                            <div class=" text-center">
                                <h3><?php echo $fetchrundel[0];?> </h3>
                            </div>
                            <div class="text-overline ">
                                TODAY'S LEADS CONVERTED
                            </div>
                        </div>
                    </div>
                </div></a>
                 <a href="Members_view.php">
                <div class="col m-b-30">
                    <div class="card ">
                        <div class="   text-center card-body">
                            <div class="text-info   ">
                                <div class="avatar avatar-sm ">
                                     <?php if($fetchrunmo[0]!=0){?>
                                    <span class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                    <?php }else{ ?>
                                     <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                    <?php } ?>
                                </div>
                                <!--<h6 class="m-t-5 m-b-0"> 36%</h6>-->
                            </div>


                            <div class=" text-center">
                                <h3><?php echo $fetchrunmo[0];?> </h3>
                            </div>
                            <div class="text-overline ">
                               MONTHLY LEADS CONVERTED
                            </div>
                        </div>
                    </div>
                </div></a>
                <a href="suspendLead_view.php">
                <div class="col  m-b-30">
                    <div class="card ">
                        <div class="   text-center card-body">
                          <div class="text-danger   ">
                                <div class="avatar avatar-sm ">
                                   <?php if($fetchyearLead[0]!=0){?>
                                    <span class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                    <?php }else{ ?>
                                     <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                    <?php } ?>
                                </div>
                                 <!-- <h6 class="m-t-5 m-b-0"> 49%</h6>-->
                            </div>


                            <div class=" text-center">
                                <h3><?php echo $qry_fetch1[0]?></h3> </h3>
                            </div>
                            <div class="text-overline ">
                                SUSPEND LEADS
                            </div>
                        </div>
                    </div>
                </div>
                </a>
                <div class="col visible-xlg m-b-30">
                    <div class="card">
                        <div class="text-center card-body">
                            <div class="text-success   ">
                                <div class="avatar avatar-sm ">
                                    <?php if($fetchrun[0]!=0){?>
                                    <span class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                    <?php }else{ ?>
                                     <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                    <?php } ?>
                                </div>
                                <h6 class="m-t-5 m-b-0"> 85%</h6>
                            </div>


                            <div class=" text-center">
                                <h3>$82,580 </h3>
                            </div>
                            <div class="text-overline ">
                                mobile ads
                            </div>
                        </div>
                    </div>
                </div>

            </div></div>
            

            
            
            
    </section>

</main>

<div class="modal modal-slide-left  fade" id="siteSearchModal" tabindex="-1" role="dialog" aria-labelledby="siteSearchModal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body p-all-0" id="site-search">
                <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="form-dark bg-dark text-white p-t-60 p-b-20 bg-dots" >
                    <h3 class="text-uppercase    text-center  fw-300 "> Search</h3>

                    <div class="container-fluid">
                        <div class="col-md-10 p-t-10 m-auto">
                            <input type="search" placeholder="Search Something"
                                   class=" search form-control form-control-lg">

                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="bg-dark text-muted container-fluid p-b-10 text-center text-overline">
                        results
                    </div>
                    <div class="list-group list  ">


                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"   src="assets/img/users/user-3.jpg" alt="user-image"></div>
                            </div>
                            <div class="">
                                <div class="name">Eric Chen</div>
                                <div class="text-muted">Developer</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                                                    src="assets/img/users/user-4.jpg" alt="user-image"></div>
                            </div>
                            <div class="">
                                <div class="name">Sean Valdez</div>
                                <div class="text-muted">Marketing</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                                                    src="assets/img/users/user-8.jpg" alt="user-image"></div>
                            </div>
                            <div class="">
                                <div class="name">Marie Arnold</div>
                                <div class="text-muted">Developer</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar-title bg-dark rounded"><i class="mdi mdi-24px mdi-file-pdf"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">SRS Document</div>
                                <div class="text-muted">25.5 Mb</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar-title bg-dark rounded"><i
                                                class="mdi mdi-24px mdi-file-document-box"></i></div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">Design Guide.pdf</div>
                                <div class="text-muted">9 Mb</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar avatar-sm  ">
                                        <div class="avatar-title bg-primary rounded"><i
                                                    class="mdi mdi-24px mdi-code-braces"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">response.json</div>
                                <div class="text-muted">15 Kb</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar-title bg-info rounded"><i
                                                    class="mdi mdi-24px mdi-file-excel"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">June Accounts.xls</div>
                                <div class="text-muted">6 Mb</div>
                            </div>








                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/vendor/popper/popper.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendor/select2/js/select2.full.min.js"></script>
<script src="assets/vendor/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/vendor/listjs/listjs.min.js"></script>
<script src="assets/vendor/moment/moment.min.js"></script>
<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/atmos.min.js"></script>
<!--page specific scripts for demo-->

<!--Additional Page includes-->
<script src="assets/vendor/apexchart/apexcharts.min.js"></script>
<!--chart data for current dashboard-->
<script src="assets/js/dashboard-03.js"   ></script>
<script>
    $(function () {
    var chart1 = new Highcharts.Chart({
    
        chart: {
            renderTo: 'container1',
            zoomType: 'xy',
        }, title: {
                text: 'shiv bhai hero hai hahhaha'
            },
             subtitle: {
                text:'Click and drag in the plot area to zoom in : Pinch the chart to zoom in'
            },
               
        xAxis: {
               startOnTick: false,
               endOnTick: false,
               categories: [1],
                title: {
                    text: 'days of months '
                }
        },
        yAxis: {
                title: {
                    text: 'jo mann kare likh loo anand bhai '
                }
            },
            
            legend: {
                enabled: true
            },
        
  
        series: [{
            data: [
                ["abc", 10 ],
                ["def",  20],
                [ "xyz", 35],
                [ "anand", 32 ],
                [ "ram", 65 ],
                [ "xyz", 41],
                [ "ram", 62 ],
                [ "ram", 65 ],
                [ "xyz", 44],
                [ "anand", 5 ],
                [ "ram", 6 ],
                [ "shiv", 8 ] ]
        }]
    
    });


});


</script>
</body>
</html>


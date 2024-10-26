<?php session_start();
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("header.php");?>

</head>
<body class="sidebar-pinned page-home">
    
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
                   <!-- <a class="dropdown-item" href="#">  Add Account
                    </a>-->
                   <!-- <a class="dropdown-item" href="#">  Reset Password</a>
                    <a class="dropdown-item" href="#">  Help </a>-->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"> Logout</a>
                </div>
            </li>

        </ul>

    </nav>
</header>
<!--site header ends -->    <section class="admin-content">
        <div class="container-fluid bg-dark m-b-30">
            <div class="row">

                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4 class="  "><span class="btn btn-white-translucent"><i
                                    class="mdi mdi-shape-circle-plus "></i></span> <span class="js-greeting"></span>,
                        
                        
                        
                        <?php echo $_SESSION['user'];?>!</h4>
                    <p class="opacity-75 ">
                       
                        Thank you for participating in the lead generation exercise for the membership of your hotel.<br /> Start by clicking on new Prospect or track your productivity on the dashboard. Good luck.
                    </p>
                    <!--<a href="#" class="btn btn-white-translucent">View Reports</a>-->

                </div>
            </div>
        </div>
      
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
                                <div class="avatar avatar-sm-6 ">
                                    
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
                                <div class="avatar avatar-sm-6 ">
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
                                <div class="avatar avatar-sm-6 ">
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
                                <div class="avatar avatar-sm-6 ">
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
                                <div class="avatar avatar-sm-6 ">
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

            </div>



<!--<div class="container ">
            <div class="row">
                <div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-account-multiple h1 m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20">21.32k</h1>
                                    <p class="text-muted fw-600">Total Followers</p>
                                    <div class="text-success h5 fw-600">
                                        <i class="mdi mdi-arrow-up"></i> 112.6%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-danger"><i
                                                class="mdi mdi-heart h1 m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20">300</h1>
                                    <p class="text-muted fw-600">New Likes</p>
                                    <div class="text-danger h5 fw-600">
                                        <i class="mdi mdi-arrow-up"></i> 112.6%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-info"><i
                                                class="mdi mdi-eye-settings-outline h1 m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20">750</h1>
                                    <p class="text-muted fw-600">Reach</p>
                                    <div class="text-info h5 fw-600">
                                        <i class="mdi mdi-arrow-up"></i> 35.69%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-dark"><i
                                                class="mdi mdi-vector-intersection h1 m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20">16.56%</h1>
                                    <p class="text-muted fw-600">Engagement Rate</p>
                                    <div class="text-dark h5 fw-600">
                                        <i class="mdi mdi-arrow-down"></i> 12%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
           
                
            </div>-->
           
        </div>


         <div class="row">
                <div class="col-lg-8  m-b-30">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Leads and Member Count Graph in a month</div>

                            <div class="card-controls">

                                <a href="#" class="js-card-refresh icon"> </a>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                class="icon mdi  mdi-dots-vertical"></i> </a>

                                   <!-- <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>-->
                                </div>
                            </div>

                        </div>
                        <div class="card-body">


                            <div id="chart-17"></div>
                        </div>
                        <div class="">
                        </div>
                        <div class="card-footer">
                            <div class="d-flex  justify-content-between">
                                <h6 class="m-b-0 my-auto"><span class="opacity-75"> <i class="mdi mdi-information"></i> Restart your Re-targeting Campaigns</span>
                                </h6>
                                <a href="#!" class="btn btn-white shadow-none">See Campaigns</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 m-b-30">
                    <div class="card full-height d-flex align-items-center justify-content-center  ">
                        <div class="card-controls">

                            <a href="#" class="js-card-refresh icon"> </a>
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                            class="icon mdi  mdi-dots-vertical"></i> </a>

                                <!--<div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Action</button>
                                    <button class="dropdown-item" type="button">Another action</button>
                                    <button class="dropdown-item" type="button">Something else here</button>
                                </div>-->
                            </div>
                        </div>
                        <div class="text-center">

                           
                        </div>
                        <div class="bg-img m-h-30 w-100"
                            </div>
                    </div>
                </div>
            </div>

<!--widget card begin-->
                       
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
<script src="assets/js/dashboard-01.js"   ></script>
<!--<script src="assets/js/dashboard-05.js"   ></script>-->
<script>


gaph();
          function graph(){
  
    
         $.ajax({
                    type:'POST',
                    url:'getMonthlyLeadForManager_Dashboard.php',
                     data:'',
                     
                    success:function(msg){


                       var month_dateLead=[];
                       var month_LeadCount=[];
                       var month_dateMem=[];
                       var month_MemCount=[];
                       var jsr=JSON.parse(msg);
                       for(var i=0;i<jsr.length;i++){
                           month_dateLead.push(parseInt(jsr[i]["Leaddate"]));
                           month_LeadCount.push(parseInt(jsr[i]["LCount"]));
                           month_dateMem.push(jsr[i]["MemDate"]);
                           month_MemCount.push(parseInt(jsr[i]["MCount"]));
                           
                       }
    
    if ($("#chart-17").length) {

        var options = {
            colors: [colors[14], colors[4]],
            chart: {

                type: 'bar',
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    endingShape: 'rounded',
                    columnWidth: '55%',
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            series: [{
                name: 'Leads',
                data: month_LeadCount
            }, {
                name: 'Members',
                data: month_MemCount
            }],
            xaxis: {
                categories:month_dateLead,
            },

            fill: {
                opacity: 1

            },
            // legend: {
            //     floating: true
            // },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return  val 
                    }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart-17"),
            options
        );

        chart.render();
    }
   
    
                    }
             
         });
}
</script>


</body>
</html>
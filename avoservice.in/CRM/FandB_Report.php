<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
   <!-- <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">-->
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
<script>
function searchfiltter(){
    var  FromDt=document.getElementById('FromDt').value;
    var  Todt=document.getElementById('Todt').value;
   
  if(FromDt==""){
          swal("Please Select From Date");
      }else if(Todt==""){
          swal("Please Select To Date");
      }
    
   else{
   
             $.ajax({
                    type:'POST',
                    url:'POSsearch_Filtter.php',
                     data:'FromDt='+FromDt+'&Todt='+Todt,
                    
                    success:function(msg){
                     // alert(msg);
                      $("#chart").empty();
                       $("#chart02").empty();
                        $('#setTable').empty();
                         $("#hd_text1").hide();
                          $('#hd_text2').hide();
                        
                        
                        
                           var json=$.parseJSON(msg);
                         
                            if(json[0].City!=null){
                                
                                for(var i=0;i<json.length;++i){
                                $('#setTable').append('<tr role="row" class="odd" ><td class="sorting_1">'+json[i].City+'</td><td>'+json[i].No_of_Sales+'</td><td>'+json[i].No_of_Pax+'</td><td>'+json[i].No_of_paxClose+'</td><td>'+json[i].FoodAmt+'</td><td>'+json[i].FoodDiscAmt+'</td><td>'+json[i].SoftBevAmt+'</td><td>'+json[i].SoftBevDiscAmt+'</td><td>'+json[i].IndianLiqAmt+'</td><td>'+json[i].IndianLiqDiscAmt+'</td><td>'+json[i].ImpLiqAmt+'</td><td>'+json[i].ImpLiqDiscAmt+'</td><td>'+json[i].NettAmount+'</td> </tr>');
                                }
                                graph4(FromDt,Todt);
                     
                            }
                            else{
                                 $('#setTable').append('<tr role="row" class="odd" ><th class="sorting_1">Record Not Found</th></tr>');
                            }
                    }
                }) 
                     
                   
                      
                   
                    
    }
    }
    </script>
</head>
<body class="sidebar-pinned">


<?php include("vertical_menu.php")?>
<main class="admin-main">
  <?php include('navbar.php');?>
  
    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> view F & B Report 
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="container  pull-up">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                                   <div class="form-row">
                               
                                  
                                   <div class="form-group col-md-3">
                                  <input type="text" class="js-datepicker form-control" id="FromDt" name="FromDt" autocomplete="off" placeholder="From Date">
                                  </div><div class="form-group col-md-3">
                                  <input type="text" class="js-datepicker form-control" id="Todt" name="Todt" autocomplete="off" placeholder="To Date">
                                  </div><div class="form-group col-md-3">
                                   <input type="button" class="btn btn-primary" onclick="searchfiltter()" value="Search">
                               </div>
                             
                              </div>
                            
                            
                            
                            
                            <div class="table-responsive p-t-10">
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                    <tr>
                                                               
                                                                 
                                         <th> Row Labels</th>
                                         <th> No of Sales</th>
                                         <th> Sum of No of Pax</th>
                                         <th> Sum of No of pax close</th> 
                                         <th> Sum of Food Amt</th>
                                         <th>Sum of Food Disc Amt</th>
                                         <th> Sum of Soft Bev Amt</th>
                                         <th> Sum of Soft Bev Disc Amt</th> 
                                         <th>Sum of Indian Liq Amt</th>
                                         <th>Sum of Indian Liq Disc Amt</th>
                                         <th>Sum of Imp Liq Amt</th>
                                         <th> Sum of Imp Liq Disc Amt</th>
                                         <th>Sum of Nett Amount</th> 
                                          
                                    </tr>
                                    </thead>
                                    <tbody id="setTable">
                                        
                           
	                     </tbody>
                                    
                                </table>
                            </div>   
                            
                            
                            <div class="row">
            
            <div class="cols-md-8">
        <form name="frm" method="post" action="exporDER.php" target="_new">
<input type="hidden" name="qr" id="qr" value="<?php echo $View; ?>" readonly>
<!--<input type="submit" name="cmdsub" value="Export" class="btn btn-primary"> <span>(From here you can Export MAX 860 Record at one Time.)</span>
--></form>
</div>&nbsp;&nbsp;
 <div class="cols-md-4">
<form name="frm" method="post" action="Leadpdf/report.php" target="_new">
<input type="hidden" name="qr1" id="qr1" value="<?php echo $View; ?>" readonly>
<input type="hidden" name="From1" id="From1"  readonly>
<input type="hidden" name="To1" id="To1"  readonly>
<!--<input type="submit" name="cmdsub" value="Generate PDF" class="btn btn-primary">
--></form>
</div></div>



                        </div>
                        
                        <div class="row">
                                <div class="cols-md-6" style="position: relative;padding-left: 15px;border-right-width: 73px;padding-right: 58px;"><h3 align="center" id="hd_text1" style="display:none">Comparison Graph</h3><div id="chart"></div></div>
                                <div class="cols-md-6" ><h3 align="center" id="hd_text2" style="display:none">Sum Of Amount Graph</h3><div id="chart02"></div></div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        
                            

        
    </section>

</main>
<?php include('belowScript.php');?>
<script src="assets/vendor/DataTables/datatables.min.js"></script>
<!--<script src="assets/js/datatable-data.js"></script>-->

<script src="assets/vendor/apexchart/apexcharts.min.js"></script>





<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto);

body {
  font-family: Roboto, sans-serif;
}

#chart {
  max-width: 650px;
  margin: 35px auto;
}
#chart02 {
  max-width: 650px;
  margin: 35px auto;
}

</style>

<script>
      
            function graph5(FromDt,Todt){
                  $.ajax({
                    type:'POST',
                    url:'getFandB_Details_Dashboard.php',
                    data:'FromDt='+FromDt+'&Todt='+Todt,
                     
                    success:function(msg){
                       // alert(msg);
                       
                       $("#chart02").empty();
                       
                          $('#hd_text2').show();
                       if(msg!=""){
                       
                      var Mumbai=[];
                       var Pune=[];
                       
                       
                       var jsr=JSON.parse(msg);
                   
                      
                      
                            
                            Mumbai.push(parseInt(jsr[0]["No_of_Pax"]));
                            Mumbai.push(parseInt(jsr[0]["No_of_paxClose"]));
                            Mumbai.push(parseInt(jsr[0]["FoodAmt"]));
                            Mumbai.push(parseInt(jsr[0]["SoftBevAmt"]));
                            Mumbai.push(parseInt(jsr[0]["IndianLiqAmt"]));
                            Mumbai.push(parseInt(jsr[0]["ImpLiqAmt"]));
                           
                            Pune.push(parseInt(jsr[1]["No_of_Pax"]));
                            Pune.push(parseInt(jsr[1]["No_of_paxClose"]));
                            Pune.push(parseInt(jsr[1]["FoodAmt"]));
                            Pune.push(parseInt(jsr[1]["SoftBevAmt"]));
                            Pune.push(parseInt(jsr[1]["IndianLiqAmt"]));
                            Pune.push(parseInt(jsr[1]["ImpLiqAmt"]));
                     
                
                 var options = {
            chart: {
                height: 750,
                width: 500,
                type: 'bar',
                 
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'	
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
                name: 'Mumbai',
                data: Mumbai
            }, {
                name: 'Pune',
                data: Pune
            }],
            xaxis: {
                categories: ['NO OF PAX', 'NO OF PAX CLOSE', 'FOOD AMT', 'SOFT BEV AMT', 'INDIAN LIQ AMT', ' IMP LIQ AMT'],
            },
            
            fill: {
                opacity: 1

            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return  val 
                    }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart02"),
            options
        );

        chart.render();
       
 }}
                }) 
                  
                  
                 
          }
          
          
          
          





            function graph4(FromDt,Todt){
                
                
                   $.ajax({
                    type:'POST',
                    url:'getFandB_Details_Dashboard.php',
                    data:'FromDt='+FromDt+'&Todt='+Todt,
                     
                    success:function(msg){
                       // alert(msg);
                       
                       $("#chart").empty();
                       $("#hd_text1").show();
                       if(msg!=""){
                       
                      var Mumbai=[];
                       var Pune=[];
                       
                       
                       var jsr=JSON.parse(msg);
                   
                      
                      
                            
                            Mumbai.push(parseInt(jsr[0]["No_of_Pax"]));
                            Mumbai.push(parseInt(jsr[0]["No_of_paxClose"]));
                            Mumbai.push(parseInt(jsr[0]["FoodAmt"]));
                            Mumbai.push(parseInt(jsr[0]["SoftBevAmt"]));
                            Mumbai.push(parseInt(jsr[0]["IndianLiqAmt"]));
                            Mumbai.push(parseInt(jsr[0]["ImpLiqAmt"]));
                           
                            Pune.push(parseInt(jsr[1]["No_of_Pax"]));
                            Pune.push(parseInt(jsr[1]["No_of_paxClose"]));
                            Pune.push(parseInt(jsr[1]["FoodAmt"]));
                            Pune.push(parseInt(jsr[1]["SoftBevAmt"]));
                            Pune.push(parseInt(jsr[1]["IndianLiqAmt"]));
                            Pune.push(parseInt(jsr[1]["ImpLiqAmt"]));
                     
                    
  var options = {
            chart: {
                height: 350,
                width: 500,
                type: 'bar',
                stacked: true,
                stackType: '100%'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            series: [{
                name: 'Mumbai',
                data: Mumbai
           
            },{
                name: 'Pune',
                data: Pune
            }],
            xaxis: {
                categories: ['NO OF PAX', 'NO OF PAX CLOSE', 'FOOD AMT', 'SOFT BEV AMT', 'INDIAN LIQ AMT', ' IMP LIQ AMT'],
            },
            fill: {
                opacity: 1
            },
            
            legend: {
                position: 'right',
                offsetX: 0,
                offsetY: 50
            },
        }
        
        
       var chart = new ApexCharts(
            document.querySelector("#chart"),
            options
        );
        
        chart.render();
      }}
                }) 
                  
                  
                  graph5(FromDt,Todt);
          }
          
          
          
          
          
</script>

</body>
</html>



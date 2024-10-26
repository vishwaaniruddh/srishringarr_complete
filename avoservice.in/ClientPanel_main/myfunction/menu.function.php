<?php
// menu of Admin
function masteradmin()
{
?>
 <li><a href="#"> Alerts</a>
 <ul>
 <li><a href="view_callalert.php">View Call Alerts</a>
 <li><a href="view_alert.php">View Branch Alerts</a></li></ul>
 </li>
 

 </li>
 <li><a href="#">Site</a>
  <ul>
    <li><a href="newsite.php">Add New </a></li>
    <li><a href="newsite1.php">Add New(form)</a></li>
   <li><a href="view_site.php">View Site</a></li>
   <li><a href="tempsite.php">Temp Sites</a>
  </ul>
 </li>
 <li><a href="#">Calls </a>
 <ul> 
 <li><a href="service.php">Service Call </a></li>
 <li><a href="newalert1.php">New Installation</a></li>
 <li><a href="newtempsite.php">New Temporary Sites</a></li>
 
 </ul></li>
 <li><a href="#">Branch</a>
  <ul>
  <li><a href="newcty_head.php">Add New </a></li>
   <li><a href="view_cityhead.php">View Branch</a></li>
 
  </ul>
 </li>
  <li><a href="#">Assets</a>
  <ul>
   <li><a href="NewAssets.php">Add New Assets </a></li>
   <li><a href="view_assets.php">View Assets</a></li>
   
   
  </ul>
 </li>
 <li><a href="#">Engineer</a>
  <ul>
  <li><a href="eng_alert.php">View Alerts</a></li>
   <li><a href="newarea_eng.php">Add New Engineer </a></li>
   <li><a href="view_areaeng.php">View Records</a></li>
   
  </ul>
  
 </li>
 <li><a href="#">Reports</a>
 <ul>
 <li><a href="catwiserep.php">Category Wise Report</a></li>
 <li><a href="monthrep.php">Monthly Report</a></li>
 </ul>
 </li>
 <li>
 <?php
 include("config.php");
 $cnt=0;
 $qry='';
 if($_SESSION['branch']!='all')
 {
 $br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysql_query("select state from state where state_id in (".$br1.")");
while($srcrow=mysql_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";

$qry="Select * from transfersites where tobranch in (".$br2.") and approval='0' and status='0'";
 }
 else
 $qry="select * from transfersites where approval='0' and status='0'";
 
 //echo $qry;
  ?>
 <a href="transfercall.php">Tranferred Call <font color="#FF0000"><sup><?php echo mysql_num_rows(mysql_query($qry)); ?></sup></font></a></li>
 <?php
}
function Admin()
{
//echo "Admin menu";
?>
 <li><a href="view_alert.php">Home</a></li>
 <li><a href="#">Site</a>
  <ul>
    <li><a href="newsite.php">Add New </a></li>
   <li><a href="view_site.php">View Site</a></li>
    <li><a href="tempsite.php">Temp Sites</a>
  </ul>
 </li>
 <li><a href="#">Branch</a>
  <ul>
  <li><a href="newcty_head.php">Add New </a></li>
   <li><a href="view_cityhead.php">View Branch</a></li>
 
  </ul>
 </li>
  <li><a href="#">Assets</a>
  <ul>
   <li><a href="NewAssets.php">Add New Assets </a></li>
   <li><a href="view_assets.php">View Assets</a></li>
   
   
  </ul>
 </li>
 <li><a href="#">Engineer</a>
  <ul>
   <li><a href="newarea_eng.php">Add New </a></li>
   <li><a href="view_areaeng.php">View Records</a></li>
   
   
  </ul>
 </li>
<?php
 include("config.php");
 $cnt=0;
 $qry='';
 if($_SESSION['user']!='admin')
 {
 $br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysql_query("select state from state where state_id in (".$br1.")");
while($srcrow=mysql_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";

$qry="Select * from transfersites where tobranch in (".$br2.") and approval='0' and status='0'";
 }
 else
 $qry="select * from transfersites where approval='0' and status='0'";
 
 //echo $qry;
  ?>
 <a href="transfercall.php">Tranferred Call <font color="#FF0000"><sup><?php echo mysql_num_rows(mysql_query($qry)); ?></sup></font></a></li>
 <?php
    
}
// menu of call center
function Call()
{
	?>
   <li class="current"><a href="view_callalert.php">View Alerts</a></li>

   <li><a href="#">Calls </a>
   <ul>
   <li><a href="service.php">Add New </a></li>
 <li><a href="newtempsite.php">New Temporary Sites</a></li>
   <?php if($_SESSION['user']=='Sneha'){ ?>  <li><a href="newalert.php">New Installation</a></li><?php } ?>
 <li><a href="newtempsite.php">New Temporary Sites</a></li>
 </ul>
   </li>
  <li><a href="#">Engineer</a>
  <ul>
  <li><a href="eng_alert.php">View Alerts</a></li>
  <!-- <li><a href="newarea_eng.php">Add New Engineer </a></li>
   <li><a href="view_areaeng.php">View Records</a></li>-->
  </ul>
  
 </li>
    <?php
}

//menu of Branch Head
function BranchHead()
{ ?>
<li><a href="view_alert.php"> Alerts</a></li>	
 <li><a href="newarea_eng.php">Engineer</a>
 <ul>
  
   
   <li><a href="view_areaeng.php">View Records</a></li> </ul>
   <?php
 include("config.php");
 $cnt=0;
 $qry='';
 
 $br1=str_replace(",","','",$_SESSION['branch']);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysql_query("select state from state where state_id in (".$br1.")");
while($srcrow=mysql_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";
//echo "Select * from transfersites where state in (".$br2.") and approval='0' and status='0'";
$qry="Select * from transfersites where tobranch in (".$br2.") and approval='0' and status='0'";
 
 
//echo $qry;
  ?>
<li> <a href="transfercall.php">Tranferred Call <font color="#FF0000"><sup><?php echo mysql_num_rows(mysql_query($qry)); ?></sup></font></a></li>
  <!-- <li><a href="#">Engineer</a>
  <ul>
  <li><a href="eng_alert.php">View Alerts</a></li>
<li><a href="newarea_eng.php">Add New Engineer </a></li>
   <li><a href="view_areaeng.php">View Records</a></li>
  </ul>
  
 </li>-->
 <?php
   ?>
 
<?php }

//menu of Engineer
function Engineer()
{
	?>
    <li><a href="eng_alert.php">View Alerts</a></li>
   
  <ul>
   
   <li><a href="view_areaeng.php">View Records</a></li>
   
   
  </ul>
    <?php
}
function Client()
{
	?>
    <li><a href="#">Calls</a>
  <ul>
   <li><a href="view_alert.php">View Calls </a>
   </li>
 </ul></li>
  <li><a href="#">Service </a>
 <ul> 
 <li><a href="service.php">Service Call </a></li>
<!-- <li><a href="service_test.php">Service Call </a></li> -->
 <!--<li><a href="newalert1.php">New Installation</a></li>-->
 <?php
 if($_SESSION['logid']==2130){ 
// if($_SESSION['logid']==1681 or $_SESSION['logid']==2130){ 
 ?>
 
 <li><a href="newtempsite.php">New Temporary Sites</a></li>
 <?php } ?>
 </ul>
 </li>

 
  <li><a href="#">Orders</a>
 <ul> 
 <li><a href="ord_status.php">Your Order Status </a></li> 
  </ul>
 </li>
 
 <li><a href="#">Installations</a>
 <ul> 
 <li><a href="view_ir.php">Inst Reports </a></li> 
 <li><a href="view_snaps.php">Inst Snaps-New </a></li> 
  </ul>
 </li>
 
  <li><a href="#">UW Battery Replacements</a>
 <ul> 
 <li><a href="view_bfr.php">UW Batt Calls </a></li> 
  </ul>
 </li>
 
 <?php  
}
?>
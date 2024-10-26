<?php session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
 //echo "br=".$br=$_POST['branch'];
include('config.php');
include('datefunctions.php');
############# must create your db base connection

?>
          
<?
function get_so_status($id){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from so_order where po_id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['status'];
    
}





function get_cust($id){
    
    global $con1;
    
    
    $sql = mysqli_query($con1,"select * from new_sales_order where so_trackid='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $cust_id = $sql_result['po_custid'];
    
    $cust_sql = mysqli_query($con1,"select * from customer where cust_id = '".$cust_id."'");
    
    $cust_sql_result = mysqli_fetch_assoc($cust_sql);
    
    return $cust_sql_result['cust_name'];
    
}



function get_branch($id){
    
    global $con1;
    
    
    $sql = mysqli_query($con1,"select * from demo_atm where so_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $branch_id = $sql_result['branch_id'];
    
    $branch_sql = mysqli_query($con1,"select * from avo_branch where id = '".$branch_id."'");
    
    $branch_sql_result = mysqli_fetch_assoc($branch_sql);
    
    return $branch_sql_result['name'];
    
}


function get_atm($parameter, $id){
    
    global $con1;
    
    $sql= mysqli_query($con1,"select $parameter from demo_atm where so_id = '".$id."' ");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
    
}


function get_new_sales_order_data($parameter, $id){
    
    global $con1;
    
    $sql= mysqli_query($con1,"select $parameter from new_sales_order where so_trackid = '".$id."' ");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
    
}



$strPage = $_REQUEST['Page'];

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>

<th width="5%">S.N.</th> 
<th width="5%">Invoice No</th> 
<th width="5%">Invoice Date</th>
<th width="5%">Vertical Customer</th>
<!--<th width="5%">End User Name</th>-->


<th width="5%">Address</th>
<th width="5%">Branch</th>
<th width="5%">Site/Sol/ATM ID</th>
<th width="5%">Credit Note No</th> 
<th width="5%">Credit Note Date</th>


<th width="5%">Credit Note Amount</th>
<th width="5%">Courier</th>
<th width="5%">Docket No.</th>
<th width="5%">Estimated Delivery Date</th>
<th width="5%">Dispatch Date</th>


<th width="5%">Delivery Date</th>
<th width="5%">Update Delivery Date</th>
<th width="5%">Invoice Copy</th>
<th width="5%">Credit Note Copy</th>
<!--<th width="5%">Edit</th>-->


<th width="5%">View SO</th>
<th width="5%">View Remarks</th>
<th width="5%">Add Remarks</th>

<?php
function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}
?>


<th>Generate Calls</th>
<th>Action</th>



</tr>
<?php


$sql="select * from so_order where 1";
//======================================Search Call Date wise
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){
		$fromdt=$_POST['fromdt'];
		$todt=$_POST['todt'];
	
			$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
			$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
			$sql.=" and inv_date between '".$fromdt."' and '".$todt."'";

}
// === END Search Call Date wise

if(isset($_POST['invno']) && $_POST['invno']!=''){
		$invno=$_POST['invno'];		
	
			$sql.=" and inv_no like'%".$invno."%'";
	
	}


if(isset($_POST['crnno']) && $_POST['crnno']!=''){
		$crnno=$_POST['crnno'];		
	
			$sql.=" and crn_no='".$crnno."'";
	
}

               if($_POST['del_date']=='pending')
                  $sql.=" and del_date='0000-00-00'";
               else if($_POST['del_date']=='completed')
                  $sql.=" and del_date!='0000-00-00'";
               
               if($_POST['sub_date']=='pending')
                  $sql.=" and sub_date='0000-00-00'";
               else if($_POST['sub_date']=='completed')
                  $sql.=" and sub_date!='0000-00-00'";
echo $sql;




$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows;
  ?></b>
<!-- Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">

 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%10==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>-->
 
 </div>
 <?php
########### pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page

$Page = $strPage;
if(!$strPage)
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}


$qr22=$sql;
$sql.=" order by inv_date DESC ";//LIMIT $Page_Start , $Per_Page";
echo $sql;
$table=mysqli_query($con1,$sql);
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysqli_num_rows($table);
// Insert a new row in the table for each person returned
//echo mysqli_num_rows($table);
if(mysqli_num_rows($table)>0) {
	$i=0;
while($row= mysqli_fetch_row($table))
{

$id = $row[1];



 $xx=0; $yy=0; $zz=0;$add=0;

$pono=mysqli_query($con1,"select * from demo_atm where so_id='".$row[1]."'");
$pon=mysqli_fetch_row($pono);
	//echo "select bankname,atmid,cid,area,city,address,state,pincode from Amc where po='".$pon[0]."'";

/*	if($pon[1]=="AMC")
{
$nm="select bankname,atmid,cid,area,city,address,state,pincode,branch from Amc where amcid='".$pon[0]."'";


            $atm=mysqli_query($con1,$nm);	
}
	else


$nm="select  bank_name,atm_id,cust_id,area,city,address,state1,pincode,branch_id from atm where track_id='".$pon[0]."'";
	    $atm=mysqli_query($con1,$nm);
	

}  
	$atmdet=mysqli_fetch_row($atm); 
*/	
	
	if(isset($_POST['cid']) && $_POST['cid']!='' )
         {
          if($_POST['cid']==$pon[2]){}
          else
             $xx=-1;
         }
         if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='' )
         {
           if($_POST['branch_avo']==$pon[10]){}
          else
             $yy=-1;
         }
         if(isset($_POST['atmid']) && $_POST['atmid']!='' )
         {
           //if($_POST['atmid']==$atmdet[1]){}
           if(startsWith($pon[1], $_POST['atmid'])){}
          else
             $zz=-1;
         }
 if(isset($_POST['address']) && $_POST['address']!='' )
         {
//echo $_POST['address'];
if (strpos($atmdet[5], $_POST['address']) !== false)
{}
          else
             $add=-1;
         }

      if($xx==0 and $yy==0 and $zz==0 and $add==0)
      {
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$atmdet[2]."'");
	$custrow=mysqli_fetch_row($qry);
	
	$brqry=mysqli_query($con1,"select name from avo_branch where id='".$atmdet[8]."'");
	$brrow=mysqli_fetch_row($brqry);
	//$tab=mysqli_query($con1,"select * from po_assets where po_no='".$row[0]."'");	
	//$row1=mysqli_fetch_row($tab)
	//echo "eng stat".$row[15];
        $flag=-1;
        if($pon[5]=="2"){
        $qryx=mysqli_query($con1,"select status,call_status from alert where alert_id='".$pon[2]."'");
        $qryrx=mysqli_fetch_row($qryx);
        if($qryrx[0]=="Done" or $qryrx[1]=="Done")
            $flag=1;
        else
            $flag=0;
        }
        $td=date('Y-m-d');
       
        $nod=dateDifference($row[3],$td);
if($nod>4 and $flag!=1){ //echo $nod;
		?>
<tr style="background-color:red">
<?php }else{ ?>
<tr>
<?php } ?>

<td  valign="top"><?php echo ++$i; ?></td>
<td  valign="top">&nbsp;<?php echo $row[2]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[3]; ?></td>
<td  valign="top">&nbsp;<?php echo get_cust($id); ?></td> 
<!--<td  valign="top">&nbsp;End User name<?php echo get_cust($id); ?></td> -->
<td  valign="top">&nbsp; <?php echo get_atm('address',$id); ?></td>


<td  valign="top">&nbsp;<?php echo get_branch($id); ?></td>  
<td  valign="top">&nbsp;<?php echo get_atm('atm_id',$id); ?></td> 
<td  valign="top">&nbsp;<?php echo $row[12]; ?></td> 
<td  valign="top">&nbsp;<?php echo $row[13]; ?></td> 
<td  valign="top">&nbsp;<?php echo $row[14]; ?></td>


<td  valign="top">&nbsp;<?php echo $row[5]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[6]; ?></td>   
<td  valign="top">&nbsp;<?php echo $row[7]; ?></td>
<td width="71" valign="top">&nbsp;<?php echo $row[8]; ?></td>




<td valign="top">&nbsp;<div id="deldiv<?php echo $row[0]; ?>" >
        <?php
        if($row[9]!='0000-00-00'){ 
            echo $row[9];
        } ?>
    </div>
</td>

<td valign="top">&nbsp;<div id="subdiv<?php echo $row[0]; ?>" >
<?php if($row[10]=='0000-00-00'){ ?>
		<input type="text" name="sub<?php echo $row[0]; ?>" id="sub<?php echo $row[0]; ?>"  onclick="displayDatePicker('sub<?php echo $row[0]; ?>');"  />
		<input type="button" name="submission" value="submission" onclick="setSubmit(<?php echo $row[0]; ?>)" />
		<?php }
		else{
		  ?>

<input type="text" name="sub<?php echo $row[0]; ?>" id="sub<?php echo $row[0]; ?>"  onclick="displayDatePicker('sub<?php echo $row[0]; ?>');"  value="<?php echo $row[10]; ?>"/>
		<input type="button" name="submission" value="Update" onclick="setSubmit(<?php echo $row[0]; ?>)" />
<?php } ?>
</div>
</td>

<td>
<?php if($row[11]!=null ){ ?>
<a href="<?php echo $row[11]; ?>" target="_blank" ><image src="<?php echo $row[11]; ?>" alt="view invoice" width="50" height="50" /></a>
<?php } ?>
</td>
<td>
<?php if($row[15]!=null or $row[15]!=''){ ?>
<a href="<?php echo $row[15]; ?>" target="_blank" >
<?php
$splt=explode(".",$row[15]);

echo $splt[1];

if(strtolower($splt[1])=="pdf")
{

?>
<a href="<?php echo $row[15]; ?> " download></a>
<?php
}
else{
?>
<image src="<?php echo $row[15]; ?>" alt="view credit note" width="50" height="50" /></a>
<?php } 
} ?>
</td>

<!--<td><a href="javascript:void(0);" onclick='window.open("edit_inv.php?id=<?php echo $row[0]; ?>","_blank");'>EDIT</a></td>-->



<td><a href="view_sodetails.php?id=<?php echo $row[1]; ?>" >VIEW SO</a></td>

<td><a href="javascript:void(0);" onclick="window.open('view_SO.php?id=<?php echo $row[1]; ?>&typ=2','view updates','width=700px,height=750,left=200,top=40')" class="update" >View Remarks</a></td>


<td><a href="javascript:void(0);" onclick="window.open('new_update_generateSO.php?id=<?php echo $row[1]?>&typ=2','Update_generateSO','width=700px,height=750,left=200,top=40')" class="update" >Add Remarks</a></td>






 <td>
     <?
     if($row[16] =='1'){
         
     
     
     ?>
     
     
     
         <? if($row[9]!='0000-00-00'){ 
                
                   $del_type = get_new_sales_order_data('del_type',$row[1]);
                   $inst_request=  get_new_sales_order_data('inst_request',$row[1]);
                   
                   if($del_type=='site_del' && $inst_request==1){ ?>
                               
                               <a href="javascript:confirm_generate('<?php echo get_atm('cust_id',$id); ?>','<?php echo get_atm('atm_id',$id); ?>','<?php echo $id; ?>','<?php echo get_atm('track_id',$id); ?>');" > Generate Call</a>
                               
                               <!--<a class="btn btn-success" href="#" style="color:white;">Generate Call</a>-->
                                       
                   <? }
                   else{ ?>
                        
                        <a class="btn btn-danger" href="javascript:confirm_close('<?php echo get_atm('cust_id',$id); ?>','<?php echo get_atm('atm_id',$id); ?>','<?php echo $id; ?>','<?php echo get_atm('track_id',$id); ?>')" style="color:white;">Close</a>
                  
                   <? }
                   
         ?> 
         
    
        <? } }
        
        else{

        }
        
        ?>
     
 </td>
 
     <td>
         <?      if($row[16] =='1'){ ?>
        <a style="margin:5px;" style="color:white;" class="btn btn-danger sales_btn" sales_id="<? echo $id; ?>" id="<? echo $id; ?>" onclick="cancel_invoice(<? echo $id;?>)" >Cancel</a>
        
        
           <a style="margin:5px;" class="btn btn-danger hold_btn" sales_id="<? echo $id; ?>" id="<? echo $id; ?>" onclick="invoice_hold(<? echo $id;?>)">Hold</a>
           
        <? }
        
        if($row[16]=='h'){ ?>
                      <a style="margin:5px;" class="btn btn-danger unhold_btn" sales_id="<? echo $id; ?>" id="<? echo $id; ?>" onclick="invoice_unhold(<? echo $id;?>)" >Unold</a>
           
 
        <? }
        ?>
        
                
    </td>
    




</tr>
<?php

}
}
?>
</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}

?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
/*if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}*/

?>
<input type="hidden" id="soid"  readonly>
<input type="hidden" id="sosts"  readonly>

 
<form name="frm" method="post" action="exportinvoices.php" target="_new">
<input type="hidden" name="cid" value="<?php echo $_POST['cid']; ?>" readonly>
<input type="hidden" name="branch_avo" value="<?php echo $_POST['branch_avo']; ?>" readonly>
<input type="hidden" name="atmid" value="<?php echo $_POST['atmid']; ?>" readonly>
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>

<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
<div id="bg" class="popup_bg"> </div>
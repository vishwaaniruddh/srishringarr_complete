<?php
include 'config.php';

       $id=$_GET['id'];
             $sts=$_GET['sts'];
//echo $id;  
if($sts!="")
	{?>
	 <option value="">Select</option>	
	<?php	
	}
	
if($id=="1")
{
	
	
	$qr=mysqli_query($con,"select doc_id,name from doctor order by name");
	
	
	           while($row=mysqli_fetch_row($qr))
                { 

			?>
			
			
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				
				
				<?php } 
     
}
elseif($id=="2")
{
	
	$qr=mysqli_query($con,"select staff_id,name from staff order by name");
	           while($row=mysqli_fetch_row($qr))
                { 

			?>
			
			
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				
				
				<?php } 
    
	
	
}
elseif($id=="3")
{
	//echo "select id,namer from other_typ";
	$qr=mysqli_query($con,"select id,namer from other_typ order by namer");
	echo mysqli_error();
	           while($row=mysqli_fetch_row($qr))
                { 

			?>
			
			
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				
				
				<?php } 
    
	
	
}

?>
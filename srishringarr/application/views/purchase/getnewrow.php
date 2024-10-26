<?php
include('config.php');
$cnt=$_POST["cnt"];
 $qryitem=mysql_query("select category from categories");	 
 echo mysql_error();
		$category=array();
		 while($row=mysql_fetch_row($qryitem))
		 {
		$category[]=$row[0];
		}
	 ?>
<td ><input type="text" style="width: 155px;"  name="item_no[]" class="item_no" id="item_no<?php echo $cnt;?>" value=""  autocomplete="off" readonly/ ></td>
<td  ><input  type="text"  style="width: 154px;" name="myitemid[]" class="item_id" id="textField<?php echo $cnt;?>" value="" onkeyup="checkUsername(event);" onblur="item_num1(this.id);"/>  </td>
    <td   ><select style="width: 154px;" name="item_cat[]" class="item_cat" id="item_cat<?php echo $cnt;?>" >
       <option value="0">Select</option>
       <?php 
	   
	   for($i=0;$i< count($category);$i++){
		   ?><option value="<?php echo $category[$i]; ?>"><?php echo $category[$i]; ?></option><?php
	   
	   }
	   ?>
       
    </select></td> 
      
<td  ><input type="text" style="width: 154px;" name="cprice[]" class="cprice" id="cprice<?php echo $cnt;?>" onChange="subtotal()" value=""  onkeypress="return isNumberKey(event)" autocomplete="off" /> </td> 
  <td ><input type="text" style="width: 154px;" name="uprice[]" class="uprice" id="uprice<?php echo $cnt;?>"  value=""   autocomplete="off">&nbsp; </td> 
    <td  > <input type="text" style="width: 150px;" name="qty[]" id="qty<?php echo $cnt;?>" class="qty" onChange="subtotal()"  onkeypress="return isNumberKey(event)" value="" align="right" autocomplete="off">  </td>

<td  > <input type="text" style="width: 152px;" name="subtotal[]" class="subtotal" align="right" readonly id="subtotal<?php echo $cnt;?>"></td>
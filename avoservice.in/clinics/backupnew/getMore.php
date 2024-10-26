 <?php
 include('config.php');
 $cnt=$_GET['cnt'];
 ?>

 <table border="0" id="deleteRow">
                
              
                <tr>
                <td>
                <select style="width:140px;" name="med[]" id="med<?php echo $cnt; ?>" onChange="getpotency('med<?php echo $cnt ?>','pot<?php echo $cnt; ?>')">
                <option value="0">Select</option>
                <?php $result3 = mysql_query("select name,med_id,potency,batchno from medicine ");
				    while($row=mysql_fetch_row($result3)){ ?>
					<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
				<?php } ?>
                </select>
                </td>
                <td><select name="pot[]" id="pot<?php echo $cnt; ?>">
                <option value="">-select-</option>
                </select>
                </td>
                

                
                <td>
                <input type="text" name="dos[]" id="dos[]" style="width:140px;">
              <!--  <select style="width:140px;" name="dos[]" id="dos[]" class="dos">
              <option value="0">Select</option>
              <option value="1..0..0">1..0..0morning</option>
              <option value="1..0..1"> 1..0..1 morning-night</option>
              <option value="1..1..1"> 1..1..1 morning-afternoon-night</option>
              <option value="0..0..1"> 0..0..1 night</option>
              <option value="0..1..1"> 0..1..1 afternoon-night</option>
              <option value="1..1..1..1"> 1..1..1..1 morning-afternoon-evening-night</option>
               <option value="1/2..0..0"> 1/2..0..0 morning/2</option>
            </select>       -->    
           </td>
                <td><input type="text" name="days[]" id="days[]" style="width:140px;"/></td>
                 <td><input type="text" name="cmnt[]" id="cmnt[]" style="width:140px;"/></td>
                </tr>
</table>
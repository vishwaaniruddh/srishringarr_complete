 <?php
 include('config.php');
 $cnt=$_GET['cnt']+1;
 ?>
             <?php echo $cnt; ?>___///<td width="23"><?php echo $cnt; ?></td>
                <td width="147">
                <select style="width:140px;" name="proc[]" id="proc" class="proc">
                <option value="0">Select</option>
                 <?php $sqq=mysql_query("select * from procedures where investigation<>'' ORDER BY investigation ASC");
				while($roo=mysql_fetch_array($sqq)){
				?>
                <option value="<?php echo $roo[1]; ?>"><?php echo $roo[1]; ?></option>
                <?php } ?>
                </select>
                
                </td>
                
                <td width="173"><input type="text" name="code[]" id="code" class="code"></td>
                
                <td width="169"><input type="text" name="other[]" id="other" class="other"></td>        

				<td width="164"><input type="text" name="rate[]" id="rate[]" class="rate" style="width:140px;"/></td>
                
                <td width="166"><input type="text" name="amt[]" id="amt[]" class="amt" style="width:140px;"/></td>
                
             
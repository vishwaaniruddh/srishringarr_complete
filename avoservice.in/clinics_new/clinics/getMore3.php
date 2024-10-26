 <?php
 include 'config.php';
 $cnt = $_GET['cnt'];
 $j=$cnt-1;
 ?>
        <!--    <td width="23">4</td>
                <td width="147">
                <select style="width:140px;" name="proc[]" id="proc" class="proc">
                <option value="0">Select</option>
                </select>
                </td>
                
                <td width="173"><input type="text" name="code[]" id="code" class="code"></td>
                
                <td width="169"><input type="text" name="other[]" id="other" class="other"></td>        

				<td width="164"><input type="text" name="rate[]" id="rate[]" class="rate" style="width:140px;"/></td>
                
                <td width="166"><input type="text" name="amt[]" id="amt[]" class="amt" style="width:140px;"/></td>
        -->
				<td><input type="hidden" value="<?php echo $cnt; ?>" name="sr1[]" id="sr1" class="sr" /><?php echo $cnt; ?></td>
                <td>
                 
                <select style="width:140px;" name="medst[]" id="medst<?php echo $j; ?>" class="proc" onchange="procmed(<?php echo $j; ?>);">
                <option value="0">Select</option>
                <?php 
				$sq=mysqli_query($con,"select * from medical_stores order by name");
				while($ro=mysqli_fetch_row($sq)){
				?>
                <option value="<?php echo $ro[0]; ?>"><?php echo $ro[1]; ?></option>
                <?php } ?>
                </select>
                </td>
                
                <td><input type="text" name="bills[]" id="bills<?php echo $j; ?>" class="code"></td>                				
                <td><input type="text" name="amtst[]" id="amtst<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
				<td><input type="text" name="amtstdt[]" id="amtstdt<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
                <td><input type="text" name="amtadst[]" id="amtadst<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
                <td><input type="text" name="remst[]" id="remst<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
             
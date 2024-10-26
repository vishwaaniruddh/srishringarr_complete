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
				<td><input type="hidden" value="<?php echo $cnt; ?>" name="sr[]" id="sr" class="sr" /><?php echo $cnt; ?></td>
                <td>
                 
                <select style="width:140px;" name="proc[]" id="proc<?php echo $j; ?>" class="proc" onchange="proce(<?php echo $j; ?>);">
                <option value="0">Select</option>
                <?php 
				$sq=mysqli_query($con,"select * from procedures where investigation<>'' order by investigation");
				while($ro=mysqli_fetch_row($sq)){
				?>
                <option value="<?php echo $ro[4]; ?>"><?php echo $ro[1]; ?></option>
                <?php } ?>
                </select>
                </td>
                
                <td><input type="text" name="code[]" id="code<?php echo $j; ?>" class="code"></td>
                
                <td><input type="text" name="other[]" id="other<?php echo $j; ?>" class="other"></td>        

				<td><input type="text" name="rate[]" id="rate<?php echo $j; ?>" class="rate" style="width:140px;"/></td>
                <td><input type="text" name="qty[]" id="qty<?php echo $j; ?>" value="1" class="rate" style="width:40px;"/></td>
                <td><input type="text" name="amt[]" id="amt<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
                <td><input type="text" name="amtad[]" id="amtad<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
                <td><input type="text" name="rem[]" id="rem<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
             
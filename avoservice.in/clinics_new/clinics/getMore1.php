 <?php
 include 'config.php';
 $cnt = $_GET['cnt'];
 $a=$cnt-1;
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
				<td width="17"><?php echo $cnt; ?></td>
                <td width="151">
                <select style="width:140px;" name="other_proc[]" id="other_proc<?php echo $a; ?>" class="other_proc" onchange="otherproc(<?php echo $a; ?>);">
                <option value="0">Select</option>
                <?php $sq1=mysqli_query($con,"select * from other_charges ");
				while($ro1=mysqli_fetch_row($sq1)){
				?>
                <option value="<?php echo $ro1[0]; ?>"><?php echo $ro1[1]; ?></option>
                <?php } ?>
                </select>
                </td>
                
                <td width="148"><input type="text" name="other_rate[]" id="other_rate<?php echo $a; ?>" class="other_rate" ></td>
		<td width="40" ><input type="text" name="other_qty[]" id="other_qty<?php echo $a; ?>" value="1" class="other_rate" ></td>
		<td width="148"><input type="text" name="other_crate[]" id="other_crate<?php echo $a; ?>" class="other_rate" ></td>
                <td width="148"><input type="text" name="other_adrate[]" id="other_adrate<?php echo $a; ?>" class="other_rate" ></td>
                <td width="148"><input type="text" name="other_rem[]" id="other_rem<?php echo $a; ?>" class="other_rate" ></td>
             
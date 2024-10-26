<?php 
include 'config.php';


$id=$_GET['id'];
$cond=$_GET['cond'];
$implan=$_GET['implan'];
$amtc=$_GET['amtc'];
$amtad=$_GET['amtad'];
$rem=$_GET['rem'];
$proc1=$_GET['proc1'];
$other1=$_GET['other1'];
$code1=$_GET['code1'];
$rate1=$_GET['rate1'];
$amt1=$_GET['amt1'];

$sql="select * from admission where ad_id='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);


$sql1="select * from patient where no='$row[1]'";
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_row($result1);

?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<script type="text/javascript">

                 $(document).ready(function() {

                        $('#cou_btn').click(function(e) {
                          e.preventDefault();

                          w=window.open();
                          var temp=$('#cou_box').html();
                          w.document.write(temp);
                          if (navigator.appName == 'Microsoft Internet Explorer') window.print();
        else w.print();
                          w.close();
                         return false;
                        });
                       });  


            </script>


            <div id="cou_box">
              <table>
                
                <tr> 
            	<td width="401">Name :</td>
                <td width="236"><input id="name" name="name" type="text" value="<?php echo $row1[1]; ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>
                
                <tr>
                <td><label class="fdiag">Age/Sex :</label></td>
                <td><input id="fd" name="fd" type="text" value="<?php echo $row1[26].$row1[27]; ?>" style="background-color:#DCDCDC;" readonly></td>
                </tr>
                
               
                <tr>
                <td><label class="pro_diag">Address :</label></td>
                <td><textarea name="inv" rows="3" cols="22" style="resize:none;background-color:#DCDCDC" readonly><?php echo $row1[20]; ?></textarea></td>
				</tr>
                
                 <tr>
                <td><label class="datead">Contact No:</label></td>
                <td> <input id="datead" name="datead" type="text" style="background-color:#DCDCDC;"  value="<?php echo $row1[23]; ?>" readonly="readonly"></td>
                </tr>
               
                <tr>
                <td><label class="fdiag">Insurance Number/Staff Card No/Pensioner Card no. :</label></td>
                <td><input id="fd" name="fd" type="text" value="<?php echo $row1[26]; ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>
                
                <tr>
                <td><label class="datead">Date of Referral :</label></td>
                <td><input id="datedis" name="datedis" type="text" value="<?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>               
                
                <tr>
                <td><label class="inv">Diagnosis:</label></td>
                <td><textarea name="diag" rows="3" cols="22" style="resize:none;background-color:#DCDCDC" readonly><?php echo $row1[26]; ?></textarea></td>
                </tr>
                
                <tr>
                <td><label class="proc">Condition of the patient at discharge:</label></td>
                <td><?php echo $cond; ?></textarea></td>
                </tr>
                
             <tr><td colspan="4"> CGHS/other Code no/nos for chargable procedures : 
             <table width="882" border="1">
             <tr>
             <th width="27">Sr no</th>
             <th width="122">Chargeable Procedure</th>
             <th width="205">CGHS Code no with page no (1)</th>
             <th width="202">Other if not on (1) prescribed code no with page no</th>
             <th width="84">Rate</th>
             <th width="202">Amt. Claimed with date</th>
             </tr>
             
             <?php 
			 $i=1;
			 for($j=0;$j<=2;$j++){?>
                <tr>
                <td><?php echo $i; ?></td>
                <td>
                <select style="width:140px;" name="proc[]" id="proc" class="proc">
                <option value="0">Select</option>
                </select>
                </td>
                
                <td><?php echo $code1; ?></td>
                
                <td><input type="text" name="other[]" id="other" class="other"></td>        

				<td><input type="text" name="rate[]" id="rate[]" class="rate" style="width:140px;"/></td>
                
                <td><input type="text" name="amt[]" id="amt[]" class="amt" style="width:140px;"/></td>
                </tr>

<?php  $i++; } ?>
            </table> 
            <tr>
             <td>Charges of Implant/device used : </td>
             <td><?php echo $impaln; ?> </td>
             <td width="242">Amount Claimed : </td>
             <td width="240"><?php echo $amtc; ?> </td>
             </tr>
             
             <tr>
             <td>Amount Admitted : </td>
             <td><?php echo $amtad; ?> </td>
             <td>Remarks : </td>
             <td><?php echo $rem; ?> </td>
             </tr>
               
<!--end discharge form-->
                                              
               
                </table>         
            </div>
            <input type="button" id="cou_btn" value="Print" style="width:100px;"/>
<?php
//ini_set( "display_errors", 0);
include('config.php');
include_once('wordtonumber.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mulakaat Jewellers</title>
</head>
<script type="text/javascript" src="jquery-1.8.3.js"></script>
<script type="text/javascript" src="paging.js"></script>
<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('bill');
           divToPrint.style.fontSize = "10px";
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
		function rollback(){
			document.getElementById("bdy").innerHTML="Transaction is rolled back, keeping the data secure. Please refresh this page to complete the transaction!";
			}
       
     </script>

    
      <script type="text/javascript">
        function showtotal()
        {
                  var total=[];
                var inputs = document.getElementsByName("prz[]");
            //alert(inputs.length);
             
            for (i = 0; i < inputs.length; i++) {
               
                 var total = inputs[i].value;
                // var ftotal=inputs[i].value;
                 console.log(total);
                 $.ajax({
                  type: "GET",
                  url: "calsum.php",
                  data: { "total":total} ,
                  success: function(result) {
                      // $("#dis").html(result);
                  }
              });
               //console.log(inputs[i].value);
                // var total += sum[i];
                 //console.log(total);
                
            }

        }



    </script>
<body id="bdy">
<form method="POST">
<div id="bill" style="font-size:12px;">
<table width="787" border="0" align="center" style="
    margin-top: 160px;
">
<tr>
    <td width="781" height="42">
    
    <table width="780" >
       <tr>
        <td colspan="3" align="center" >
          <font size="2">
            <B><U>TAX INVOICE  </U></B></font></td>
         </tr>            
  <tr>
  
    
    
    </tr>
    
  <tr>
    <td colspan="2" ></td>
    </tr>
    
  <tr height="21">
    <td  width="30"><font size="3" >M/s.&nbsp;:&nbsp;&nbsp;</font></td><td><b><input type="text" name="cid" id="cid" value="<?php if(isset($_POST['submit'])){ echo $_POST['cid']; } ?>" size="35"></b></td>
    <td width="128"><font size="2" >Invoice Date: </font><b><input type="text" name="bill_date" id="bill_date" value="<?php if(isset($_POST['submit'])){ echo $_POST['bill_date']; } ?>" onClick="displayDatePicker('bill_date');"/></b></td>
    </tr>
    
  <tr height="23" valign="top">
    <td width="30"><font size="3" >Address</font>.:</td>
    <td align="left"><b><textarea name="tp" id="tp" cols="37"><?php if(isset($_POST['submit'])){ echo $_POST['tp']; } ?> </textarea></b></font></td>
    <td><font size="3" >Invoice No:</font><b><input type="text" name="invno" id="invno" value="<?php if(isset($_POST['submit'])){ echo $_POST['invno']; } ?>"></b></td></tr>
    <tr>
    <td width="30"><font size="3" >Contact No.: &nbsp;&nbsp;&nbsp;</font></td><td align="left"><input type="text" name="phoneNo" id="phoneNo" value="<?php if(isset($_POST['submit'])){ echo $_POST['phoneNo']; } ?>" size="35" /> </td><td width="290"></td></tr>
  </table>
    <table width="780" height="550" border="1" cellpadding="4" cellspacing="0" id="results">
  <tr height=20>
  <th width="30"><font size="2" >Sr.No.</font></th>
    <th width="219"><font size="2" >Item</font></th>
   <th width="40">Purity</th>    
    <th width="40"><font size="2" >Gold Wt.</font></th>
    <th width="40"><font size="2" >Net Wt.</font></th>
     <th width="40"><font size="2" >G Rate</font></th>
	    <th width="40"><font size="2" >Dia.CT</font></th>
        <th width="40"><font size="2" >D Rate</font></th>   	    
	    <th width="40"><font size="2" >Making</font></th>
	    
        <th width="73"><font size="2" >Amount</font></th>
    
  </tr>
  <?php
  $j=1;
  $total=0;
  $s2=0;
  ///$ds=$dis/$d;
  while($j<=17){
	  ?>
   
  <tr height="20">
  <td><font size="2" size="1"><?php echo $j++; ?></font></td>
    <td align="center"><font size="2" ><b><input name="design[]" type="text" class="design" size="38" value="<?php if(isset($_POST['submit'])){ $design=$_POST['design']; echo $design[$j-2];} ?>"/></b></font></td>
    <td align="center"><font size="2" ><b><input name="kt[]" type="text" class="kt" size="2" value="<?php if(isset($_POST['submit'])){ $kt=$_POST['kt']; echo $kt[$j-2];} ?>"/></b></font></td>
    <td align="center"><font size="2" ><b><input name="gwt[]" type="text" class="gwt" size="2" value="<?php if(isset($_POST['submit'])){ $gwt=$_POST['gwt']; echo $gwt[$j-2];} ?>"/></b></font></td>
    <td align="center"><font size="2" ><b><input name="nwt[]" type="text" class="nwt" size="2" value="<?php if(isset($_POST['submit'])){ $nwt=$_POST['nwt']; echo $nwt[$j-2];} ?>"/></b></font></td>
    <td align="center"><font size="2" ><b><input name="grate[]" type="text" class="grate" size="3" value="<?php if(isset($_POST['submit'])){ $grate=$_POST['grate']; echo $grate[$j-2];} ?>"/></b></font></td>
    <td align="center"><font size="2" ><b><input name="dwt[]" type="text" class="dwt" size="2" value="<?php if(isset($_POST['submit'])){ $dwt=$_POST['dwt']; echo $dwt[$j-2];} ?>"/></b></font></td>
    <td align="center"><font size="2" ><b><input name="drate[]" type="text" class="drate" size="3" value="<?php if(isset($_POST['submit'])){ $drate=$_POST['drate']; echo $drate[$j-2];} ?>"/></b></font></td>    
    <td align="center"><font size="2" ><b><input name="mkr[]" type="text" class="mkr" size="2" value="<?php if(isset($_POST['submit'])){ $mkr=$_POST['mkr']; echo $mkr[$j-2];} ?>"/></b></font></td>    
     <td align="center"><font size="2" ><b><input name="prz[]" type="text" class="prz" id="prz[]" size="10" onchange="showtotal();" value="<?php if(isset($_POST['submit'])){ $amount=$_POST['prz']; echo $amount[$j-2];} ?>" /></b></font></td>
  </tr> <?php }	 
	  ?>  
     	
<tr>
<td colspan="6"><font size="2" ><b>Total Rupees :<?php

 if(isset($_POST['submit'])){
  $amount=$_POST['prz'];
  if($_POST['dis']!='') 
    { $dis=$_POST['dis']; 
}else{ $dis=0;} 
$vat=array_sum($amount)-$dis;
 $v=0.012*$vat; 
 $number=$vat+$v;
 function convertNumber($number)
{
    list($integer, $fraction) = explode(".", (string) $number);

    $output = "";

    if ($integer{0} == "-")
    {
        $output = "negative ";
        $integer    = ltrim($integer, "-");
    }
    else if ($integer{0} == "+")
    {
        $output = "positive ";
        $integer    = ltrim($integer, "+");
    }

    if ($integer{0} == "0")
    {
        $output .= "zero";
    }
    else
    {
        $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
        $group   = rtrim(chunk_split($integer, 3, " "), " ");
        $groups  = explode(" ", $group);

        $groups2 = array();
        foreach ($groups as $g)
        {
            $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});
        }

        for ($z = 0; $z < count($groups2); $z++)
        {
            if ($groups2[$z] != "")
            {
                $output .= $groups2[$z] . convertGroup(11 - $z) . (
                        $z < 11
                        && !array_search('', array_slice($groups2, $z + 1, -1))
                        && $groups2[11] != ''
                        && $groups[11]{0} == '0'
                            ? " and "
                            : ", "
                    );
            }
        }

        $output = rtrim($output, ", ");
    }

    if ($fraction > 0)
    {
        $output .= " point";
        for ($i = 0; $i < strlen($fraction); $i++)
        {
            $output .= " " . convertDigit($fraction{$i});
        }
    }

    return $output;
}

function convertGroup($index)
{
    switch ($index)
    {
        case 11:
            return " decillion";
        case 10:
            return " nonillion";
        case 9:
            return " octillion";
        case 8:
            return " septillion";
        case 7:
            return " sextillion";
        case 6:
            return " quintrillion";
        case 5:
            return " quadrillion";
        case 4:
            return " trillion";
        case 3:
            return " billion";
        case 2:
            return " million";
        case 1:
            return " thousand";
        case 0:
            return "";
    }
}

function convertThreeDigit($digit1, $digit2, $digit3)
{
    $buffer = "";

    if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
    {
        return "";
    }

    if ($digit1 != "0")
    {
        $buffer .= convertDigit($digit1) . " hundred";
        if ($digit2 != "0" || $digit3 != "0")
        {
            $buffer .= " and ";
        }
    }

    if ($digit2 != "0")
    {
        $buffer .= convertTwoDigit($digit2, $digit3);
    }
    else if ($digit3 != "0")
    {
        $buffer .= convertDigit($digit3);
    }

    return $buffer;
}

function convertTwoDigit($digit1, $digit2)
{
    if ($digit2 == "0")
    {
        switch ($digit1)
        {
            case "1":
                return "ten";
            case "2":
                return "twenty";
            case "3":
                return "thirty";
            case "4":
                return "forty";
            case "5":
                return "fifty";
            case "6":
                return "sixty";
            case "7":
                return "seventy";
            case "8":
                return "eighty";
            case "9":
                return "ninety";
        }
    } else if ($digit1 == "1")
    {
        switch ($digit2)
        {
            case "1":
                return "eleven";
            case "2":
                return "twelve";
            case "3":
                return "thirteen";
            case "4":
                return "fourteen";
            case "5":
                return "fifteen";
            case "6":
                return "sixteen";
            case "7":
                return "seventeen";
            case "8":
                return "eighteen";
            case "9":
                return "nineteen";
        }
    } else
    {
        $temp = convertDigit($digit2);
        switch ($digit1)
        {
            case "2":
                return "twenty-$temp";
            case "3":
                return "thirty-$temp";
            case "4":
                return "forty-$temp";
            case "5":
                return "fifty-$temp";
            case "6":
                return "sixty-$temp";
            case "7":
                return "seventy-$temp";
            case "8":
                return "eighty-$temp";
            case "9":
                return "ninety-$temp";
        }
    }
}

function convertDigit($digit)
{
    switch ($digit)
    {
        case "0":
            return "zero";
        case "1":
            return "one";
        case "2":
            return "two";
        case "3":
            return "three";
        case "4":
            return "four";
        case "5":
            return "five";
        case "6":
            return "six";
        case "7":
            return "seven";
        case "8":
            return "eight";
        case "9":
            return "nine";
    }
}

 // $num =;
 $test = convertNumber($number);

 echo $test.' '.'only';
   }

?> </b></font></td>
<td colspan="2"><font size="2" ><b>Net Amount:</b><br /><br /><b>Discount :</b><br /><br /><b>VAT (1.2%):</b><br /><br /><b>Total Amount:</b></font></td>
         <td colspan="2" align="right"><font size="2" ><b><?php if(isset($_POST['submit'])){ $amount=$_POST['prz']; echo array_sum($amount); }  ?></b><br><br><b><input type="text" name="dis" value="<?php if(isset($_POST['submit'])){$amount=$_POST['prz'];if($_POST['dis']!=''){$_POST['dis']; }else{ echo 0;}} ?>"></b><br><br><b>
		 <?php  if(isset($_POST['submit'])){ $amount=$_POST['prz'];if($_POST['dis']!='') { $dis=$_POST['dis']; }else{ $dis=0;} $vat=array_sum($amount)-$dis; echo 0.012*$vat; }  ?></b><br><br><b><?php  if(isset($_POST['submit'])){ $amount=$_POST['prz'];if($_POST['dis']!='') { $dis=$_POST['dis']; }else{ $dis=0;} $vat=array_sum($amount)-$dis; $v=0.012*$vat; echo $vat+$v; } ?></b><br><br>




     </font></td></tr>
</tr>
</table></font>

    
    </td>
    </tr>
     <tr><td>    
    <span style="font-size:10px;">I/We hereby certify that my/our Registration certificate under the Maharashtra Value Added tax Act 2002 is in force on the date on which the sale specified in this invoice
    is made by me/us and that the transaction of sale covered by this tax Invoice has been effected by me/us and it shall be accounted for in the turnover of sales while filling of Return 
    and subject to Mumbai Jurisdiction.</span>         
    

  <hr/>
  <table width="784" border="0">
  <tr>
    <td width="419" valign="top"><ul>
      <li ><font size="2">VAT TIN NO.: </font></b></li>
      <li> <font size="2">VAT TIN NO.: </font></li></ul></td>

    <td width="355" valign="top"align="right">
               E & O.E.
      <br/>
      <font>For Mulakaat Jewels Pvt. Ltd.</font>&nbsp;</td>
  </tr>
  <tr>
    <td width="419" valign="top">
    <table width="419" border="1"><tr>
      <td><font size="2">Verified & Received</font></td></tr>
      <tr><td><font size="2">Signature Of Receiver</font></td></tr>
      <tr><td> <font size="2">Mobile No.</font></td></tr>
      </table></td>

    <td width="355" valign="top"align="right">
               
      <br/>
      <font></font>&nbsp;</td>
  </tr>
  <tr>
    <td width="419" valign="top"><ul>
      <!--<li ><font size="2">Subject to Mumbai jurisdiction</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><font size="2">E. & O . E</font></b></li>-->
      <!--<li> <font size="2">Time 11 a.m. to 6 p.m.</font></li>--></ul></td>

    <td width="355" valign="top"align="right">
               <p></p>
      <!--<img src="shringaar.png" width="163" height="57"/>-->
      <br/>
      <font>Authorised Signatory</font>&nbsp;</td>
  </tr>
</table>

  </td></tr>
</table>

</div><br/><br/><div id="pageNavPosition"></div>
<center><a href="#" onclick='PrintDiv();'>Print</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://localhost/accounts/sales">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="calculate"></center>
</form>
</body>
</html>
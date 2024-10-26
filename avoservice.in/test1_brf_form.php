<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>BRF Form </title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="menu.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
      src="https://code.jquery.com/jquery-3.4.1.js"
     integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
      crossorigin="anonymous"></script>
   <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>


<?php
include ('config.php');
include("access.php");

?>


<script>
  function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31
              && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }


</script>
<style>.selectContainer{border: 1px solid #ffe150;background: #e8e6e6;padding: 2%;border-radius: 10px; margin: 1%;}</style>

<script>

function validation()
{ 
  var Battery_Vendor= document.getElementById('Battery_Vendor').value;
  
       
        if (Battery_Vendor=="")
        {
        alert("Please Fill Battery Vendor Name");
        return false;            
        } else
       { 
       form.submit();
       
       }
} 

</script>
<style>
      table, td {
                 border: 1px solid black;
                padding:5px;
                }
                
                
</style>
</head>
<body>
<?php include("menubar.php");?>
<h2 align="center">BRF Form</h2>

<div class="container" style="margin-left:0px;">
<form  method="post" action="Process_test_brfform.php" enctype="multipart/form-data" onsubmit="return validation()"> 

<table align="center" id="myTable" width="150" height="35" border="1">
         
  <tr>

 <tr>
<td><lable> Battery Vendor Name:</lable></td>
<td><select name="Battery_Vendor" id="Battery_Vendor" style="width: 168px ;height:25px"  required>
     <option value="">Select</option>
      <?php 
         $qry="select * from batteryVendor";
         $result=mysqli_query($con1,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[1];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } ?>
   
</select></td></tr>



 </table>
<br>

<table class="ssselectContainer" align="center">


 <tr> 
        <td>Sl. No. </td>
		<td>Battery Serial No.</td>
		<td>Charging Voltage</td>
		<td>Discging 30 Minutes</td>


			  </tr>      
<tr class="selectContainer"></tr>
    

</table>
</br>

<div align="center"> <input type="submit"  name="submit" value="Submit" class="readbutton" onclick="validation()" />
<input type='button' id='but_add' value='Add new' onclick="addOptionTags()" class="readbutton">
<input type="button" onclick="myDeleteFunction()" value="Delete row" class="readbutton">
</div>

</form>
		
<script>
        var GroupCount = 0;
        
       // var Set1 = <? echo $data; ?>;        
      //  var Set2 = <? echo $data2; ?>;
                    
   // Set2 = JSON.parse(Set2);                
                    
        function addOptionTags() {
            GroupCount++;
           // var sId = 'product-'+GroupCount;
          //  var s = $('<type="text" id="'+sId+'" class="product" name="product[]"  required /><br><br>');
         //   var s2 = $('<type="number" id="model-'+sId+'" class="model" name="model[]" required /><br><br>');
         
            var batt_sno = $('<td><input type="text" step "any" name="batt_sno[]" placeholder="Battery Serial No." required></td>');
            var ch_volt = $('<td><input type="number" step="any" name="ch_volt[]" placeholder="Charging Voltage" required></td>');
            var dis_volt = $('<td><input type="number" step "any" name="dis_volt[]" placeholder="Discharge in 10 Min" required></td>');
            var dis30_volt = $('<td><input type="number" step="any" name="dis30_volt[]" placeholder="Discharge in 30 Min" required></td></tr><br><br>');
            
           
           var space  = $('<br><br><hr style="border-top: 2px solid black;">');
    
            
          //  for(var val of Set1) {
            //    $("<option />", {value: val.id, text: val.name}).appendTo(s);
          //  }
                
           // s.appendTo(".selectContainer");
         //   s2.appendTo(".selectContainer");
            batt_sno.appendTo(".selectContainer");
            ch_volt.appendTo(".selectContainer");
            dis_volt.appendTo(".selectContainer");
            dis30_volt.appendTo(".selectContainer");
        }
        
      //  $(".items_table").append(itemRow);
   /*     function LoadSet2Options(fk, set2Id) { debugger;
            var op = $("#"+set2Id);
            op.empty();
            for(var val of Set2) {
                if(val.fk == fk) {
                    $("<option />", {value: val.id, text: val.name}).appendTo(op);
                }
            }
        }


        $(".selectContainer").on('change', '.product', function() {
            LoadSet2Options($(this).val(), "model-"+$(this).attr("id"));
        }); */
        
        $(document).ready(function() {
            addOptionTags();
        });
        

function myDeleteFunction() {
var rowCount = myTable1.rows.length;
var a=rowCount - 1;
if(a>1){

    document.getElementById("myTable1").deleteRow(-1);
}}
</script>
<script>
function myFunction() {
    window.print();
}
</script>

</body>
</html>

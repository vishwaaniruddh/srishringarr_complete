<?php
        session_start();
        
        ?>
<html>
   
   <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script> 
    <body>
    <div id='input'>
 
        <?php
      //  session_start();       
       if($_SESSION['user']=='masteradmin' || $_SESSION['designation']=="3")
       {
        include('config.php');
       
$qrbranchstr="SELECT * FROM `avo_branch` where 1";
if($_SESSION['designation']=="3")
{
$qrbranchstr.=" and id=".$_SESSION['branch'];
}

        $qrybranch = mysqli_query($con1,$qrbranchstr);
        
        if($_POST['branch']!=-1 or $_POST['pid']!='')
        {
        $dt= date('Y-m-d');
        $dt= $dt.' 00:00:00';
        if(isset($_POST['date']) && isset($_POST['date2']))  {      
        $fdate=str_replace("/","-",$_POST['date']);
        $time1 = strtotime($fdate);
        $from = date('Y-m-d',$time1).' 00:00:00';
        $tdate=str_replace("/","-",$_POST['date2']);
        $time2 = strtotime($tdate);
        $to = date('Y-m-d',$time2).' 23:59:59';
        }
        if($_POST['pid']!='')
        $resultx = mysqli_query($con1,"SELECT loginid,engg_name FROM `area_engg` where area='".$_POST['branch']."' and loginid=(select srno from login where username='".$_POST['pid']."') and status=1 and deleted=0");
        else
        $resultx = mysqli_query($con1,"SELECT loginid,engg_name FROM `area_engg` where area='".$_POST['branch']."' and status=1 and deleted=0");
        
               while($srno=mysqli_fetch_row($resultx)){
       
        if(isset($_POST['date']) && isset($_POST['date2']))  {      
        $result = mysqli_query($con1,"SELECT id,latitude,longitude,dt FROM `Location` where mac_address in (select mac_id from notification_tble where logid='".$srno[0]."') and dt between '".$from."' and '".$to."' AND latitude != 0.000000");
     //   echo "SELECT id,latitude,longitude,dt FROM `Location` where mac_address in (select mac_id from notification_tble where logid='".$srno[0]."') and dt between '".$from."' and '".$to."' AND latitude != 0.000000"."<br>";
        }
        else
        $result = mysqli_query($con1,"SELECT id,latitude,longitude,dt FROM `Location` where mac_address in (select mac_id from notification_tble where logid='".$srno[0]."') and dt>'".$dt."' AND latitude != 0.000000");
     //   echo "SELECT id,latitude,longitude,dt FROM `Location` where mac_address in (select mac_id from notification_tble where logid='".$srno[0]."') and dt between '".$from."' and '".$to."'";
       // echo mysqli_num_rows($result).'<br>';
        //Multiple rows are returned
        while ($row = mysqli_fetch_array($result, mysqli_NUM))
        {
                       
                        $encodedString = $encodedString.$separator.
            "<p class='content'><b>Lat:</b> ".$row[1].
            "<br><b>Long:</b> ".$row[2].
            "<br><b>Name: </b>".$srno[1].
            "<br><b>Address: </b>".$row[3].
            "<br><b>Division: </b>".$row[3].
            "</p>&&&".$row[1]."&&&".$row[2]."&&&".$initials;
            $x = $x + 1;
                  } 
        ?>
        
        <?php
       // echo $encodedString;
        } } }
       // echo $encodedString;       
        ?>
        <input type="hidden" id="encodedString" name="encodedString" value="<?php echo $encodedString; ?>" />
        <form action="track.php" method="post" >
<?php if($_SESSION['designation']!=3){?>
        Select Branch :<?php } ?><select <?php if($_SESSION['designation']=="3"){?> style="display:none;" <?}?> name="branch" id="branch" required>
<?php if($_SESSION['designation']!="3")
{?>
                      <option value="-1" >select</option>
<?php } ?>
        <?php while($row=mysqli_fetch_row($qrybranch)){ ?>
        <option value="<?php echo $row[0]; ?>" <?php if($_POST["branch"]==$row[0]){ echo "selected";}?>><?php echo $row[1]; ?></option>
        <?php } ?>
        </select>
         Enter ID :<input type="text" name="pid" id="pid" value="<?php echo $_POST["pid"]; ?>" size="10"/>
         From Date :<input type="text" name="date" id="date"  onclick="displayDatePicker('date');" value="<?php echo $_POST["date"]; ?>"  required/>
         To Date :<input type="text" name="date2" id="date2" onclick="displayDatePicker('date2');"  value="<?php echo $_POST["date2"]; ?>" required/> 
        <input type="submit" value="Search" />
        </form>
    </div>
       </body>
</html>

 
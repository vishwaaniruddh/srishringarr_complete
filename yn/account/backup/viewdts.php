<?php include("config.php");
include('functions.php');

    $num=0;
    //echo $sql;
    $strPage = $_POST['Page'];
    $typ=$_POST['typ'];
    $subcattyp=$_POST['subcattyp'];
    $transtyp=$_POST['transtyp'];
    $maincatid=$_POST['maincatid'];
    $subcatid=$_POST['subcatid'];
    $todaysdt=date("Y-m-d");
    $offst= $_POST['offst'];
    $discountfilter=$_POST["discountfilter"];
    $prcfilter= $_POST['prcfilter'];
    $size= $_POST['size'];
    
    $stockOut =$_POST['stockOut'];
    $stockIn =$_POST['stockIn'];
    
    $maketemp = "CREATE TEMPORARY TABLE tempprdets(prcode varchar(1000),amt double,rentpr double,depositr double,disc double)";
    $exec=mysql_query($maketemp);

    /*Ruchi : viewAll product based on main category*/

    if(($subcatid==0 && $maincatid>0) || ($subcatid==0 && $maincatid==0)){
        if($typ=="1")
        {
        $sql="SELECT * FROM `product` WHERE `categories_id`='".$maincatid."'";
        $sql24="SELECT name  FROM `subcat1` WHERE `maincat_id`='".$maincatid."'";
        }
        else if($typ=="2")
        {
            $sql="select * from  `garment_product` where product_for='".$maincatid."' and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)";
            $sql24="SELECT name  FROM `garments` WHERE `garment_id`='".$maincatid."'";
        }
        
    } else {
        if($typ=="1")
        {
            $sql="SELECT * FROM `product` WHERE `subcat_id`='".$subcatid."'";
            $sql24="SELECT name  FROM `subcat1` WHERE `subcat_id`='".$subcatid."'";
        }
        else if($typ=="2")
        {
            $sql="select * from  `garment_product` where product_for='".$maincatid."' and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)";
            $sql24="SELECT name  FROM `garments` WHERE `garment_id`='".$maincatid."'";
        }
    }

    $pidarr="";

    $prchsproid=mysqli_query($con3,"select b.name from phppos_purchase_details a, phppos_items b where a.item_id=b.item_id order by a.pur_id desc");
    $prchsproidnr=mysqli_num_rows($prchsproid);
    $popiprcodearr=[];

    while($prchid=mysqli_fetch_row($prchsproid))
    {
       // $popiprcodearr=$prchid[0];
        array_push($popiprcodearr, $prchid[0]);
    /*if($pidarr==""){
        
        $pidarr="'".$prchid[0]."'";
    }else{
        
        $pidarr=$pidarr.","."'".$prchid[0]."'";
    }*/
    	
    }
    //echo $pidarr;

    /*if($typ=="1")
    {
        $sql=$sql." and product_code in ($pidarr)";
    
        //$sql=$sql." order by field(product_code,$pidarr)  LIMIT $Page_Start , $Per_Page";
    }
    else if($typ=="2")
    {
        $sql=$sql." and gproduct_code in ($pidarr)";

        //$sql=$sql." order by field(gproduct_code,$pidarr)  LIMIT $Page_Start , $Per_Page";
    }*/
    /**********************************filter ***************************************************/

    if($prcfilter=="3")
    {
        /************if popular is selectd*********************/
        for($c=0;$c<count($popiprcodearr);$c++)
        {
            if($pidarr==""){
            
                $pidarr="'".$popiprcodearr[$c]."'";
            } else {
                $pidarr=$pidarr.","."'".$popiprcodearr[$c]."'";
            }
        }
        
        if($discountfilter!="")
        {
            //  echo "###--".$discountfilter."---###";
            if($discountfilter=="1")
            {
                $sql=$sql." and discount<30 and discount>0";
            }
            
            if($discountfilter=="2")
            {
                $sql=$sql." and discount BETWEEN 30 AND 50";
            }
            
            if($discountfilter=="3")
            {
                $sql=$sql." and discount BETWEEN 50 AND 70";
            }
        }
        
        if($typ=="2"){
            if($size!="")
            {
                //$sql=$sql." and size = '".$size."'  ";
                $sql=$sql." and FIND_IN_SET('".$size."',`size_avail`)";
            }
        }
        
        
         /************if popular is selectd end*********************/
    }

    if($prcfilter=="1" || $prcfilter=="2")
    {
        /************if other options are selected *********************/
    
    	$tablefilt=mysql_query($sql);
    	while($rowf=mysql_fetch_array($tablefilt))
        {
        
            if($typ=="1")
            {
                $prcodef=$rowf[2];
            }
            else
            {
                $prcodef=$rowf[2];
            }
            //echo "SELECT unit_price FROM satyavan_pos.phppos_items where name='".$prcode."'";
            //echo "SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$prcode."'";
            $ref = mysqli_query($con3,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$prcodef."'");
            $rerof=mysqli_fetch_row($ref);
            $re1f = mysqli_query($con3,"select sum(commission_amt) from order_detail where item_id='".$prcodef."' and bill_id in(select bill_id from phppos_rent where booking_status!='Booked')");
            $rero1f=mysqli_fetch_row($re1f);
            $currentspf=$rerof[0]-$rero1f[0];
            $splimitf=$rerof[1]*0.8;
            if($currentspf>$splimitf)
                $newspf=$currentspf;
            else
            $newspf=$splimitf;
        
            if($rerof[0]<=30000)
            $rentpricef=$rerof[0]*0.2;
            else if($rerof[0]<=60000)
            $rentpricef=$rerof[0]*0.15;
            else
            $rentpricef=$rerof[0]*0.12;
        
        	//$path=substr($row[1],7);
    
            $depositf=$rerof[1]-$rentpricef; 
            
            
            $qtyf=round($rerof[2]);
            $qtyrf=round($rerof[2]);/*used when type is rent */
    
    
            if($typ=="1")
            {
                if($rowf[11]!="" & $rowf[11]>0.00)
                {
                    //echo $rws[11];
                    $newspf=$rowf[11];
                }
                
                if($rowf[12]!="" & $rowf[12]>0.00)
                {
                    $rentpricef=$rowf[12];
                }
                
                if($rowf[15]!="" & $rowf[15]>0.00)
                {
                    $depositf=$rowf[15];
                }
            }
    
            if($typ=="2")
            {
                if($rowf[8]!="" & $rowf[8]>0.00)
                {
                    //echo $rws[8];
                    $newspf=$rowf[8];
                }
                if($rowf[9]!="" & $rowf[9]>0.00)
                {
                    $rentpricef=$rowf[9];
                }
                if($rowf[12]!="" & $rowf[12]>0.00)
                {
                    //echo $row[12];
                    $depositf=$rowf[12];
                }
            }
    
            $filtinsqr=mysql_query("insert into tempprdets(prcode,amt,rentpr,depositr,disc)values('".$prcodef."','".$newspf."','".$rentpricef."','".$depositf."','".$rowf["discount"]."')");
            //echo "yeah".mysql_error();
    
    	    if (!in_array($prcodef, $popiprcodearr))
            {
                array_push($popiprcodearr, $prcodef);
            }
        }
    
        $fltrstr="select *  from tempprdets where 1";
    
        if($discountfilter!="")
        {
            if($discountfilter=="1")
            {
                $fltrstr=$fltrstr." and disc<30 and disc>0";
            }
        
            if($discountfilter=="2")
            {
                $fltrstr=$fltrstr." and disc BETWEEN 30 AND 50";
            }
        
            if($discountfilter=="3")
            {
                $fltrstr=$fltrstr." and disc BETWEEN 50 AND 70";
            }
        }
    
        if($prcfilter=="1")
        {
            if($transtyp=="1" || $transtyp=="" || $transtyp=="0")
            {
                $fltrstr=$fltrstr." order by rentpr desc";
            } else
            {
                $fltrstr=$fltrstr." order by amt desc";  
            }  
        }
        if($prcfilter=="2")
        {
            if($transtyp=="1" || $transtyp=="" || $transtyp=="0")
            {
                $fltrstr=$fltrstr." order by rentpr asc";
            } else
            {
                $fltrstr=$fltrstr." order by amt asc";  
            }  
        } 
        
        if($typ=="2"){
            if($size!="")
            {
                //$sql=$sql." and size = '".$size."'  ";
                $sql=$sql." and FIND_IN_SET('".$size."',`size_avail`)";
                
            }
        }
        
    
       // echo   $fltrstr;
        $prcfilterdstring="";
        ?>
        <table border="1">
            <?php
            $fltfqr=mysql_query($fltrstr);
            while($gtprfilpr=mysql_fetch_array($fltfqr))
            { ?>
                <!--<tr>
                <td><?php echo $gtprfilpr[0];?></td>
                <td><?php echo $gtprfilpr[1];?></td>
                <td><?php echo $gtprfilpr[2];?></td>
                <td><?php echo $gtprfilpr[3];?></td>
                <td><?php echo $gtprfilpr[4];?></td>
                  
                </tr>-->
              <?php
              if($prcfilterdstring=="")
                {
                    // echo "ok";
                    $prcfilterdstring="'".$gtprfilpr[0]."'";
                }
                else
                {
                    $prcfilterdstring=$prcfilterdstring.","."'".$gtprfilpr[0]."'";
                }
            }
        $pidarr=$prcfilterdstring;
        ?>
    </table>
<?php }
/**************************************8filter end*********************************************/
$gtnm=mysql_query($sql24);
$nmrws=mysql_fetch_array($gtnm);
$table=mysql_query($sql);
$Num_Rows = mysql_num_rows ($table);
?>
<div align="center" style="display:none" >
Records Per Page :
<select name="perpg" id="perpg" onChange="funcs('1','perpg');"><br>
    <?php
    for($i=1;$i<=$Num_Rows;$i++)
    {
        if($i%10==0)
        { ?>
            <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
        <?php }
    } ?>
    <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
</select>
</div>
<style>
.drp1{
   padding:3px;
   background-color: #DFD3D4;
   border-radius:5px;
   padding: 10px;
   width:50%;
}
.drp{
    padding: 3px;
    background-color: #DFD3D4;
    border-radius:5px;
    padding: 10px;
    width:60%
}

</style>
<!--<div class="row">
<div class="col-sm-3">
<select class="drp">
  <option label="select category"></option>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="opel">Opel</option>
  <option value="audi">Audi</option>
</select>
</div>
 <div class="col-sm-4">
<select class="drp1">
  <option label="Discount"></option>
  <option value="volvo">20%_40%</option>
  <option value="saab">40%_60%</option>
  <option value="opel">60%_80%</option>
</select>
</div>-->

</div>

 <?php
// pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
 
 
 //echo $Per_Page;
$Page = $strPage;
//echo "pg".$Page;
if($strPage=="")
{
	$Page=1;
}
 
//echo $Page;
$Prev_Page = $Page-1;
$Next_Page = $Page+1;

//echo "nxt".$Next_Page;
$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}



     
        
        
        
if($typ=="1")
{
	

//$sql=$sql." and product_code in ($pidarr)";

/*$sql=$sql." order by field(product_code,$pidarr)  desc LIMIT $offst , $Per_Page";*/
$sql=$sql." order by product_code desc LIMIT $offst , $Per_Page";
    
}
else if($typ=="2")
{
    //$sql=$sql." and gproduct_code in ($pidarr)";
    /*$sql=$sql." order by field(gproduct_code,$pidarr) desc LIMIT $offst , $Per_Page";*/
    $sql=$sql." order by gproduct_code desc LIMIT $offst, $Per_Page";
}

//echo $sql;
if($pidarr=="")
{
    
 echo "NO Data to display";   
}
else
{
    $qrys=mysql_query($sql);
	//echo $View;	
	$i=0;
?>
 <?php if($offst=="0" && $stockIn==1) {?>
			<h2> <?php echo strtoupper($nmrws[0]);?></h2>	
			</br>	

<?php
}
while($row=mysql_fetch_array($qrys))
{

if($typ=="1")
{
$prcode=$row[2];
}
else
{
$prcode=$row[2];
}
   //echo "SELECT unit_price FROM satyavan_pos.phppos_items where name='".$prcode."'";
   //echo "SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$prcode."'";
     $re = mysqli_query($con3,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$prcode."'");
    $rero=mysqli_fetch_row($re);
    $re1 = mysqli_query($con3,"select sum(commission_amt) from order_detail where item_id='".$prcode."' and bill_id in(select bill_id from phppos_rent where booking_status!='Booked')");
    $rero1=mysqli_fetch_row($re1);
    $currentsp=$rero[0]-$rero1[0];
    $splimit=$rero[1]*0.8; 
    if($currentsp>$splimit)
    $newsp=$currentsp;
    else
    $newsp=$splimit;
    
    if($rero[0]<=30000)
    $rentprice=$rero[0]*0.2;
    else if($rero[0]<=60000)
    $rentprice=$rero[0]*0.15;
    else
    $rentprice=$rero[0]*0.12;
    
    //$path=substr($row[1],7);

    $deposit=$rero[1]-$rentprice; 
    
    $qty=round($rero[2]);
    $qtyr=round($rero[2]);/*used when type is rent */
if($typ=="1")
{
    $sqlimg="SELECT img_name FROM `product_images_new` WHERE `product_id`='".$row[0]."'";
}
else
{
    $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='".$row[0]."'";
}

if($typ=="1")
{
    if($row[11]!="" & $row[11]>0.00)
    {
        //echo $rws[11];
        $newsp=$row[11];
    }

    if($row[12]!="" & $row[12]>0.00)
    {
        $rentprice=$row[12];
    }
    if($row[15]!="" & $row[15]>0.00)
    {
        $deposit=$row[15];
    }
}

if($typ=="2")
{
    if($row[8]!="" & $row[8]>0.00)
    {
        //echo $rws[8];
        $newsp=$row[8];
    }

    if($row[9]!="" & $row[9]>0.00)
    {
        $rentprice=$row[9];
    }
    if($row[12]!="" & $row[12]>0.00)
    {
        //echo $row[12];
        $deposit=$row[12];
    }
}

//echo $sqlimg;
$qryimg=mysql_query($sqlimg);
$rowimg=mysql_fetch_row($qryimg);
//echo mysql_error();
// $path='uploads'.$rowimg[0];
 
$path=trim($pathmain."uploads".$rowimg[0]);
//echo $path;

$expl=explode('/',$path);

$cnt=count($expl);
//print_r($expl);
//echo "cnnn-".$cnt;
$pth1=trim($pathmain."thumbs/".$expl[$cnt-1]);
//echo $pth1;

$qrybk=mysqli_query($con3,"SELECT * FROM `order_detail` where `item_id`='".$row[2]."' and bill_id in(SELECT bill_id  FROM `phppos_rent` WHERE (`pick_date` >=".$todaysdt." or `delivery_date` >=".$todaysdt.")  and booking_status!='Returned'  ORDER BY `phppos_rent`.`pick_date` ASC) group by bill_id");
//echo $qrybk;
echo mysql_error();
//$exqrbk=mysql_query($qrybk);
$nrwbk=mysqli_num_rows($qrybk);


if($transtyp=="2")
{
    $qrybk2=mysqli_query($con3,"SELECT * FROM `order_detail` where `item_id`='".$row[2]."' and bill_id in(SELECT bill_id  FROM `phppos_rent` WHERE (`pick_date` >=".$todaysdt." or `delivery_date` >=".$todaysdt.") and booking_status!='Returned' ORDER BY `phppos_rent`.`pick_date` ASC) group by bill_id");
    
    $dtarr=array();

while($gtfrbk2=mysqli_fetch_array($qrybk2))
{
    $qryrentbk=mysqli_query($con3,"Select pick_date, delivery_date from phppos_rent where bill_id='".$gtfrbk2[0]."'");
    $qty=$qty-$gtfrbk2[9];
}
}
else
{

//echo "SELECT * FROM `order_detail` where `item_id`='".$row[2]."' and bill_id in(SELECT bill_id  FROM `phppos_rent` WHERE `pick_date` >= now() AND `delivery_date` >= now() ORDER BY `phppos_rent`.`pick_date` ASC) group by bill_id";
$qrybk2=mysqli_query($con3,"SELECT * FROM `order_detail` where `item_id`='".$row[2]."' and bill_id in(SELECT bill_id  FROM `phppos_rent` WHERE (`pick_date` >=".$todaysdt." or `delivery_date` >=".$todaysdt.") and booking_status!='Returned' ORDER BY `phppos_rent`.`pick_date` ASC) group by bill_id");

$dtarr=array();

while($gtfrbk2=mysqli_fetch_array($qrybk2))
{
$qryrentbk=mysqli_query($con3,"Select pick_date, delivery_date from phppos_rent where bill_id='".$gtfrbk2[0]."'");
$qtyr=$qtyr-$gtfrbk2[9];
}


$qrybk23=mysqli_query($con3,"SELECT * FROM `order_detail` where `item_id`='".$row[2]."' and bill_id in(SELECT bill_id  FROM `phppos_rent` WHERE (`pick_date` >=".$todaysdt." or `delivery_date` >=".$todaysdt.") and booking_status='Picked' ORDER BY `phppos_rent`.`pick_date` ASC) group by bill_id");

while($gtfrbk23=mysqli_fetch_array($qrybk23))
{
$qty=$qty+$gtfrbk23[9];
//echo "SELECT count(bill_id) FROM `order_detail` where `item_id`='".$rws[2]."' and bill_id in(SELECT bill_id  FROM `phppos_rent` WHERE `pick_date` >= now() AND `delivery_date` >= now() and booking_status='Picked' ORDER BY `phppos_rent`.`pick_date` ASC) group by bill_id";
}
}

if($stockIn ==1 && $qty>0 && $rero1[0]==0){ ?>
    <a href="javascript:void(0)" onclick="subf('<?php echo $row[0];?>');">
    <!--<div class="product-grid love-grid " >-->
    
    
    <div class="product-grid love-grid col-md-3 col-sm-6 col-xs-6" >
    <div class="more-product"><span> </span></div>						
    <div class="product-img b-link-stripe b-animate-go ss thickbox">
    <!--<img style="height:220px;" src="<?php echo $path;?>" class="img-responsive" alt=""/>-->
    <img  src="<?php echo $path;?>" class="img-responsive" alt=""/>
    <div class="b-wrapper">
    <h6 class="b-animate b-from-left  b-delay03">							
    <button type="button" class="btns"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>Quick View</button>
    </h6>
    </div>
    </div>
    </a>						
    <div class="product-info simpleCart_shelfItem" style="height:150px;">
    <div class="product-info-cust prt_name" >
        <p><?php echo $row[30]; ?></p>
        <h6 id="sku"><font color="#000000"><b>Product Code:</b></font> <?php echo $row[2] ?></h6>
        
       
        
        
        
        
        
        <h6 style="margin-top:-10px; margin-bottom:-2px;">
            <font color="#000000" ><b>Quantity:</b></font> 
            <?php echo $qty; ?>
        </h6> 
        
        <?php
        
        $is_price = check_price_db($row[2]);




        if($is_price){
                $current_db_price=get_price_currentdb($row[2]);
        
        // var_dump($current_db_price);
        
            echo $current_db_price; 
            
         }
        else{
        
        
        
        //&& $transtyp==2
        if($row['discount']>0){
            $ab=($row['discount']/100)*$rero[0];
            $newsp=$rero[0]-$ab;
           
        }
        //echo $row['discount'];
        if($rero[0]==$newsp)
        { ?>
            <h6 style="margin-bottom:-2px;">
            <font color="#000000" ><b style="margin-top:-10px;">Sales Price:</b></font>
            <?php echo $newsp;  ?> </br>
            </h6>
       
       <?php  } else { ?> 
       
            <font color="#000000">
                <b>Sales Price:</b>
            </font>
            
            <strike><?php echo $rero[0]; ?></strike>&nbsp;
            <font color="#00ff99">
                <b>Now </b>
            </font>
            
            <?php echo $newsp; ?>
            
            <br />
            <?php if($row['discount']>0 ){ ?><font color="#00ff99"><b>Flat</b></font> &nbsp;<?php echo $row['discount']; ?>%  off<br />
            <?php } 
        }
        if($transtyp=="1" || $transtyp=="") { ?>
            <font color="#000000"><b>Rent Price:</b></font> <?php echo $rentprice; ?><br />
            <font color="#000000"><b>Deposit:</b></font> <?php echo $deposit;?><br /> 
        <?php }
        
        }
        
    //  if($qty>0 ){ 
     ?>
        <?php
        //&& $transtyp==2
        if($row['discount']>0){
            $ab=($row['discount']/100)*$rero[0];
            $newsp=$rero[0]-$ab;
        }
        if($transtyp=="1" || $transtyp=="") {  ?>
            <font color="#000000"><b>Rent Price:</b></font> <?php echo $rentprice; ?><br />
            <font color="#000000"><b>Deposit:</b></font> <?php echo $deposit;?><br /> 
        <?php }
    }//qty
    else if($stockIn==2 && $qty==0) {   ?>
        <a href="javascript:void(0)" onclick="subf('<?php echo $row[0];?>');">
        <!--<div class="product-grid love-grid " >-->
        <div class="product-grid love-grid  col-md-3 col-sm-6 col-xs-6" >
            <div class="more-product"><span> </span></div>						
            <div class="product-img b-link-stripe b-animate-go ss thickbox">
                <img  src="<?php echo $path;?>" class="img-responsive" alt=""/>
                <div class="b-wrapper">
                    <h6 class="b-animate b-from-left  b-delay03">							
                        <button type="button" class="btns"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>Quick View</button>
                    </h6>
                </div>
            </div>
        </a>						
        <div class="product-info simpleCart_shelfItem" style="height:150px;">
            <div class="product-info-cust prt_name" >
                
                <h6><font color="#000000"><b>Product Code:</b></font> <?php echo $row[2]; ?></h6>
                <!--<h4 style="margin-top:-10px; margin-bottom:-2px;"><font color="#000000" ><b>Quantity:</b></font> <?php echo $qty; ?></h4>-->
                <font color="#ff0000"><b>OUT OF STOCK</b></font><br /><br/>
    <?php  } 
    /*if($transtyp=="1")
    {
        if($nrwbk>0)
        {
            $gtfrbk=mysqli_fetch_array($qrybk);
            $qryrentbk=mysqli_query($con3,"Select pick_date, delivery_date from phppos_rent where bill_id='".$gtfrbk[0]."'");
            		$resrentbk=mysqli_fetch_row($qryrentbk);
            echo   "Booking Status"."<br>";
            echo "From Date-".date('d-m-Y',strtotime($resrentbk[0]))."<br>";
            echo "To Date-".date('d-m-Y',strtotime($resrentbk[1]))."<br>";
        }
    } */
    ?>
<?php
if($qty>0){
/*  // Add to cart Start
if($transtyp=="1" || $transtyp=="" || $transtyp=="0" )
{
    ?>
<a href="javascript:void(0);" onclick="rentreqfunc('<?php echo $qtyr;?>','<?php echo $rentprice;?>','<?php echo $row[0];?>','<?php echo $deposit;?>','<?php echo $newsp;?>');" style="font-size: 0.8em;
display: inline-block;
background: #800000;
padding: 0.6em 2em;
color: #fff;
text-decoration: none;
font-weight: 500;
margin-top: 5px;">Add To Cart</a>
<!--<a href="javascript:void(0);" <?php if($qtyr>0) { ?> onclick="popupfun2();" <?php }else {?>onclick="popupfun1();" <?php }?>>Rent Now</a>-->
<?php 
}else if($transtyp=="2")
{?>
<a href="javascript:void(0);" onclick="salefuncreq('<?php echo $qty;?>','<?php echo $newsp;?>','<?php echo $row[0];?>');" style="font-size: 0.8em;
display: inline-block;
background: #800000;
padding: 0.6em 2em;
color: #fff;
text-decoration: none;
font-weight: 500;
margin-top: 5px;">Add To Cart</a>
<?php
}*/ // Add to cart end
 } 

?>

               

								<!--<h4>Jewellery #1</h4>
								<p>ID: SR4598</p>
								<span class="item_price">$187.95</span>								
								<input type="text" class="item_quantity" value="1"  readonly/>
								<input type="button" class="item_add items" value="ADD">-->
							</div>	
							
							<?php
							
							if($stockIn==1 && $qty>0 && $rero1[0]==0) { ?>
    							<a href="javascript:void(0);" class="btn btn-default btn-cart col-xs-6 col-sm-6" onclick="final_addtocart1('<? echo $row[2];?>','<?php echo $qty;?>','<?php echo $newsp;?>','<?php echo  $row[0];?>','<?php echo $transtyp;?>',this.id);">Add to Cart</a>
                                <!--<a href="showcart_details.php?pid=<?php echo $prid; ?>" class="btn btn-default btn-cart col-xs-6 col-sm-6">Buy Now</a>-->
                                <a href="javascript:void(0);" class="btn btn-default btn-cart col-xs-6 col-sm-6" onclick="buy('<? echo $row[2];?>','<?php echo $qty;?>','<?php echo $newsp;?>','<?php echo  $row[0];?>','<?php echo $transtyp;?>',this.id);">Buy Now</a>
                                
                            <?php } ?>
							<!--<div class="clearfix"> </div>-->
						</div>
						
					</div>	
					
<?php 
$num++;
//echo "totnm".$num;

} ?>

<?php
/*while($num<12)
{
?>

<a href="javascript:void(0)"><div class="product-grid love-grid">
						<div class="more-product"><span> </span></div>						
						<div class="product-img b-link-stripe b-animate-go  thickbox">
							
							<div class="b-wrapper">
							<h4 class="b-animate b-from-left  b-delay03">							
							
							</h4>
							</div>
						</div></a>						
						<div class="product-info simpleCart_shelfItem" style="height:150px;">
							<div class="product-info-cust prt_name" >


								</div>	
								<div align="center" style="margin-top:-50px;"> </div>

							<div class="clearfix"> </div>
						</div>
					</div>	

<?php
$num++;
}*/
?>
<div>


<div align="center" > 

<input type="text" id="hr<?php echo $offst;?>" style="background:transparent;border:none" readonly> 
 <?php if($offst=="0") {?>
    <input type="hidden" name="numrows" id="numrows" value="<?php echo $Num_Rows;?>">
    <?php } ?>
    
    
<?php
/*
if($Prev_Page) 
{

?>
<button type="button" onclick="funcs('<?php echo $Prev_Page;?>','perpg')"> << Previous </button>
	

<?php
}


if($Page!=$Num_Pages)
{
	?>


<button type="button" onclick="funcs('<?php echo $Next_Page;?>','perpg');"> Next >> </button>


<?php
}

*/

?>
</div>
<?php } ?>
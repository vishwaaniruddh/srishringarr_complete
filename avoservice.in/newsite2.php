<?php
include("access.php");
//echo $_SESSION['logid']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<style>
.space{margin-left:0px;}//80
.addcolor{font-size:20px; color:#C60000; font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
</style>
<!--datepicker-->
<link href="../datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="../datepicker/datepick_js.js" type="text/javascript"></script>
<script src="jquery-1.8.3.js"></script>
<script>
$(document).ready(function(){
$('#bb1').hide();
$('#bbr1').hide();
$('#bb2').hide();
$('#bbr2').hide();
$('#bb3').hide();
$('#bbr3').hide();
$('#bb4').hide();
$('#bbr4').hide();
$('#bb5').hide();
$('#bbr5').hide();
$('#type2').click(function(){
$('#war1').hide();
$('#war').hide();
$('#war2').hide();
$('#w1').hide();
$('#war3').hide();
$('#w2').hide();
$('#war4').hide();
$('#w3').hide();
$('#war5').hide();
$('#w4').hide();
$('#bb1').show();
$('#bbr1').show();
$('#bb2').show();
$('#bbr2').show();
$('#bb3').show();
$('#bbr3').show();
$('#bb4').show();
$('#bbr4').show();
$('#bb5').show();
$('#bbr5').show();
});
$('#type').click(function(){
$('#war1').show();
$('#war').show();
$('#war2').show();
$('#w1').show();
$('#war3').show();
$('#w2').show();
$('#war4').show();
$('#w3').show();
$('#war5').show();
$('#w4').show();
$('#bb1').hide();
$('#bbr1').hide();
$('#bb2').hide();
$('#bbr2').hide();
$('#bb3').hide();
$('#bbr3').hide();
$('#bb4').hide();
$('#bbr4').hide();
$('#bb5').hide();
$('#bbr5').hide();

});
});
</script>

<script type="text/javascript">

//=============================start send assets=====================================
function sendAssets(){
				//start here sending data
				alert("hi2");
				document.getElementById("mysub").disabled = true;
				if (window.XMLHttpRequest)				 
				  {
					  // code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
				  xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
					alert(xmlhttp.responseText);
					
					if(xmlhttp.responseText==""){
						document.getElementById("mysub").innerHTML ="<center><img src=ajax-loader.gif></center>";
						}
						
					str=xmlhttp.responseText;
					//alert (str);
					str2=str.split("**##");
					//alert("hi");
					//alert("value of response o or 1="+str2[0]);
					if(str2[0]==1){	
							document.getElementById('atm').value="";
							document.getElementById('area').value="";
							document.getElementById('pin').value="";
							document.getElementById('city').value="";
							document.getElementById('address').value="";
							//document.getElementById('bank').value="";
							document.getElementById('state').value=""; 
//document.getElementById('ref').value=""; 
//document.getElementById('bank').value="";
document.getElementById('site_branch').value="";
document.getElementById('contact').value="";
document.getElementById('contactno').value="";

							document.getElementById('addsite').value=str2[1];
							
							//alert("Data is not uploaded successfully");					
						alert("Data uploaded successfully");
						document.getElementById("mysub").disabled = false;



						}else{
							
							alert("Data not uploaded successfully");
							document.getElementById("mysub").disabled = false;
							}
					
					}
				  }   
				  nos=document.getElementById('nos').value;
				  //alert(nos); 
				  cust=document.getElementById('cust').value;
//alert("customer id"+cust);
                            if (document.getElementById('type').checked) {
                          type = document.getElementById('type').value;
                            }
                          if (document.getElementById('type2').checked) {
                          type = document.getElementById('type2').value;
                            }

				  
				  servicetype=document.getElementById('servicetype').value;
				  po=document.getElementById('po').value;
				  podt=document.getElementById('podt').value;
				  sp=document.getElementById('sp').value;
				  atm=document.getElementById('atm').value;
				  bank=document.getElementById('bank').value;
				  area=document.getElementById('area').value;
				  pin=document.getElementById('pin').value;
				  city=document.getElementById('city').value;
				  state=document.getElementById('state').value;
				  site_branch=document.getElementById('site_branch').value;
				  address=document.getElementById('address').value;
				  address_clean = encodeURIComponent(address);
				  ref=document.getElementById('ref').value;
				  dt=document.getElementById('dt').value;
				  
				                 nos=document.getElementById('nos').value;
						 del_type=document.getElementById('del_type').value;
						 baddt=document.getElementById('badd').value;
                                                 badd_= encodeURIComponent(baddt);
						 gst_=document.getElementById('gst').value;
						 contact_=document.getElementById('contact').value;
						 contactno_=document.getElementById('contactno').value;
				  
				  //======================================================
				  /*
				  ups=document.getElementById('ups').value;
				  upsno=document.getElementById('upsno').value;
				  upswr=document.getElementById('upswr').value;
				  upsrate=document.getElementById('upsrate').value;
				 
				  btry=document.getElementById('btry').value;
				  btryno=document.getElementById('btryno').value;
				  btrywr=document.getElementById('btrywr').value;
				  batteryrate=document.getElementById('batteryrate').value;
				   
				isot=document.getElementById('isot').value;
				isotno=document.getElementById('isotno').value;
				isotwr=document.getElementById('isotwr').value;
				isotrate=document.getElementById('isotrate').value;
					        
					        stab=document.getElementById('stab').value;
						stabno=document.getElementById('stabno').value;
						 stabwr=document.getElementById('stabwr').value;
						 stabrate=document.getElementById('stabrate').value;
						 
						 avr=document.getElementById('avr').value;
						 avrno=document.getElementById('avrno').value;
						 avrwr=document.getElementById('avrwr').value;
						 avrrate=document.getElementById('avrrate').value;
						 
						 
						 
						 
						
						 ubrate=document.getElementById('upsbbrate').value;
						 batbrate=document.getElementById('batbbrate').value;
						 isobrate=document.getElementById('isobbrate').value;
						 stbrate=document.getElementById('stbbrate').value;
						 avbrate=document.getElementById('avrbbrate').value;
						 
						 */
						 bbdt=document.getElementById('bbd').value;
                                                 bbd_= encodeURIComponent(bbdt);
                                                 bbdrate_=document.getElementById('bbdrate').value;
                                                 oth=document.getElementById('oth').value;
						 othrate=document.getElementById('othrate').value;
						 bback=document.getElementById('bback').value;
						 
						 
var selchbox1 = [];
var inputfields1 = document.getElementsByName("Material[]");

for (var i = 0; i < inputfields1.length; i++)
{
 selchbox1.push(inputfields1[i].value);
 
}

var srr= selchbox1;


var selchbox2 = [];
var inputfields2 = document.getElementsByName("Model[]");

for (var i = 0; i < inputfields2.length; i++)
{
 selchbox2.push(inputfields2[i].value);
 
}

var model= selchbox2;


var selchbox3 = [];
var inputfields3 = document.getElementsByName("upsno[]");

for (var i = 0; i < inputfields3.length; i++)
{
 selchbox3.push(inputfields3[i].value);
 
}

var upsno= selchbox3;


var selchbox4 = [];
var inputfields4 = document.getElementsByName("upswr[]");

for (var i = 0; i < inputfields4.length; i++)
{
 selchbox4.push(inputfields4[i].value);
 
}

var upswr= selchbox4;

var selchbox5 = [];
var inputfields5 = document.getElementsByName("upsrate[]");

for (var i = 0; i < inputfields5.length; i++)
{
 selchbox5.push(inputfields5[i].value);
 
}

var upsrate= selchbox5;

var neweml=document.getElementById('neweml').value
			if(srr>0 ||model>0 || upsno>0 || upswr>0 || upsrate>0)	
			{
					var url = "test_process_newsiteme2.php";		
					var params='cust='+cust+'&type='+type+'&servicetype='+servicetype+'&po='+po+'&atm='+atm+'&bank='+bank+'&area='+area+'&pin='+pin+'&city='+city+'&state='+state+'&address='+address_clean+'&ref='+ref+'&badd='+badd_+'&gst='+gst_+'&cont='+contact_+'&cno='+contactno_+'&bbd='+bbd_+'&bbdrate='+bbdrate_+'&dt='+dt+'&nos='+nos+'&site_branch='+site_branch+'&deltype='+del_type+'&ubrate='+ubrate+'&batbrate='+batbrate+'&oth='+oth+'&othrate='+othrate+'&podt='+podt+'&sp='+sp+'&neweml='+neweml+'&bback='+bback+'&srr='+srr+'&model='+model+'&upsno='+upsno+'&upswr='+upswr+'&upsrate='+upsrate;
					//alert(params);
					xmlhttp.open("POST",url, true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send(params);
					}
					else alert("Please enter at least one asset");
			}
	

//=========================Form validation
//

function validate(form)
{
			with(form)
				{
				
				//==================================
				/*if(addsite.value == nos.value )
				{
				alert("You have completed " +nos.value+ " site against Purchase Order.");
				document.getElementById('ups').disabled=true;
				document.getElementById('upsno').disabled=true ;
				document.getElementById('upswr').disabled=true ;
				document.getElementById('upsrate').disabled=true ;
				
				document.getElementById('btry').disabled=true ;
				document.getElementById('btryno').disabled=true ;
				document.getElementById('btrywr').disabled=true ;
				document.getElementById('batteryrate').disabled=true ;
				
				document.getElementById('isot').disabled=true ;
				document.getElementById('isotno').disabled=true ;
				document.getElementById('isotwr').disabled=true ;
				document.getElementById('isotrate').disabled=true ;
				
				document.getElementById('stab').disabled=true ;
				document.getElementById('stabno').disabled=true ;
				document.getElementById('stabwr').disabled=true ;
				document.getElementById('stabrate').disabled=true ;
				
				document.getElementById('avr').disabled=true ;
				document.getElementById('avrno').disabled=true ;
				document.getElementById('avrwr').disabled=true ;
				document.getElementById('avrrate').disabled=true ;
				
				alert("ghghg");		
				return false;
				}	*/
				//==============================================
				if(cust.value=="0" || cust.value=="")
				{
				alert("Please Select Customer Name.");
				cust.focus();
				return false;
				}
				//if(ed.checked==true)alert("1");
				//else alert("0");
				//==============================================
				if(servicetype.value=="")
				{
				alert("Please Select Primitive maintenance.");
				servicetype.focus();
				return false;
				}
				//==============================================
				if(po.value=="")
				{
				alert("Please Enter Purchase Order.");
				po.focus();
				return false;
				}
				//==============================================
				if(ref.value=="")
				{
				alert("Please Enter Reference ID.");
				ref.focus();
				return false;
				}
				//==============================================
				if(nos.value=="" || nos.value<1 )
				{
				alert("Please Enter Atleast 1 Site.");
				nos.focus();
				return false;
				}
				//==============================================
				if(ups.value >0 && type.value=='sales')
				{ 
				if(upsno.value=='0' || upswr.value=='0')

				{
				alert("Please Select UPS Quantitiy And Warranty.");
				//upsno.focus();
				return false;
				}
				}
                               if(ups.value >0 && type.value=='AMC')
				{ 
				if(upsno.value=='0')

				{
				alert("Please Select UPS Quantitiy ");
				//upsno.focus();
				return false;
				}
				}
				//==============================================
				if(btry.value >0 && type.value=='sales')
				{ 
				if(btryno.value=='0' && btrywr.value=='0')
				{
				alert("Please Select Battery Quantitiy And Warranty.");
				//btryno.focus();
				return false;
				}
				}
                                if(btry.value >0 && type.value=='AMC')
				{ 
				if(btryno.value=='0')
				{
				alert("Please Select Battery Quantitiy");
				//btryno.focus();
				return false;
				}
				}
				//==============================================
				if(isot.value >0 && type.value=='sales')
				{ 
				if(isotno.value=='0' || isotwr.value=='0')
				{
				alert("Please Select Isolation Transformer Quantitiy And Warranty.");
				//isotno.focus();
				return false;
				}
				}
                                if(isot.value >0 && type.value=='AMC')
				{ 
				if(isotno.value=='0')
				{
				alert("Please Select Isolation Transformer Quantitiy");
				//isotno.focus();
				return false;
				}
				}
				//==============================================
				if(stab.value >0 && type.value=='sales')
				{ 
				if(stabno.value=='0' || stabwr.value=='0')
				{
				alert("Please Select Stabilizer Quantitiy And Warranty.");
				//stabno.focus();
				return false;
				}				
				}
                                if(stab.value >0 && type.value=='AMC')
				{ 
				if(stabno.value=='0')
				{
				alert("Please Select Stabilizer Quantitiy");
				//stabno.focus();
				return false;
				}				
				}
				//==============================================
				if(bank.value=="")
				{
				alert("Please Enter Bank Name.");
				bank.focus();
				return false;
				}
				//==============================================
				if(atm.value=="")
				{
				alert("Please Enter ATMID.");
				atm.focus();
				return false;
				}
				//==============================================
				if(area.value=="")
				{
				alert("Please Enter Area.");
				area.focus();
				return false;
				}
				//==============================================
				if(pin.value=="")
				{
				alert("Please Enter Pincode.");
				pin.focus();
				return false;
				}
				//==============================================
				if(city.value=="")
				{
				alert("Please Enter City.");
				city.focus();
				return false;
				}
				//==============================================
				if(site_branch.value=="")
				{
				alert("Please Select Branch.");
				site_branch.focus();
				return false;
				}
				//==============================================
				
				if(address.value=="")
				{
				alert("Please Enter Address.");
				address.focus();
				return false;
				}
				//==============================================
				if(state.value=="")
				{
				alert("Please Select State.");
				state.focus();
				return false;
				}
				if(bback.value=="-1")
				{
				alert("Please Select BuyBack option.");
				bback.focus();
				return false;
				}
				siteexist()
							
		}
}

//==================get DATA FROM PURCHASE_ORDER ===============================================

function getpo(){
	//alert("hi");
	if (window.XMLHttpRequest)				 
	  {
		  // code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		//alert(xmlhttp.responseText);
	
		response=xmlhttp.responseText;
		response2=response.split("**##");
		//alert('index1='+response2[0]);
		//alert('index2='+response2[1]);
		//alert('index3='+response2[2]);
		if(response2[2]==-1){
		document.getElementById('nos').readOnly;		
		document.getElementById('addsite').value=response2[0];
		document.getElementById('bank').value=response2[1];
		document.getElementById('nos').value="";
		//document.getElementById('nos').readOnly=true;
		document.getElementById('cust').value=response2[3];
		document.getElementById('ref').value="";
		document.getElementById('servicetype').value=response2[5];
		//alert(response2[6]);
		}else{
			document.getElementById('nos').readOnly;		
			document.getElementById('addsite').value=response2[0];
			document.getElementById('bank').value=response2[1];
			document.getElementById('nos').value=response2[2];
			//document.getElementById('nos').readOnly=true;
			document.getElementById('cust').value=response2[3];
			document.getElementById('ref').value=response2[4];
			document.getElementById('servicetype').value=response2[5];
				
			}
			//yy=document.getElementById('addsite').value;	
			//alert(response2[6]);		
			if(response2[6]="undefined"){
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!
			var yyyy = today.getFullYear();
			today = dd+'/'+mm+'/'+yyyy;
			//alert(today);
			dd=document.getElementById('dt').value=today;
			}else{						
			ndd=document.getElementById('dt').value=response2[6];
		//alert("ndd="+str2[6]);
			}
			
			if(response2[2]==-1){
			//alert("in disable = false");	
			//alert(response2[2]);
			document.getElementById('nos').disabled=false;
			document.getElementById('ref').disabled=false;
			document.getElementById('servicetype').disabled=false;
			document.getElementById('cust').disabled=false;		
			}else{
				//alert("in disable = true");
				document.getElementById('nos').disabled=true;
				document.getElementById('ref').disabled=true;
				document.getElementById('servicetype').disabled=true;
				document.getElementById('cust').disabled=true;
				}
		
		
		/*
		
		    //alert("str2[6]="+str2[6]);
			
			response3=response2[7].split("****");
			//alert(str3);
			//alert(response2[7]);
			for(i=0;i<response3.length ;i++){
				
					if(response3[i]=='UPS'){
						document.getElementById('ups').value=response3[i+1];
						document.getElementById('upsno').value=response3[i+2];
						document.getElementById('upswr').value=response3[i+3];
						document.getElementById('upsrate').value=response3[i+4];
					}
					if(response3[i]=='Battery'){
						document.getElementById('btry').value=response3[i+1];
						document.getElementById('btryno').value=response3[i+2];
						document.getElementById('btrywr').value=response3[i+3];
						document.getElementById('batteryrate').value=response3[i+4];
					}
					if(response3[i]=='Isolation Transformer'){
						document.getElementById('isot').value=response3[i+1];
						document.getElementById('isotno').value=response3[i+2];
						document.getElementById('isotwr').value=response3[i+3];
						document.getElementById('isotrate').value=response3[i+4];
					}
					if(response3[i]=='Stabilizer'){
						document.getElementById('stab').value=response3[i+1];
						document.getElementById('stabno').value=response3[i+2];
						document.getElementById('stabwr').value=response3[i+3];
						document.getElementById('stabrate').value=response3[i+4];
					}
					if(response3[i]=='AVR'){
						document.getElementById('avr').value=response3[i+1];
						document.getElementById('avrno').value=response3[i+2];
						document.getElementById('avrwr').value=response3[i+3];
						document.getElementById('avrrate').value=response3[i+4];
					}
				}
				*/
		}
	  }   
    		
	newpo=document.getElementById('po').value;
	//alert('getpo_detail.php?po='+newpo);			  					
	xmlhttp.open("GET",'getpo_detail.php?po='+newpo, true);					
	xmlhttp.send();	
	}
	
// does site exist
function siteexist(){
	atm=document.getElementById('atm').value;
	  //alert("hi");
	if (window.XMLHttpRequest)				 
	  {
		  // code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
				
		allatmdata=xmlhttp.responseText;
		//alert(allatmdata);
		data=allatmdata.split("##");
				if(data[0]==1 && document.getElementById('type').checked)
				{
				 var Check = confirm("The site already exist and only the assets will be updated.Would you like to continue?");
                                 if(Check) {
                                 alert("yes");
                                                    sendAssets();
                                 		   }			
				}
				else if(data[0]==0 && document.getElementById('type2').checked)
				{
				 alert("Their in no such site in amc database. Sorry , correct the atmid and try again");                                
				}
				else if(data[0]==2 && document.getElementById('type').checked){
				alert("The site already exist in amc database. Sorry , correct the atmid and try again");                                 
				}
				else if(data[0]==1 && document.getElementById('type2').checked){
				alert("The site exist in Warranty database so assets cannot be added in AMC. Sorry , correct the atmid and try again");                                 
				}				
				else{
			//============================================== here we call function sendAssets ===============================	
			sendAssets();	
			       }	
		/*if(allatmdata==0){
				//document.getElementById('area').focus() ;
				alert(allatmdata);
				return '0';
			}else if(allatmdata==1){				
				//alert("This ATM Already Exist Please Insert Another ATM Name");
			   	//document.getElementById('atm').value="" ;
			   //document.getElementById('atm').focus() ;
			   alert(allatmdata);
			        return '1';
			        
				}
				else{
				alert(allatmdata);
				return '2';
				}*/
					
		}
	  }   
    		
	atm=atm;
	//alert('getatm_detail.php?atm='+atm);			  					
	xmlhttp.open("GET",'getatm_detail.php?atm='+atm, true);					
	xmlhttp.send();	
	}	
// ==================================================================== GET ATM ID FROM ATM TABLE

	function getallatm(){
	atm=document.getElementById('atm').value;
	  //alert("hi");
	  if(atm=="")
	  {
	   alert("Please enter ATM ID");
	  }
	  else
	  {
	if (window.XMLHttpRequest)				 
	  {
		  // code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
				
		allatmdata=xmlhttp.responseText;
		//alert(allatmdata);
		
		if(allatmdata==0){
		                alert("No such ATM")
				document.getElementById('area').focus() ;
				document.getElementById('mysub').disabled=false;
			}else{				
			data=allatmdata.split("##");
				//alert("This ATM Already Exist Please Insert Another ATM Name");
			   	document.getElementById('bank').value=data[2];
			   	document.getElementById('area').value=data[3];
			   	document.getElementById('pin').value=data[4];
			   	document.getElementById('city').value=data[5];
			   	//alert(data[6]);
			   	document.getElementById('site_branch').value=(data[6]);
			   	//document.getElementById('state').value=(data[7]);
			   	document.getElementById('mysub').disabled=false;
			   	
			   //document.getElementById('atm').focus() ;
				}
					
		}
	  }   
    		
	atm=atm;
	//alert('getatm_detail.php?atm='+atm);			  					
	xmlhttp.open("GET",'getatm_detail.php?atm='+atm, true);					
	xmlhttp.send();	
	}
	}
	
	//=================================================
	function addnsite(){
		document.getElementById('atm').value="" ;
		
		}
		
//========================================Branch wise state function

function pick_state(val){
//alert(val);
brid=val;
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var s=xmlhttp.responseText;
  	//alert(s);
	 document.getElementById('mystate').innerHTML = s;	
    }
  }
   
   	//alert("get_state_br.php?brid="+brid);    
	xmlhttp.open("GET","get_state_br.php?brid="+brid,true);
	xmlhttp.send();
}
	
		
	
</script>

<script>
    
function enableamc(){
	//alert("hi");
	document.getElementById('type2').disabled=false ;
	
	}	
  
    
    function modelnos(cnt){

var sr=document.getElementById('Material'+cnt).value;

/*
var selchbox1 = [];
var inputfields1 = document.getElementsByName("Material[]");

for (var i = 0; i < inputfields1.length; i++)
{
 selchbox1.push(inputfields1[i].value);
 
}

var sr= selchbox1;
*/
//alert(sr);

$.ajax({
                    
                    type:'POST',
                    url:'materialmodel.php',
                     data:'material='+sr,
                     datatype:'json',
                    success:function(msg){
                     //alert(msg);
                       var jsr=JSON.parse(msg);
                       //alert(jsr.length);
                        var newoption=' <option value="">Select</option>' ;
                        $('#Model').empty();
                        for(var i=0;i<jsr.length;i++)
                        {
                           //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
			             }                       
                     $("#Model"+cnt).append(newoption);
 
                    }
                })
                
            }
            
            
            

</script>

</head>
<body>
<center>
<?php include("menubar.php");
include("config.php"); 

$oldpo=mysqli_query($con1,"select `po` from `atm` where 1 ");
$oldpo1=mysqli_fetch_row($oldpo);

?>
<h2 class="h2color">Add New Site</h2>

<form action="" method="post" enctype="multipart/form-data"  name="form" id="form" >
<table width="100%">
<tr>
<td width="200" height="35"><b class="addcolor">Purchase Order :</b></td>
<td width="200"><input type="text" name="po" id="po" onblur="getpo();" /></td>



	<td width="300" height="35"><b>Select Site Type</b></td>
	<td width="" colspan="2">	
	<select name="del_type" id="del_type" onchange="enableamc()" ><option value="ware_del" >Warehouse Delivery</option>
	                         <option value="site_del" >Site Delivery</option>
	                         </select>
 </td>
</tr>
<tr>
<td width="200" height="35"><b>PO Date :</b></td>
<td width="200"><input type="text" name="podt" id="podt" onclick="displayDatePicker('podt')" value="<?php echo date('d/m/Y'); ?>"/></td>



	<td width="300" height="35"><b>Select Delivery Type</b></td>
	<td width="" colspan="2">
	<input type="radio" name="type" id="type" value="sales" checked="checked" class="type" />Sales Site  	
  	<input type="radio" name="type" id="type2" value="AMC" class="type" disabled="true" />AMC Site	
	
 </td>
</tr>

<tr>
</td>
</tr>

<tr>
<td height="35"><b>Primitive Maintenance:</b></td>
<td colspan=""><select name="servicetype" id="servicetype"><option value=''>Select</option>
<option value="3" >Every 3 Month</option>
<option value="6" >Every 6 Month</option>

</select></td>

<td width="200"> <b> Select Customer Name <b> </td>
    <td>
    <?php
	$client="select cust_id,cust_name from customer where 1";
    if($_SESSION['designation']==5){
    //echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust=mysqli_query($con1,"select client from clienthandle where logid= (select srno from login where username='".$_SESSION['user']."')");
    $cc=array();
    while($custr=mysqli_fetch_array($cust))
    $cc[]=$custr[0];
    
    $ccl=implode(",",$cc);
    $ccl=str_replace(",","','",$ccl);
    $ccl="'".$ccl."'";
    $client.=" and cust_name in($ccl)";
    
    }
    $client.=" order by cust_name ASC";
    //echo $client;
    ?>
    	<select name="cust" id="cust" onchange="searchById('Listing','1','');"> <?php if($_SESSION['designation']!=5){ ?>
            <option value="0">Select Client</option><?php }
            $cl=mysqli_query($con1,$client);
            while($clro=mysqli_fetch_row($cl))
            {
            ?>
            <option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
		<?php } ?>
        </select>
 	</td>


</tr>
<tr>
<td rowspan="2">Buyers name with address</td><td rowspan="2"><textarea name="badd" id="badd" rows="4" cols="28" /></textarea></td>
<td>Buyers GST No.</td><td><input type="text" name="gst" id="gst" /></td></tr>
<tr><td>Sales Person</td><td><input type="text" name="sp" id="sp" /></td>
</tr>

<tr>

<!--<td>Bom No: </td><td><input type="text" name="bomno" id="bomno" /></td>-->
</tr>



<tr>


<!--<td>VAT: </td><td><input type="text" name="vat" id="vat" /></td>-->
</tr>

<tr>
<td width="100" height="35"><b>DO. No.:</b></td>
<td width="200"><input type="text" name="ref" id="ref" /></td>
<td width="100" height="35"><b> Date:</b></td>
<td width="200"><input type="text" name="dt" id="dt" onclick="displayDatePicker('dt')" value="<?php echo date('d/m/Y'); ?>"/></td>
<!--<td width="200"><input type="text" name="dt" id="dt" value="<?php echo date('d/m/Y'); ?>" readonly/></td>-->
<!--<td>Document no : </td><td><input type="text" name="dono" id="dono" /></td>-->
</tr>

<tr>
<td width="100" height="35"><b class="addcolor">No Of Sites To Add:</b></td>
<td width="200"><input type="text" name="nos" id="nos" / onblur="addnsite()"></td>

<td width="100" height="35"><b class="addcolor">No Of Sites  Added:</b></td>
<?php 
//$addpo=mysqli_query($con1,"select `po` from `atm` where `po`=");
//$addpo1=mysqli_num_rows($addpo);

?>
<td width="200"><input type="text"  name="addsite" id="addsite" readonly="readonly" /></td>
<!--<td>Freight Charges: </td><td><input type="text" name="freight" id="freight" /></td>-->
</tr>

<div id="allassets">
<!--====UPS==================-->
<tr>
<td colspan="4" >

<!---============table start for  assests==========================-->
<table width="100%" bordercolor="#000" border="2" id="mytable">
<tr>
<td width="50" valign="left">
<b>Component</b>
</td>
<td>

<select name="Material[]" id="Material0" onchange="modelnos('0')" style='width: 100px;'>
<option value="0">select</option>
<option value="ups">ups</option>
<option value="Battery">Battery</option>
<option value="Isolation">Isolation</option>
<option value="Stabilizer">Stabilizer</option>
<option value="AVR">AVR</option>

</td>
<td width="40">
<span class="space">Model</span>:
</td>
<td> <select name="Model" id="Model0" style="width:200px;">
     <option value="">Select Model</option>
    
   
</select>

<td width="40">
<span class="space">Number</span>:
</td>
<td>
<input type="text" name="upsno"  maxlength="4" id="upsno" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
</td>

<td width="40" id="war1">
<span class="space">Warranty:</span>
</td>
<td id="war">
<select name="upswr" id="upswr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td>
<td width="40">
<span class="space">Rate: </span>
</td>
<td>
<input type="text" name="upsrate" id="upsrate"/>
</td>

<script>
var cnt=0;
function myCreateFunction() {
cnt++;
    var table = document.getElementById("mytable");
    //var count = $('#myTable tr').length;
  
     var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    var cell8 = row.insertCell(7);
    var cell9 = row.insertCell(8);
    var cell10 = row.insertCell(9);
   
 cell1.innerHTML = "Component:";
   cell2.innerHTML =  "<select name='Material[]' id='Material"+cnt +"' onchange='modelnos("+cnt+")' style='width: 100px;'> <option value=' '>Select</option> <option value='ups'>ups</option> <option value='Battery'>Battery</option> <option value='Isolation'>Isolation</option> <option value='Stabilizer'>Stabilizer</option><option value='AVR'>AVR</option> </select>";
		
		
  cell3.innerHTML = "Model:";
   cell4.innerHTML = "<select name='Model[]' id='Model"+cnt+"' style='width:200px;'> <option value=' '>Select Model</option> </select>";
   cell5.innerHTML = "Number:";
   cell6.innerHTML ='<input type="text" name="upsno[]" id="upsno" style="width: 130px;">';
   cell7.innerHTML = "Warranty:";
   cell8.innerHTML ="<select name='upswr[]' id='upswr'> <option value='0'>select</option> <option value='12,month'>1year</option> <option value='24,month'>2year</option> <option value='36,month'>3year</option> <option value='48,month'>4year</option> <option value='60,month'>5year</option </select>";
   cell9.innerHTML = "Rate:";
   cell10.innerHTML = '<input type="text" name="upsrate[]" id="upsrate" style="width: 130px;">';
  
//$('#Material'+cnt).focus();
   
//TocheckSerialNo(cnt);

    }

function myDeleteFunction() {
var rowCount = mytable.rows.length;
var a=rowCount - 1;
if(a!=0){

    document.getElementById("mytable").deleteRow(-1);
}}

</script>
<td width="40"><input  type="button" onclick="myCreateFunction();" value="Add row"/></td>
		<td width="40"><input type="button" onclick="myDeleteFunction();" value="Delete row"></td>

<td id="bb1">
<span class="space">BuyBack:</span> 
</td>
<td id="bbr1">

<input type="text" name="upsbbrate" id="upsbbrate" />
</td>

</tr>
</table>

<table width="100%" bordercolor="#000" border="2">
<tr>
<td>
<b>Others</b>
</td>
<td colspan="5">
<textarea name="oth" id="oth" cols="50"></textarea>
</td>

<td>
<span class="space">Rate:</span> 
</td>
<td>

<input type="text" name="othrate" id="othrate" />
</td>

</tr>

<tr>
<td>
<b>Buyback Details</b>
</td>
<td colspan="4">
<textarea name="bbd" id="bbd" cols="50"></textarea>
</td>
<td>BuyBack:<select name="bback" id="bback" >
     <option value="-1" >Select</option>
     <option value="y" >Yes</option>
     <option value="n" >No</option>
     </select>
</td>
<td>
<span class="space">Total Amount</span> 
</td>
<td>

<input type="text" name="bbdrate" id="bbdrate" />
</td>

</tr>

</table>


<!-- =====================TABLE END FOR ASSESTS=======================================================-->
</td></tr>
</div>

<tr>
<td width="100" height="35"><b>Bank Name :</b></td>
<td width="200"><input type="text" name="bank" id="bank" /></td>
<td width="100" height="35"><b>ATM ID :</b></td>
<td width="200"><input type="text" name="atm" id="atm" />
                <input type="button" name="getdata" id="getdata" value="GET" onclick="getallatm();" /></td>
<!--<td>Indent No: </td><td><input type="text" name="indentno" id="indentno" /></td>-->
</tr>

<tr>

<!--<td>Bom Date: </td><td><input type="text" name="bomdate" id="bomdate" onclick="displayDatePicker('bomdate');"/></td>-->
</tr>

<tr>
<td width="100" height="35"><b>Area :</b></td>
<td width="200"><input type="text" name="area" id="area" /></td>
<td width="100" height="35"><b>Pincode:</b></td>
<td width="200" colspan="1"><input type="text" name="pin" id="pin" /></td>
<!--<td>Indent Date: </td><td><input type="text" name="indentdate" id="indentdate" onclick="displayDatePicker('indentdate');"/></td>-->
</tr>

<tr>

</tr>

<tr>
<td width="100" height="35"><b>City : </b></td>
<td width="200">
<input type="text" name="city" id="city"  />
</td>

<td width="100" height="35"><b>Branch :</b> </td>
<td width="200" colspan="">
<select name="site_branch" id="site_branch" onchange="pick_state(this.value);">
<option value="">Select Branch</option>
<?php 
$sqlbr=mysqli_query($con1,"select * from `avo_branch`");
while($sqlbr1=mysqli_fetch_row($sqlbr)){
?>
<option value="<?php echo $sqlbr1[0]; ?>"><?php echo $sqlbr1[1]."-".$sqlbr1[0]; ?></option>
<?php } ?>
</select>
</td>


</tr>

<tr>
<td width="100" height="35"><b>Address :</b> </td>
<td width="200" colspan="">
<textarea name="address" id="address" rows="4" cols="28" /></textarea>
</td>

<td width="100" height="35"><b>State : </b></td>
<td width="200">
<div id="mystate">
<!--<input type="text" name="state" id="state" onblur="filladd(this);" />-->
<select name="state" id="state" onchange="filladd(this);">
<option value="">Select State</option>
<?php
$state=mysqli_query($con1,"select * from state order by state ASC");
while($stro=mysqli_fetch_array($state))
{
?>
<option value="<?php echo $stro[1]; ?>"><?php echo $stro[1]; ?></option>
<?php
}
?>
</select>
</div>
</td>


</tr>
<tr>
<td width="100" height="35"><b>Contact Person :</b> </td>
<td width="200" colspan="">
<input type="text" name="contact" id="contact" />
</td>

<td width="100" height="35"><b>Contact No.: </b></td>
<td width="200">
<input type="text" name="contactno" id="contactno" /></td>
</tr>

<tr>
<td width="100" height="35"><b>Email: </b></td>
<td width="200">

<input type="text" name="neweml" id="neweml" /></td>


</td>
</tr>

<tr>

<td colspan="4" align="center" height="50"><div id="search"><button type="button" name="mysub" id="mysub" disabled="true" onclick="validate(this.form); " class="readbutton" value=""> Submit </button></div> </td>
</tr>
</table>


</form>
</center>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Events Invoice Form</title>
<script type="text/javascript">
function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Your Browser Sucks!\nIt's about time to upgrade don't you think?");
	}
}

var searchReq = getXmlHttpRequestObject();

function MakeRequest() {
//alert("requesting");
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var str = escape(document.getElementById('id').value);
		searchReq.open("GET", 'searchname.php?id=' + str, true);
		searchReq.onreadystatechange = handleMakeRequest; 
		searchReq.send(null);
	}		
}

function handleMakeRequest() {	
//alert("handling");
				
		var str = searchReq.responseText;
		//alert(str);
       document.getElementById('refname').value = str;
			
}



</script>
<script language="JavaScript"> 
 
 
var datePickerDivID = "datepicker";
var iFrameDivID = "datepickeriframe";
 
var dayArrayShort = new Array('Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa');
var dayArrayMed = new Array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
var dayArrayLong = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
var monthArrayShort = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
var monthArrayMed = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');
var monthArrayLong = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October', 'November', 'December');
 
 function myalert()
 {
 alert("hello");
 }

var defaultDateSeparator = "/";       
var defaultDateFormat = "ymd"   ; 
var dateSeparator = defaultDateSeparator;
var dateFormat = defaultDateFormat;
 
function displayDatePicker(dateFieldName, displayBelowThisObject, dtFormat, dtSep)
{
//alert("hello");
  var targetDateField = document.getElementsByName(dateFieldName).item(0);
 
 
  if (!displayBelowThisObject)
    displayBelowThisObject = targetDateField;
 
 
  if (dtSep)
    dateSeparator = dtSep;
  else
    dateSeparator = defaultDateSeparator;
 
  if (dtFormat)
    dateFormat = dtFormat;
  else
    dateFormat = defaultDateFormat;
 
  var x = displayBelowThisObject.offsetLeft;
  var y = displayBelowThisObject.offsetTop + displayBelowThisObject.offsetHeight ;
 
  var parent = displayBelowThisObject;
  while (parent.offsetParent) {
    parent = parent.offsetParent;
    x += parent.offsetLeft;
    y += parent.offsetTop ;
  }
 //alert("hello1");
  drawDatePicker(targetDateField, x, y);
}
 
 
function drawDatePicker(targetDateField, x, y)
{
  var dt = getFieldDate(targetDateField.value );
//alert("wow");
 
  if (!document.getElementById(datePickerDivID)) {
 
    var newNode = document.createElement("div");
    newNode.setAttribute("id", datePickerDivID);
    newNode.setAttribute("class", "dpDiv");
    newNode.setAttribute("style", "visibility: hidden;");
    document.body.appendChild(newNode);
  }
 
  var pickerDiv = document.getElementById(datePickerDivID);
  pickerDiv.style.position = "absolute";
  pickerDiv.style.left = x + "px";
  pickerDiv.style.top = y + "px";
  pickerDiv.style.visibility = (pickerDiv.style.visibility == "visible" ? "hidden" : "visible");
  pickerDiv.style.display = (pickerDiv.style.display == "block" ? "none" : "block");
  pickerDiv.style.zIndex = 10000;
 
  // draw the datepicker table
  refreshDatePicker(targetDateField.name, dt.getFullYear(), dt.getMonth(), dt.getDate()); 
}
 
 
function refreshDatePicker(dateFieldName, year, month, day)
{
 //alert("fh");
  var thisDay = new Date();
 
  if ((month >= 0) && (year > 0)) {
    thisDay = new Date(year, month, 1);
  } else {
    day = thisDay.getDate();
    thisDay.setDate(1);
  }
 
 
  var crlf = "\r\n";
  var TABLE = "<table cols=7 class='dpTable'>" + crlf;
  var xTABLE = "</table>" + crlf;
  var TR = "<tr class='dpTR'>";
  var TR_title = "<tr class='dpTitleTR'>";
  var TR_days = "<tr class='dpDayTR'>";
  var TR_todaybutton = "<tr class='dpTodayButtonTR'>";
  var xTR = "</tr>" + crlf;
  var TD = "<td class='dpTD' onMouseOut='this.className=\"dpTD\";' onMouseOver=' this.className=\"dpTDHover\";' ";   
  var TD_title = "<td colspan=5 class='dpTitleTD'>";
  var TD_buttons = "<td class='dpButtonTD'>";
  var TD_todaybutton = "<td colspan=7 class='dpTodayButtonTD'>";
  var TD_days = "<td class='dpDayTD'>";
  var TD_selected = "<td class='dpDayHighlightTD' onMouseOut='this.className=\"dpDayHighlightTD\";' onMouseOver='this.className=\"dpTDHover\";' ";   
  var xTD = "</td>" + crlf;
  var DIV_title = "<div class='dpTitleText'>";
  var DIV_selected = "<div class='dpDayHighlight'>";
  var xDIV = "</div>";
 
  // start generating the code for the calendar table
  var html = TABLE;
 
  // this is the title bar, which displays the month and the buttons to
  // go back to a previous month or forward to the next month
  html += TR_title;
  html += TD_buttons + getButtonCode(dateFieldName, thisDay, -1, "&lt;") + xTD;
  html += TD_title + DIV_title + monthArrayLong[ thisDay.getMonth()] + " " + thisDay.getFullYear() + xDIV + xTD;
  html += TD_buttons + getButtonCode(dateFieldName, thisDay, 1, "&gt;") + xTD;
  html += xTR;
 
  // this is the row that indicates which day of the week we're on
  html += TR_days;
  for(i = 0; i < dayArrayShort.length; i++)
    html += TD_days + dayArrayShort[i] + xTD;
  html += xTR;
 
  // now we'll start populating the table with days of the month
  html += TR;
 
  // first, the leading blanks
  for (i = 0; i < thisDay.getDay(); i++)
    html += TD + "&nbsp;" + xTD;
 // alert("before update");
  // now, the days of the month
  do {
    dayNum = thisDay.getDate();
    TD_onclick = " onclick=\"updateDateField('" + dateFieldName + "', '" + getDateString(thisDay) + "');\">";
    
    if (dayNum == day)
      html += TD_selected + TD_onclick + DIV_selected + dayNum + xDIV + xTD;
    else
      html += TD + TD_onclick + dayNum + xTD;
    
    // if this is a Saturday, start a new row
    if (thisDay.getDay() == 6)
      html += xTR + TR;
    
    // increment the day
    thisDay.setDate(thisDay.getDate() + 1);
  } while (thisDay.getDate() > 1)
 
  // fill in any trailing blanks
  if (thisDay.getDay() > 0) {
    for (i = 6; i > thisDay.getDay(); i--)
      html += TD + "&nbsp;" + xTD;
  }
  html += xTR;
 
  var today = new Date();
  var todayString = "Today is " + dayArrayMed[today.getDay()] + ", " + monthArrayMed[ today.getMonth()] + " " + today.getDate();
  html += TR_todaybutton + TD_todaybutton;
  html += "<button class='dpTodayButton' onClick='refreshDatePicker(\"" + dateFieldName + "\");'>this month</button> ";
  html += "<button class='dpTodayButton' onClick='updateDateField(\"" + dateFieldName + "\");'>close</button>";
  html += xTD + xTR;
 
  // and finally, close the table
  html += xTABLE;
 
  document.getElementById(datePickerDivID).innerHTML = html;
 
 // adjustiFrame();
}
 
 
function getButtonCode(dateFieldName, dateVal, adjust, label)
{
 //alert("in getbuttoncode");
  var newMonth = (dateVal.getMonth () + adjust) % 12;
  var newYear = dateVal.getFullYear() + parseInt((dateVal.getMonth() + adjust) / 12);
  if (newMonth < 0) {
    newMonth += 12;
    newYear += -1;
  }
 
  return "<button class='dpButton' onClick='refreshDatePicker(\"" + dateFieldName + "\", " + newYear + ", " + newMonth + ");'>" + label + "</button>";
}
 
 
function getDateString(dateVal)
{
 //alert("in getdatestring");
  var dayString = "00" + dateVal.getDate();
  var monthString = "00" + (dateVal.getMonth()+1);
  dayString = dayString.substring(dayString.length - 2);
  monthString = monthString.substring(monthString.length - 2);
 
  switch (dateFormat) {
    case "dmy" :
      return dayString + dateSeparator + monthString + dateSeparator + dateVal.getFullYear();
    case "ymd" :
      return dateVal.getFullYear() + dateSeparator + monthString + dateSeparator + dayString;
    case "mdy" :
    default :
      return monthString + dateSeparator + dayString + dateSeparator + dateVal.getFullYear();
  }
}
 
 
function getFieldDate(dateString)
{
  var dateVal;
  var dArray;
  var d, m, y;
 //alert("in getFielddate");
  try {
    dArray = splitDateString(dateString);
    if (dArray) {
      switch (dateFormat) {
        case "dmy" :
          d = parseInt(dArray[0], 10);
          m = parseInt(dArray[1], 10) - 1;
          y = parseInt(dArray[2], 10);
          break;
        case "ymd" :
          d = parseInt(dArray[2], 10);
          m = parseInt(dArray[1], 10) - 1;
          y = parseInt(dArray[0], 10);
          break;
        case "mdy" :
        default :
          d = parseInt(dArray[1], 10);
          m = parseInt(dArray[0], 10) - 1;
          y = parseInt(dArray[2], 10);
          break;
      }
      dateVal = new Date(y, m, d);
    } else if (dateString) {
      dateVal = new Date(dateString);
    } else {
      dateVal = new Date();
    }
  } catch(e) {
    dateVal = new Date();
  }
 
  return dateVal;
}
 
 

function splitDateString(dateString)
{
 //alert("in splitdate");
  var dArray;
  if (dateString.indexOf("/") >= 0)
    dArray = dateString.split("/");
  else if (dateString.indexOf(".") >= 0)
    dArray = dateString.split(".");
  else if (dateString.indexOf("-") >= 0)
    dArray = dateString.split("-");
  else if (dateString.indexOf("\\") >= 0)
    dArray = dateString.split("\\");
  else
    dArray = false;
 
  return dArray;
}
 
function updateDateField(dateFieldName, dateString)
{
 //alert("in updateFielddate");
  var targetDateField = document.getElementsByName 

(dateFieldName).item(0);
  if (dateString)
    targetDateField.value = dateString;
 
  var pickerDiv = document.getElementById(datePickerDivID);
  pickerDiv.style.visibility = "hidden";
  pickerDiv.style.display = "none";
 
  adjustiFrame();
  targetDateField.focus();
 
  // after the datepicker has closed, optionally run a user-defined 

//function called
  // datePickerClosed, passing the field that was just updated as a 

//parameter
  // (note that this will only run if the user actually selected a date 

//from the datepicker)
  if ((dateString) && (typeof(datePickerClosed) == "function"))
    datePickerClosed(targetDateField);
}
 
 
function adjustiFrame(pickerDiv, iFrameDiv)
{/*
  // we know that Opera doesn't like something about this, so if we
  // think we're using Opera, don't even try
  var is_opera = (navigator.userAgent.toLowerCase().indexOf("opera") != -1);
  if (is_opera)
    return;
  
  // put a try/catch block around the whole thing, just in case
  try {
    if (!document.getElementById(iFrameDivID)) {
      // don't use innerHTML to update the body, because it can cause global variables
  
    document.body.innerHTML += "<iframe id='" + iFrameDivID + "' src='javascript:false;' scrolling='no' frameborder='0'>";
      var newNode = document.createElement("iFrame");
      newNode.setAttribute("id", iFrameDivID);
      newNode.setAttribute("src", "javascript:false;");
      newNode.setAttribute("scrolling", "no");
      newNode.setAttribute ("frameborder", "0");
      document.body.appendChild(newNode);
    }
    
    if (!pickerDiv)
      pickerDiv = document.getElementById(datePickerDivID);
    if (!iFrameDiv)
      iFrameDiv = document.getElementById(iFrameDivID);
    
    try {
      iFrameDiv.style.position = "absolute";
      iFrameDiv.style.width = pickerDiv.offsetWidth;
      iFrameDiv.style.height = pickerDiv.offsetHeight ;
      iFrameDiv.style.top = pickerDiv.style.top;
      iFrameDiv.style.left = pickerDiv.style.left;
      iFrameDiv.style.zIndex = pickerDiv.style.zIndex - 1;
      iFrameDiv.style.visibility = pickerDiv.style.visibility ;
      iFrameDiv.style.display = pickerDiv.style.display;
    } catch(e) {
    }
 
  } catch (ee) {
  }
*/ 
}
 
 
</script> 
 
<style> 
body {
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: .8em;
	}
 
/* the div that holds the date picker calendar */
.dpDiv {
	}
 
 
/* the table (within the div) that holds the date picker calendar */
.dpTable {
	font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 12px;
	text-align: center;
	color: #505050;
	background-color: #ece9d8;
	border: 1px solid #AAAAAA;
	}
 
 
/* a table row that holds date numbers (either blank or 1-31) */
.dpTR {
	}
 
 
/* the top table row that holds the month, year, and forward/backward 

buttons */
.dpTitleTR {
	}
 
 
/* the second table row, that holds the names of days of the week (Mo, 

Tu, We, etc.) */
.dpDayTR {
	}
 
 
/* the bottom table row, that has the "This Month" and "Close" buttons 

*/
.dpTodayButtonTR {
	}
 
 
/* a table cell that holds a date number (either blank or 1-31) */
.dpTD {
	border: 1px solid #ece9d8;
	}
 
 
/* a table cell that holds a highlighted day (usually either today's 

date or the current date field value) */
.dpDayHighlightTD {
	background-color: #CCCCCC;
	border: 1px solid #AAAAAA;
	}
 
 
/* the date number table cell that the mouse pointer is currently over 

(you can use contrasting colors to make it apparent which cell is being 

hovered over) */
.dpTDHover {
	background-color: #aca998;
	border: 1px solid #888888;
	cursor: pointer;
	color: red;
	}
 
 
/* the table cell that holds the name of the month and the year */
.dpTitleTD {
	}
 
 
/* a table cell that holds one of the forward/backward buttons */
.dpButtonTD {
	}
 
 
/* the table cell that holds the "This Month" or "Close" button at the 

bottom */
.dpTodayButtonTD {
	}
 
 
/* a table cell that holds the names of days of the week (Mo, Tu, We, 

etc.) */
.dpDayTD {
	background-color: #CCCCCC;
	border: 1px solid #AAAAAA;
	color: white;
	}
 
 
/* additional style information for the text that indicates the month 

and year */
.dpTitleText {
	font-size: 12px;
	color: gray;
	font-weight: bold;
	}
 
 
/* additional style information for the cell that holds a highlighted 

day (usually either today's date or the current date field value) */ 
.dpDayHighlight {
	color: 4060ff;
	font-weight: bold;
	}
 
 
/* the forward/backward buttons at the top */
.dpButton {
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: gray;
	background: #d8e8ff;
	font-weight: bold;
	padding: 0px;
	}
 
 
/* the "This Month" and "Close" buttons at the bottom */
.dpTodayButton {
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: gray;
	background: #d8e8ff;
	font-weight: bold;
	}
 
</style> 
</head>

<body>
<form id="form" name="form" method="post" action="index.php" > 
  
  <table width="800" border="1"  align="center" style="border:none">
  <tr></tr>
  
 <tr>
   <td> 
  <font size="+1" color="#FF0000"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Events Invoice  Form</b></font></td>
 </tr>
 
  <tr>
    <td  align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COMPANY NAME : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <label for="textfield59"></label>
      <input type="text" name="compname" id="compname" size="35"/>  <br />    
      &nbsp;ADDRESS :  
      <input type="text" name="address" id="address" size="65"/>      
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:
      <label for="textfield2"></label>
      <script  language="JavaScript"  type="text/javascript">
/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()+1
if (month<10)
month="0"+month
var daym=mydate.getDate()
if (daym<10)
daym="0"+daym
document.write("<medium><font color='#FF0000' face='Arial'><b>"+daym+"- "+month+"- "+year+"</b></font></medium>")
        </script> 
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
   <td> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    CONTACT PERSON : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="contact" id="contact" size="40" />&nbsp;&nbsp;&nbsp;&nbsp;  
                                     PHONE :  &nbsp;&nbsp; <input type="text" name="phone" id="phone"  /></td> </tr>
  <tr>
    <td height="208"><table width="817" height="418" border="1" style="border:none">
      <tr>
        <td width="46">Sr No.</td>
        <td width="175">Item Name</td>
        <td width="166">Item Description</td>
        <td width="155">Quantity</td>
        <td width="64">Price</td>        
      </tr>
      <tr>
        <td>1</td>
        <td><label for="textfield3"></label>
          <input type="text" name="name[]" id="name[]" /></td>
        <td><label for="textfield4"></label>
          <input type="text" name="middlename[]" id="middlename[]" /></td>        
        <td><label for="textfield6"></label>
          <input type="text" name="age[]" id="age[]" /></td>
          <td><label for="textfield3"></label>
            <input type="text" name="icardname[]" id="icardname[]" /></td>
      </tr>
      <tr>
        <td>2</td>
        <td><label for="textfield7"></label>
          <input type="text" name="name[]" id="name[]" /></td>
        <td><label for="textfield8"></label>
          <input type="text" name="middlename[]" id="middlename[]" /></td>
        <td><label for="textfield10"></label>
          <input type="text" name="age[]" id="age[]"/></td>
          <td><label for="textfield4"></label>
            <input type="text" name="icardname[]" id="icardname[]" /></td>
      </tr>
      <tr>
        <td>3</td>
        <td><label for="textfield11"></label>
          <input type="text" name="name[]" id="name[]" /></td>
        <td><label for="textfield13"></label>
          <input type="text" name="middlename[]" id="middlename[]" /></td>
        <td><label for="textfield17"></label>
          <input type="text" name="age[]" id="age[]"/></td>
          <td><label for="textfield5"></label>
            <input type="text" name="icardname3" id="icardname3" /></td>
      </tr>
      <tr>
        <td height="26">4</td>
        <td><label for="textfield"></label>
          <input type="text" name="name[]" id="name[]" /></td>
        <td><label for="textfield19"></label>
          <input type="text" name="middlename[]" id="middlename[]" /></td>
        <td><label for="textfield21"></label>
          <input type="text" name="age[]" id="age[]"/></td>
        <td><label for="textfield22"></label>
          <input type="text" name="icardname[]" id="icardname[]" /></td>
      </tr>
      <tr>
        <td height="26">5</td>
        <td><label for="textfield23"></label>
          <input type="text" name="name[]" id="name[]" /></td>
        <td><label for="textfield27"></label>
          <input type="text" name="middlename[]" id="middlename[]" /></td>
        <td><label for="textfield44"></label>
          <input type="text" name="age[]" id="age[]"/></td>
        <td><label for="textfield51"></label>
          <input type="text" name="icardname[]" id="icardname[]" /></td>
      </tr>
      <tr>
        <td height="26">6</td>
        <td><label for="textfield24"></label>
          <input type="text" name="name[]" id="name[]" /></td>
        <td><label for="textfield28"></label>
          <input type="text" name="middlename[]" id="middlename[]" /></td>
        <td><label for="textfield45"></label>
          <input type="text" name="age[]" id="age[]"/></td>
        <td><label for="textfield52"></label>
          <input type="text" name="icardname[]" id="icardname[]" /></td>
      </tr>
      <tr>
        <td height="26">7</td>
        <td><label for="textfield25"></label>
          <input type="text" name="name[]" id="name[]" /></td>
        <td><label for="textfield29"></label>
          <input type="text" name="middlename[]" id="middlename[]" /></td>
        <td><label for="textfield46"></label>
          <input type="text" name="age[]" id="age[]"/></td>
        <td><label for="textfield53"></label>
          <input type="text" name="icardname[]" id="icardname[]" /></td>
      </tr>
      <tr>
        <td height="30">8</td>
        <td><label for="textfield26"></label>
          <input type="text" name="name[]" id="name[]" /></td>
        <td><label for="textfield30"></label>
          <input type="text" name="middlename[]" id="middlename[]" /></td>
        <td><label for="textfield47"></label>
          <input type="text" name="age[]" id="age[]" /></td>
        <td><label for="textfield54"></label>
          <input type="text" name="icardname[]" id="icardname[]" /></td>
      </tr>
      <tr>
        <td height="26">9</td>
        <td><label for="textfield31"></label>
          <input type="text" name="name[]" id="name[]" /></td>
        <td><label for="textfield34"></label>
          <input type="text" name="middlename[]" id="middlename[]" /></td>
        <td><label for="textfield48"></label>
          <input type="text" name="age[]" id="age[]" /></td>
        <td><label for="textfield55"></label>
          <input type="text" name="icardname[]" id="icardname[]" /></td>
      </tr><tr>
        <td height="26">10</td>
        <td><label for="textfield32"></label>
          <input type="text" name="name[]" id="name[]" /></td>
        <td><label for="textfield35"></label>
          <input type="text" name="middlename[]" id="middlename[]" /></td>
        <td><label for="textfield49"></label>
          <input type="text" name="age[]" id="age[]"/></td>
        <td><label for="textfield56"></label>
          <input type="text" name="icardname[]" id="icardname[]" /></td>
      </tr>
      <tr>
        <td height="28" colspan="8" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="submit" name="Submit" id="Submit" value="Submit" /></td>
      </tr>
    </table></td>
  </tr>
  </table>
</form>
</body>
</html>

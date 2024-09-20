<script type="module" src="datepick_js.js"></script>
<link rel="stylesheet" type="text/css" href="date_css.css" />
<script>
var isCtrl = false;
document.addEventListener('keyup', function(e) {
    if (e.which == 17) isCtrl = false;
});
document.addEventListener('keydown', function(e) {
    if (e.which == 17) isCtrl = true;
    if (e.which == 66 && isCtrl == true) {
        document.getElementById("barcode").focus();
        return false;
    }
});

function showdetails() {
    var from_date = document.getElementById('from_date').value;
    var to_date = document.getElementById('to_date').value;
    var barcode = document.getElementById('barcode').value;
    
    var date = 0;
    if (from_date == "") {
        date = date + 1;
    }
    if (to_date == "") {
        date = date + 1;
    }
    if (date == 2 || date == 0) {
        var bar = document.getElementById('barcode').value;
        var bar2 = document.getElementById('barcode2').value;
        var xmlhttp;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                // document.getElementById('barcode').value = '';
                document.getElementById('barcode2').value = '';
                document.getElementById("back").innerHTML = xmlhttp.responseText;
            }
        }
            var barcode = document.getElementById('barcode').value;

        xmlhttp.open("GET", 'getbookdetail_new.php?barcode=' + bar + '&barcode2=' + bar2 + '&fromdate=' + from_date + '&todate=' + to_date, true);
        xmlhttp.send();
    } else {
        alert("Both From pick date and to pick date required");
    }
}
</script>

<body>

<div style="text-align: center;">
    <a href="/pos/home_dashboard.php">Back</a>
    <table width="1320" height="300" border="1" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF" align="center">
        <tr>
            <td align="center"> 
                <!-- PHP code here -->
                <b>Booking Status</b>
            </td>
        </tr>
        <tr>
            <td width="1308" valign="top">
                <center>
                    <table width="100%" align='center'>
                        <tr align="center">
                            <td width="493">
                                <strong>Select From Pick Date :</strong>
                                <input type="date" name="from_date" id="from_date" />
                                <strong>Select To Pick Date :</strong>
                                <input type="date" name="to_date" id="to_date" />
                                <strong>Item code: </strong>
                                <input type="text" name="barcode" id="barcode" onFocus="this.value=''" onClick="this.value=''" onChange="showdetails();" />
                                &nbsp;&nbsp;&nbsp;&nbsp; Barcode :
                                <input type="text" name="barcode2" id="barcode2" onFocus="this.value=''" onClick="this.value=''" onChange="showdetails();" />
                                <button type="button" onClick="showdetails();">Show Details</button>
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <div id="back"></div>
                    <br/>
                </center>
            </td>
        </tr>
    </table>
</div>
<div align="center">You are using Point Of Sale Version 10.5 .</div>
</body>

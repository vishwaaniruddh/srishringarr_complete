<?php

$message='<table id="mytbl" border="1">
                <tr>
                    <td>
                        <b>ID</b></td>
                    <td>
                        <b>Name</b></td>
                    <td>
                        <b>Profit/Loss</b></td>
                </tr>
                <tr>
                    <td>
                        1</td>
                    <td style="color:#93C">
                        Tarun</td>
                    <td>
                        200%</td>
                </tr>
                <tr>
                    <td>
                        2</td>
                    <td>
                        Ajay</td>
                    <td>
                        -200%</td>
                </tr>
            </table>
		  ';

echo $message;
		  
		  $to = 'zarnu7kisna@gmail.com';
		  
		  $subject = 'APPOINMENTS';
		  
		  $header=("Content-Type: application/vnd.ms-excel");
$header.=("Content-Disposition: filename=demo.xls");
		  
		  if (mail($to, $subject, $message, $header)) {
              echo 'Your message has been Mailed.';
            } else {
              echo 'There was a problem sending the email.';
            }
?>
<body onLoad="javascript:ExportToExcel('mytbl')">
</body>
 
 <script type="text/javascript">
function ExportToExcel(mytblId)
    {
       
        var htmltable= document.getElementById(mytblId);
        var html = htmltable.outerHTML;

// MS OFFICE 2003  : data:application/vnd.ms-excel
// MS OFFICE 2007  : application/vnd.openxmlformats-officedocument.spreadsheetml.sheet

        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    }
</script>
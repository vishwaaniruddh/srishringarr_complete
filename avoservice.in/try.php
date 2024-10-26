<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   


    <script>
        function custName() {
        $from='2018-06-20';
        $to='2018-06-23';
            $.ajax({
                type: 'POST',
                url: 'getReqID.php',
                data: 'page=custname'+'&$from='+$from+'&$to='+$to,
                success: function (data) {
                    alert(data);
                    
                    $('#a').append(data);
                    
                    
                   /* var jsr = JSON.parse(data);
                    var tr;
                  
                    for (var i = 0; i < jsr.length; i++) {
                        tr = $('<tr/>');
                        tr.append("<td>" + jsr[i]['date'] + "</td>");
                        tr.append("<td>" + jsr[i]["attendance"] + "</td>");
                       
                        $('table').append(tr);
                    }
*/

                }
            });
        }
  
 
  </script>
</head>
<body onload="custName();">
    <form id="form1" runat="server">
  
    <div id="a"></div>

  
   
    </form>
</body>
</html>
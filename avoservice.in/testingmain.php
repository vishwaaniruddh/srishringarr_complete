<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   


    <script>
        function custName() {
            $.ajax({
                type: 'POST',
                url: 'testing.php',
                //data: 'page=custname',
                success: function (data) {
                   // alert(data)
                    var jsr = JSON.parse(data);
                    var tr;
                  
                    for (var i = 0; i < jsr.length; i++) {
                        tr = $('<tr/>');
                        tr.append("<td>" + jsr[i]['id'] + "</td>");
                       // tr.append("<td>" + jsr[i]["customerName"] + "</td>");
                       
                        $('table').append(tr);
                    }


                }
            });
        }
  
 
  </script>
</head>
<body>
    <form id="form1">
    <div>
    
<table>
 <tbody id="tbody">
 </tbody>
</table>

    </div>
    </form>
<input type="button" value="submit" onclick="custName()">
</body>
</html>

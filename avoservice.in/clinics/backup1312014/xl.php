
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


            
            <a id="clickToExcel" href="m.php">Export To Excel</a> 
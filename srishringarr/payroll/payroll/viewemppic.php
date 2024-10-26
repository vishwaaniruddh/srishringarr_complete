<?php

    include("settings.php");

    // Including Database file for db connection
    include("$absolutepath/$dbfile");

    $query = "select picid,linkid,picture,filename,filesize,filetype from emppicture where linkid='$empid' and type='e'";
    $result = @MYSQL_QUERY($query);

    $data1 = @MYSQL_RESULT($result,0,"picture");
    $type1 = @MYSQL_RESULT($result,0,"filetype");

    Header( "Content-type: $type1");
    echo $data1;
?>

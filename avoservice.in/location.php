<html>
    <head>
        
    </head>
    <body>
        
        <?
        if(isset($_POST['submit'])){
            $location=$_POST['location'];
            

            echo $location;
        }
            unset($_POST['submit']);        
        ?>
        <form action="<? $_SERVER['PHP_SELF']?>" method="POST">
            <input type="text" name="location">
            <input type="submit" name="submit" value="submit">
        </form>
    </body>
</html>
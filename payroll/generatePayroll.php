<?php
include("config.php");
global $db;
$my = $_GET['month'];
if ($my == null) $my = "NOVEMBER 2020";
// echo date('Y-m-d',(strtotime ( '-1 day' , strtotime ( '2015-05-01') ) ));
// echo date('Y-m-d',(strtotime ( '+1 day' , strtotime ( '2015-05-01') ) ));
echo "<br><br><center><h3><u>MONTHLY SALARY REPORT FOR " . $my . "</u></H3></center>";
?>
<br><br>
<center>
    <form action="#" method="GET">
        <select name="month">
            
            <option value="NOVEMBER 2020" <?php if ($my == 'NOVEMBER 2020') echo "selected"; ?>>NOVEMBER 2020</option>
            <option value="OCTOBER 2020" <?php if ($my == 'OCTOBER 2020') echo "selected"; ?>>OCTOBER 2020</option>
            <option value="SEPTEMBER 2020" <?php if ($my == 'SEPTEMBER 2020') echo "selected"; ?>>SEPTEMBER 2020</option>
            <option value="AUGUST 2020" <?php if ($my == 'AUGUST 2020') echo "selected"; ?>>AUGUST 2020</option>
            <option value="MARCH 2020" <?php if ($my == 'MARCH 2020') echo "selected"; ?>>MARCH 2020</option>
            <option value="FEBRUARY 2020" <?php if ($my == 'FEBRUARY 2020') echo "selected"; ?>>FEBRUARY 2020</option>
            <option value="JANUARY 2020" <?php if ($my == 'JANUARY 2020') echo "selected"; ?>>JANUARY 2020</option>
            <option value="DECEMBER 2019" <?php if ($my == 'DECEMBER 2019') echo "selected"; ?>>DECEMBER 2019</option>
            <option value="NOVEMBER 2019" <?php if ($my == 'NOVEMBER 2019') echo "selected"; ?>>NOVEMBER 2019</option>
            <option value="OCTOBER 2019" <?php if ($my == 'OCTOBER 2019') echo "selected"; ?>>OCTOBER 2019</option>
            <option value="SEPTEMBER 2019" <?php if ($my == 'SEPTEMBER 2019') echo "selected"; ?>>SEPTEMBER 2019</option>
            <option value="AUGUST 2019" <?php if ($my == 'AUGUST 2019') echo "selected"; ?>>AUGUST 2019</option>
            <option value="july 2019" <?php if ($my == 'july 2019') echo "selected"; ?>>july 2019</option>
            <option value="june 2019" <?php if ($my == 'june 2019') echo "selected"; ?>>june 2019</option>
            <option value="MAY 2019" <?php if ($my == 'may 2019') echo "selected"; ?>>may 2019</option>
            <option value="APRIL 2019" <?php if ($my == 'APRIL 2019') echo "selected"; ?>>APRIL 2019</option>
            <option value="MARCH 2019" <?php if ($my == 'MARCH 2019') echo "selected"; ?>>MARCH 2019</option>
            <option value="FEBRUARY 2019" <?php if ($my == 'FEBRUARY 2019') echo "selected"; ?>>FEBRUARY 2019</option>
            <option value="JANUARY 2019" <?php if ($my == 'JANUARY 2019') echo "selected"; ?>>JANUARY 2019</option>
            <option value="DECEMBER 2018" <?php if ($my == 'DECEMBER 2018') echo "selected"; ?>>DECEMBER 2018</option>
            <option value="NOVEMBER 2018" <?php if ($my == 'NOVEMBER 2018') echo "selected"; ?>>NOVEMBER 2018</option>
            <option value="OCTOBER 2018" <?php if ($my == 'OCTOBER 2018') echo "selected"; ?>>OCTOBER 2018</option>
            <option value="SEPTEMBER 2018" <?php if ($my == 'SEPTEMBER 2018') echo "selected"; ?>>SEPTEMBER 2018</option>
            <option value="AUGUST 2018" <?php if ($my == 'AUGUST 2018') echo "selected"; ?>>AUGUST 2018</option>
            <option value="july 2018" <?php if ($my == 'july 2018') echo "selected"; ?>>july 2018</option>
            <option value="june 2018" <?php if ($my == 'june 2018') echo "selected"; ?>>june 2018</option>
            <option value="may 2018" <?php if ($my == 'may 2018') echo "selected"; ?>>may 2018</option>
            <option value="APRIL 2018" <?php if ($my == 'APRIL 2018') echo "selected"; ?>>APRIL 2018</option>
            <option value="MARCH 2018" <?php if ($my == 'MARCH 2018') echo "selected"; ?>>MARCH 2018</option>
            <option value="FEBRUARY 2018" <?php if ($my == 'FEBRUARY 2018') echo "selected"; ?>>FEBRUARY 2018</option>
            <option value="JANUARY 2018" <?php if ($my == 'JANUARY 2018') echo "selected"; ?>>JANUARY 2018</option>
            <option value="DECEMBER 2017" <?php if ($my == 'DECEMBER 2017') echo "selected"; ?>>DECEMBER 2017</option>
            <option value="NOVEMBER 2017" <?php if ($my == 'NOVEMBER 2017') echo "selected"; ?>>NOVEMBER 2017</option>
            <option value="OCTOBER 2017" <?php if ($my == 'OCTOBER 2017') echo "selected"; ?>>OCTOBER 2017</option>
            <option value="SEPTEMBER 2017" <?php if ($my == 'SEPTEMBER 2017') echo "selected"; ?>>SEPTEMBER 2017</option>
            <option value="AUGUST 2017" <?php if ($my == 'AUGUST 2017') echo "selected"; ?>>AUGUST 2017</option>
            <option value="JULY 2017" <?php if ($my == 'JULY 2017') echo "selected"; ?>>JULY 2017</option>
            <option value="JUNE 2017" <?php if ($my == 'JUNE 2017') echo "selected"; ?>>JUNE 2017</option>
            <option value="MAY 2017" <?php if ($my == 'MAY 2017') echo "selected"; ?>>MAY 2017</option>
            <option value="APRIL 2017" <?php if ($my == 'APRIL 2017') echo "selected"; ?>>APRIL 2017</option>
            <option value="MARCH 2017" <?php if ($my == 'MARCH 2017') echo "selected"; ?>>MARCH 2017</option>
            <option value="FEBRUARY 2017" <?php if ($my == 'FEBRUARY 2017') echo "selected"; ?>>FEBRUARY 2017</option>
            <option value="JANUARY 2017" <?php if ($my == 'JANUARY 2017') echo "selected"; ?>>JANUARY 2017</option>
            <option value="DECEMBER 2016" <?php if ($my == 'DECEMBER 2016') echo "selected"; ?>>DECEMBER 2016</option>
            <option value="NOVEMBER 2016" <?php if ($my == 'NOVEMBER 2016') echo "selected"; ?>>NOVEMBER 2016</option>
            <option value="OCTOBER 2016" <?php if ($my == 'OCTOBER 2016') echo "selected"; ?>>OCTOBER 2016</option>
            <option value="SEPTEMBER 2016" <?php if ($my == 'SEPTEMBER 2016') echo "selected"; ?>>SEPTEMBER 2016</option>
            <option value="AUGUST 2016" <?php if ($my == 'AUGUST 2016') echo "selected"; ?>>AUGUST 2016</option>
            <option value="JULY 2016" <?php if ($my == 'JULY 2016') echo "selected"; ?>>JULY 2016</option>
            <option value="JUNE 2016" <?php if ($my == 'JUNE 2016') echo "selected"; ?>>JUNE 2016</option>
            <option value="MAY 2016" <?php if ($my == 'MAY 2016') echo "selected"; ?>>MAY 2016</option>
            <option value="APRIL 2016" <?php if ($my == 'APRIL 2016') echo "selected"; ?>>APRIL 2016</option>
            <option value="MARCH 2016" <?php if ($my == 'MARCH 2016') echo "selected"; ?>>MARCH 2016</option>
            <option value="FEBRUARY 2016" <?php if ($my == 'FEBRUARY 2016') echo "selected"; ?>>FEBRUARY 2016</option>
            <option value="JANUARY 2016" <?php if ($my == 'JANUARY 2016') echo "selected"; ?>>JANUARY 2016</option>
            <option value="DECEMBER 2015" <?php if ($my == 'DECEMBER 2015') echo "selected"; ?>>DECEMBER 2015</option>
            <option value="NOVEMBER 2015" <?php if ($my == 'NOVEMBER 2015') echo "selected"; ?>>NOVEMBER 2015</option>
            <option value="OCTOBER 2015" <?php if ($my == 'OCTOBER 2015') echo "selected"; ?>>OCTOBER 2015</option>
            <option value="SEPTEMBER 2015" <?php if ($my == 'SEPTEMBER 2015') echo "selected"; ?>>SEPTEMBER 2015</option>
            <option value="AUGUST 2015" <?php if ($my == 'AUGUST 2015') echo "selected"; ?>>AUGUST 2015</option>
            <option value="JULY 2015" <?php if ($my == 'JULY 2015') echo "selected"; ?>>JULY 2015</option>
            <option value="JUNE 2015" <?php if ($my == 'JUNE 2015') echo "selected"; ?>>JUNE 2015</option>
            <option value="MAY 2015" <?php if ($my == 'MAY 2015') echo "selected"; ?>>MAY 2015</option>
            <option value="APRIL 2015" <?php if ($my == 'APRIL 2015') echo "selected"; ?>>APRIL 2015</option>
            <option value="MARCH 2015" <?php if ($my == 'MARCH 2015') echo "selected"; ?>>MARCH 2015</option>
            <option value="FEBRUARY 2015" <?php if ($my == 'FEBRUARY 2015') echo "selected"; ?>>FEBRUARY 2015</option>
            <option value="JANUARY 2015" <?php if ($my == 'JANUARY 2015') echo "selected"; ?>>JANUARY 2015</option>
        </select>
        <input type="submit" name="sub" value="SUBMIT" />
    </form>
</center>
<?php
echo "<br><br><center><table border=1><tr><th bgcolor='#BF00FF'>ID</th><th bgcolor='#BF00FF'>Name</th><th bgcolor='#BF00FF'>10 min</th><th bgcolor='#BF00FF'>30 min</th><th bgcolor='#BF00FF'>1 hr</th><th bgcolor='#BF00FF'>Left Early</th><th bgcolor='#BF00FF'>OT</th><th bgcolor='#BF00FF'>BT</th><th bgcolor='#BF00FF'>Absent</th><th bgcolor='#BF00FF'>Holiday Work</th><th bgcolor='#BF00FF'>OT AMT</th><th bgcolor='#BF00FF'>BT AMT</th><th bgcolor='#BF00FF'>TOTAL</th><th bgcolor='#BF00FF'>NetSalary</th></tr>";


// echo "NOD:".$nod."<br>";
$result = mysqli_query($db, "select * from employee order by ssn asc");
while ($row = mysqli_fetch_row($result)) {
    $cnt10 = 0;
    $cnt30 = 0;
    $cnt1 = 0;
    $cnteg = 0;
    $salary = 0;
    $present = 0;
    $hw = 0;
    $ot = 0;
    $abs = 0;
    $bt = 0;
    if ($row[10] > 3 and $row[10] != 9) {
        //echo $row[10]." ".$row[8]."<br>";
        if ($my == 'NOVEMBER 2020') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2020-11-01' and '2020-11-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2020-11-01' and '2020-11-30'");
            $nod = 23;
            $tnod = 30;
        }
        if ($my == 'OCTOBER 2020') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2020-11-01' and '2020-11-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2020-10-01' and '2020-10-31'");
            $nod = 25;
            $tnod = 31;
        }
        if ($my == 'SEPTEMBER 2020') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2020-09-01' and '2020-09-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2020-09-01' and '2020-09-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'AUGUST 2020') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2020-08-01' and '2020-08-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2020-08-01' and '2020-08-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'MARCH 2020') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2020-03-01' and '2020-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2020-03-01' and '2020-03-31'");
            $nod = 25;
            $tnod = 31;
        }
        if ($my == 'FEBRUARY 2020') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2020-02-01' and '2020-02-29'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2020-02-01' and '2020-02-29'");
            $nod = 25;
            $tnod = 29;
        }
        if ($my == 'JANUARY 2020') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2020-01-01' and '2020-01-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2020-01-01' and '2020-01-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'DECEMBER 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-12-01' and '2019-12-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-12-01' and '2019-12-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'NOVEMBER 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-11-01' and '2019-11-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-11-01' and '2019-11-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'OCTOBER 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-10-01' and '2019-10-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-10-01' and '2019-10-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'SEPTEMBER 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-09-01' and '2019-09-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-09-01' and '2019-09-30'");
            $nod = 25;
            $tnod = 30;
        }
        if ($my == 'AUGUST 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-08-01' and '2019-08-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-08-01' and '2019-08-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'july 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-07-01' and '2019-07-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-07-01' and '2019-07-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'june 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-06-01' and '2019-06-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-06-01' and '2019-06-30'");
            $nod = 25;
            $tnod = 30;
        }
        if ($my == 'MAY 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-05-01' and '2019-05-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-05-01' and '2019-05-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'APRIL 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-04-01' and '2019-04-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-04-01' and '2019-04-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'MARCH 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-03-01' and '2019-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-03-01' and '2019-03-31'");
            $nod = 25;
            $tnod = 31;
        }
        if ($my == 'FEBRUARY 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-02-01' and '2019-02-28'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-02-01' and '2019-02-28'");
            $nod = 24;
            $tnod = 28;
        }
        if ($my == 'JANUARY 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-01-01' and '2019-01-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-01-01' and '2019-01-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'DECEMBER 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-12-01' and '2018-12-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-12-01' and '2018-12-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'NOVEMBER 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-11-01' and '2018-11-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-11-01' and '2018-11-30'");
            $nod = 24;
            $tnod = 30;
        }
        if ($my == 'OCTOBER 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-10-01' and '2018-10-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-10-01' and '2018-10-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'SEPTEMBER 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-09-01' and '2018-09-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-09-01' and '2018-09-30'");
            $nod = 25;
            $tnod = 30;
        }
        if ($my == 'AUGUST 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-08-01' and '2018-08-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-08-01' and '2018-08-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'july 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-07-01' and '2018-07-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-07-01' and '2018-07-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'june 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-06-01' and '2018-06-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-06-01' and '2018-06-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'may 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-05-01' and '2018-05-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-05-01' and '2018-05-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'APRIL 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-04-01' and '2018-04-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-04-01' and '2018-04-30'");
            $nod = 25;
            $tnod = 30;
        }
        if ($my == 'MARCH 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-03-01' and '2018-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-03-01' and '2018-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'FEBRUARY 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-02-01' and '2018-02-28'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-02-01' and '2018-02-28'");
            $nod = 24;
            $tnod = 28;
        }
        if ($my == 'JANUARY 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-01-01' and '2018-01-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-01-01' and '2018-01-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'DECEMBER 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-12-01' and '2017-12-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-12-01' and '2017-12-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'NOVEMBER 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-11-01' and '2017-11-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-11-01' and '2017-11-30'");
            $nod = 25;
            $tnod = 30;
        }
        if ($my == 'OCTOBER 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-10-01' and '2017-10-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-10-01' and '2017-10-31'");
            $nod = 24;
            $tnod = 31;
        }
        if ($my == 'SEPTEMBER 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-09-01' and '2017-09-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-09-01' and '2017-09-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'AUGUST 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-08-01' and '2017-08-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-08-01' and '2017-08-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'JULY 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-07-01' and '2017-07-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-07-01' and '2017-07-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'JUNE 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-06-01' and '2017-06-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-06-01' and '2017-06-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'MAY 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-05-01' and '2017-05-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-05-01' and '2017-05-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'APRIL 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-04-01' and '2017-04-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-04-01' and '2017-04-30'");
            $nod = 25;
            $tnod = 30;
        }
        if ($my == 'MARCH 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-03-01' and '2017-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-03-01' and '2017-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'FEBRUARY 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-02-01' and '2017-02-28'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-01-01' and '2017-01-31'");
            $nod = 24;
            $tnod = 28;
        }
        if ($my == 'JANUARY 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-01-01' and '2017-01-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-01-01' and '2017-01-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'DECEMBER 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-12-01' and '2016-12-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-12-01' and '2016-12-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'NOVEMBER 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-11-01' and '2016-11-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-11-01' and '2016-11-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'OCTOBER 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-10-01' and '2016-10-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-10-01' and '2016-10-31'");
            $nod = 24;
            $tnod = 31;
        }
        if ($my == 'SEPTEMBER 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-03-01' and '2016-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-03-01' and '2016-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'AUGUST 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-03-01' and '2016-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-03-01' and '2016-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'JULY 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-03-01' and '2016-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-03-01' and '2016-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'JUNE 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-03-01' and '2016-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-03-01' and '2016-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'MAY 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-03-01' and '2016-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-03-01' and '2016-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'APRIL 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-03-01' and '2016-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-03-01' and '2016-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'MARCH 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-03-01' and '2016-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-03-01' and '2016-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'FEBRUARY 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-02-01' and '2016-02-29'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-02-01' and '2016-02-29'");
            $nod = 25;
            $tnod = 29;
        }
        if ($my == 'JANUARY 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-01-01' and '2016-01-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-01-01' and '2016-01-31'");
            $nod = 25;
            $tnod = 31;
        }
        if ($my == 'DECEMBER 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-12-01' and '2015-12-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-12-01' and '2015-12-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'NOVEMBER 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-11-01' and '2015-11-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-11-01' and '2015-11-30'");
            $nod = 23;
            $tnod = 30;
        }
        if ($my == 'OCTOBER 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-10-01' and '2015-10-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-10-01' and '2015-10-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'SEPTEMBER 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-09-01' and '2015-09-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-09-01' and '2015-09-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'AUGUST 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-08-01' and '2015-08-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-08-01' and '2015-08-31'");
            $nod = 25;
            $tnod = 31;
        }
        if ($my == 'JULY 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-07-01' and '2015-07-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-07-01' and '2015-07-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'JUNE 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-06-01' and '2015-06-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-06-01' and '2015-06-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'MAY 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-05-01' and '2015-05-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-05-01' and '2015-05-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'APRIL 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-04-01' and '2015-04-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-04-01' and '2015-04-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'MARCH 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-03-01' and '2015-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-03-01' and '2015-03-31'");
            $nod = 25;
            $tnod = 31;
        } else if ($my == 'FEBRUARY 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-02-01' and '2015-02-28'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-02-01' and '2015-02-28'");
            $nod = 24;
            $tnod = 28;
        } else if ($my == 'JANUARY 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-01-01' and '2015-01-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-01-01' and '2015-01-31'");
            $nod = 26;
            $tnod = 31;
        }
        //echo mysqli_num_rows($resultx)."<br>";
        while ($rowx = mysqli_fetch_row($resultx)) {
            $resulthw = mysqli_query($db, "select * from holiday where hdate='" . $rowx[2] . "'");
            if (mysqli_num_rows($resulthw) > 0) {
                $hw++;
            } else
                $present++;

            if ($rowx[5] >= 60) $cnt1++;
            else if ($rowx[5] >= 30) $cnt30++;
            else if ($rowx[5] >= 10) $cnt10++;

            $cnteg += $rowx[6];
            $ot += $rowx[7];
            $bt += $rowx[8];
        }
        if ($row[10] == 16)
            echo $present;
        while ($rowy = mysqli_fetch_row($resulthol)) {
            $yes = date('Y-m-d', (strtotime('-1 day', strtotime($rowy[0]))));
            $tom = date('Y-m-d', (strtotime('+1 day', strtotime($rowy[0]))));
            $ss = mysqli_query($db, "select * from holiday where hdate='" . $yes . "'");
            $ss1 = mysqli_query($db, "select * from holiday where hdate='" . $tom . "'");
            if (mysqli_num_rows($ss) == 0 and mysqli_num_rows($ss1) == 0) {
                $resultyes = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate='" . $yes . "'");
                $resulttom = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate='" . $tom . "'");
                if (mysqli_num_rows($resultyes) == 0 and mysqli_num_rows($resulttom) == 0)
                    $abs++;
            }
        }
        $absent = $nod - $present + $abs;

        $result_sal = mysqli_query($db, "select baseyear from salary where empid=" . $row[10]);
        $row_sal = mysqli_fetch_row($result_sal);
        $sal = $row_sal[0];
        $sal_day = $row_sal[0] / $tnod;
        $sal_hday = $sal_day / 2;
        $qry = mysqli_query($db, "select starttime,endtime from shifts where shiftid=(select sid from employee_shift where emp_id='" . $row[10] . "')");
        //  echo "select starttime,endtime from shifts where shiftid=(select sid from employee_shift where emp_id='".$row[10]."')";
        $qry1 = mysqli_fetch_array($qry);
        //echo $qr1[0];
        $strttime = strtotime($qry1[0]);
        $endtime = strtotime($qry1[1]);
        //   echo $strttime;
        //   echo $endtime;
        $diff = round(abs($strttime - $endtime) / 3600, 2);
        //   echo $diff.'-'.$row[10].'<br>';

        // $result_hrly=mysqli_query($db,"select hourlyrate from hourly where empid=".$row[0]);
        // $row_hrly=mysqli_fetch_row($result_hrly);

        $sal_hr = $sal_day / $diff;

        $sal_min = $sal_hr / 60;


        //   echo $sal_hr.'--'.$sal_min.'-'.$row[10].'='.$sal.'-'.$sal_day.'<br>';
        $ota = round($ot * $sal_min);
        // echo $ota;

        $bta = round($bt * $sal_min);
        $salary = $sal - (intval($cnt10 / 7) * $sal_hday) - (intval($cnt30 / 3) * $sal_hday) - ($cnt1 * $sal_hday) - ($cnteg * $sal_min) - ($absent * $sal_day) + ($hw * $sal_day);

        echo "<tr><td>" . $row[10] . "</td><td>" . $row[8] . "</td><td>" . $cnt10 . "</td><td>" . $cnt30 . "</td><td>" . $cnt1 . "</td><td>" . $cnteg . "</td><td>" . $ot . "</td><td>" . $bt . "</td><td>" . $absent . "</td><td>" . $hw . "</td><td>" . $ota . "</td><td>" . $bta . "</td><td>" . round($ota + $bta) . "</td><td>" . round($salary) . "</td></tr>";
    } else if ($row[10] == 9) {
        if ($my == 'NOVEMBER 2020') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2020-11-01' and '2020-11-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2020-11-01' and '2020-11-30'");
            $nod = 23;
            $tnod = 30;
        }
        if ($my == 'OCTOBER 2020') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2020-10-01' and '2020-10-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2020-10-01' and '2020-10-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'SEPTEMBER 2020') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2020-09-01' and '2020-09-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2020-09-01' and '2020-09-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'AUGUST 2020') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2020-08-01' and '2020-08-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2020-08-01' and '2020-08-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'MARCH 2020') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2020-03-01' and '2020-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2020-03-01' and '2020-03-31'");
            $nod = 25;
            $tnod = 31;
        }
        if ($my == 'FEBRUARY 2020') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2020-02-01' and '2020-02-29'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2020-02-01' and '2020-02-29'");
            $nod = 25;
            $tnod = 29;
        }
        if ($my == 'JANUARY 2020') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2020-01-01' and '2020-01-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2020-01-01' and '2020-01-31'");
            $nod = 26;
            $tnod = 31;
        }

        if ($my == 'DECEMBER 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-12-01' and '2019-12-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-12-01' and '2019-12-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'NOVEMBER 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-11-01' and '2019-11-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-11-01' and '2019-11-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'OCTOBER 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-10-01' and '2019-10-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-10-01' and '2019-10-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'SEPTEMBER 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-09-01' and '2019-09-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-09-01' and '2019-09-30'");
            $nod = 25;
            $tnod = 30;
        }
        if ($my == 'AUGUST 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-08-01' and '2019-08-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-08-01' and '2019-08-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'july 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-07-01' and '2019-07-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-07-01' and '2019-07-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'june 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-06-01' and '2019-06-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-06-01' and '2019-06-30'");
            $nod = 25;
            $tnod = 30;
        }
        if ($my == 'MAY 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-05-01' and '2019-05-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-05-01' and '2019-05-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'APRIL 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-04-01' and '2019-04-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-04-01' and '2019-04-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'MARCH 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-03-01' and '2019-02-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-03-01' and '2019-03-31'");
            $nod = 25;
            $tnod = 31;
        }
        if ($my == 'FEBRUARY 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-02-01' and '2019-02-28'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-02-01' and '2019-02-28'");
            $nod = 24;
            $tnod = 28;
        }
        if ($my == 'JANUARY 2019') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2019-01-01' and '2019-01-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2019-01-01' and '2019-01-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'DECEMBER 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-12-01' and '2018-12-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-12-01' and '2018-12-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'NOVEMBER 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-11-01' and '2018-11-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-11-01' and '2018-11-30'");
            $nod = 24;
            $tnod = 30;
        }
        if ($my == 'OCTOBER 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-10-01' and '2018-10-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-10-01' and '2018-10-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'SEPTEMBER 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-09-01' and '2018-09-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-09-01' and '2018-09-30'");
            $nod = 25;
            $tnod = 30;
        }
        if ($my == 'AUGUST 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-08-01' and '2018-08-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-08-01' and '2018-08-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'july 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-07-01' and '2018-07-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-07-01' and '2018-07-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'june 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-06-01' and '2018-06-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-06-01' and '2018-06-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'may 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-05-01' and '2018-05-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-05-01' and '2018-05-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'APRIL 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-04-01' and '2018-04-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-04-01' and '2018-04-30'");
            $nod = 25;
            $tnod = 30;
        }
        if ($my == 'MARCH 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-03-01' and '2018-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-03-01' and '2018-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'FEBRUARY 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-02-01' and '2018-02-28'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-02-01' and '2018-02-28'");
            $nod = 24;
            $tnod = 28;
        }
        if ($my == 'JANUARY 2018') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2018-01-01' and '2018-01-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2018-01-01' and '2018-01-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'DECEMBER 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-12-01' and '2017-12-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-12-01' and '2017-12-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'NOVEMBER 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-11-01' and '2017-11-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-11-01' and '2017-11-30'");
            $nod = 25;
            $tnod = 30;
        }
        if ($my == 'OCTOBER 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-10-01' and '2017-10-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-10-01' and '2017-10-31'");
            $nod = 24;
            $tnod = 31;
        }
        if ($my == 'SEPTEMBER 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-09-01' and '2017-09-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-09-01' and '2017-09-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'AUGUST 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-08-01' and '2017-08-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-08-01' and '2017-08-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'JULY 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-07-01' and '2017-07-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-07-01' and '2017-07-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'JUNE 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-06-01' and '2017-06-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-06-01' and '2017-06-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'MAY 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-05-01' and '2017-05-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-05-01' and '2017-05-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'APRIL 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-04-01' and '2017-04-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-04-01' and '2017-03-30'");
            $nod = 25;
            $tnod = 30;
        }
        if ($my == 'MARCH 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-03-01' and '2017-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-03-01' and '2017-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'FEBRUARY 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-02-01' and '2017-02-28'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-02-01' and '2017-02-28'");
            $nod = 24;
            $tnod = 28;
        }
        if ($my == 'JANUARY 2017') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2017-01-01' and '2017-01-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2017-01-01' and '2017-01-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'DECEMBER 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-12-01' and '2016-12-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-12-01' and '2016-12-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'NOVEMBER 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-11-01' and '2016-11-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-11-01' and '2016-11-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'OCTOBER 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-10-01' and '2016-10-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-10-01' and '2016-10-31'");
            $nod = 22;
            $tnod = 31;
        }
        if ($my == 'SEPTEMBER 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-03-01' and '2016-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-03-01' and '2016-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'AUGUST 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-03-01' and '2016-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-03-01' and '2016-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'JULY 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-03-01' and '2016-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-03-01' and '2016-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'JUNE 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-03-01' and '2016-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-03-01' and '2016-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'MAY 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-03-01' and '2016-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-03-01' and '2016-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'APRIL 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-03-01' and '2016-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-03-01' and '2016-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'MARCH 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-03-01' and '2016-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-03-01' and '2016-03-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'FEBRUARY 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-02-01' and '2016-02-29'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-02-01' and '2016-02-29'");
            $nod = 25;
            $tnod = 29;
        }
        if ($my == 'JANUARY 2016') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2016-01-01' and '2016-01-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2016-01-01' and '2016-01-31'");
            $nod = 25;
            $tnod = 31;
        }
        if ($my == 'DECEMBER 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-12-01' and '2015-12-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-12-01' and '2015-12-30'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'NOVEMBER 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-11-01' and '2015-11-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-11-01' and '2015-11-30'");
            $nod = 23;
            $tnod = 30;
        }
        if ($my == 'OCTOBER 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-10-01' and '2015-10-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-10-01' and '2015-10-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'SEPTEMBER 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-09-01' and '2015-09-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-09-01' and '2015-09-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'AUGUST 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-08-01' and '2015-08-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-08-01' and '2015-08-31'");
            $nod = 25;
            $tnod = 31;
        }
        if ($my == 'JULY 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-07-01' and '2015-07-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-07-01' and '2015-07-31'");
            $nod = 27;
            $tnod = 31;
        }
        if ($my == 'JUNE 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-06-01' and '2015-06-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-06-01' and '2015-06-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'MAY 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-05-01' and '2015-05-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-05-01' and '2015-05-31'");
            $nod = 26;
            $tnod = 31;
        }
        if ($my == 'APRIL 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-04-01' and '2015-04-30'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-04-01' and '2015-04-30'");
            $nod = 26;
            $tnod = 30;
        }
        if ($my == 'MARCH 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-03-01' and '2015-03-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-03-01' and '2015-03-31'");
            $nod = 25;
            $tnod = 31;
        } else if ($my == 'FEBRUARY 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-02-01' and '2015-02-28'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-02-01' and '2015-02-28'");
            $nod = 24;
            $tnod = 28;
        } else if ($my == 'JANUARY 2015') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2015-01-01' and '2015-01-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2015-01-01' and '2015-01-31'");
            $nod = 26;
            $tnod = 31;
        } else if ($my == 'DECEMBER 2014') {
            $resultx = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate between '2014-12-01' and '2014-12-31'");
            $resulthol = mysqli_query($db, "select hdate from holiday where hdate between '2014-12-01' and '2014-12-31'");
            $nod = 27;
            $tnod = 31;
        }
        //echo mysqli_num_rows($resultx)."<br>";
        while ($rowx = mysqli_fetch_row($resultx)) {
            $resulthw = mysqli_query($db, "select * from holiday where hdate='" . $rowx[2] . "'");
            if (mysqli_num_rows($resulthw) > 0) {
                $hw++;
            } else
                $present++;
        }
        while ($rowy = mysqli_fetch_row($resulthol)) {
            $yes = date('Y-m-d', (strtotime('-1 day', strtotime($rowy[0]))));
            $tom = date('Y-m-d', (strtotime('+1 day', strtotime($rowy[0]))));
            $resultyes = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate='" . $yes . "'");
            $resulttom = mysqli_query($db, "select * from attendance where ID=" . $row[10] . " and pdate='" . $tom . "'");
            if (mysqli_num_rows($resultyes) == 0 and mysqli_num_rows($resulttom) == 0)
                $abs++;
        }
        $absent = $nod - $present + $abs;
        $result_sal = mysqli_query($db, "select baseyear from salary where empid=" . $row[10]);
        $row_sal = mysqli_fetch_row($result_sal);
        $sal = $row_sal[0];
        $sal_day = $row_sal[0] / $tnod;
        $sal_hday = $sal_day / 2;

        $ded = 0;
        if ($absent > 2) $ded = ($absent - 2) * $sal_day;

        $salary = $sal - $ded;

        echo "<tr><td>" . $row[10] . "</td><td>" . $row[8] . "</td><td>" . $cnt10 . "</td><td>" . $cnt30 . "</td><td>" . $cnt1 . "</td><td>" . $cnteg . "</td><td>" . $ot . "</td><td>" . $bt . "</td><td>" . $absent . "</td><td>" . $hw . "</td><td></td><td></td><td></td><td>" . round($salary) . "</td></tr>";
    }
}
echo "</table></center>";
?>
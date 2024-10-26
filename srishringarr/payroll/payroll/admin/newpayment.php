<?

   $se="n";
   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : enternewemployee2.php
    // Description : After user chooses a department, this form allow
    //               them to fill in employee information
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : enternewemployee.php,insertemployee.php
    
?>

<table width="100%" border="0">
  <tr>
    <td> 
      
        <form method="post" action="insertfees.php" >
        <p align="center"><b>Payment Information</b></p>
        <table width="80%" align=center border=0>                          
          <tr> 
            <td width=200> 
              <div align="right"><b>Student Id : </b></div>
            </td>
            <td> 
              <input type=text name="stid" size=15>
            </td>
          </tr>
          <tr> 
            <td width=200> 
              <div align="right"><b>Date of Payment :</b></div>
            </td>
            <td><select name="month">
              <option value="" selected="selected">Month</option>
              <option value="01">January</option>
              <option value="02">February</option>
              <option value="03">March</option>
              <option value="04">April</option>
              <option value="05">May</option>
              <option value="06">June</option>
              <option value="07">July</option>
              <option value="08">August</option>
              <option value="09">September</option>
              <option value="10">October</option>
              <option value="11">November</option>
              <option value="12">December</option>
            </select>
              <select name="day">
                <option value="" selected="selected">Day</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
              </select>
              <select name="year" >
                <option value="" selected="selected">Year</option>
                <?
              
                    for ($yy=2000;$yy<=2015;$yy++)
                    {
                       
                        echo "<option value=$yy>$yy</option>\n";
                    	
                    }
              ?>
              </select>
           </td>
          </tr>          
          
          <tr> 
            <td width=200> 
              <div align="right"><b>Amount :</b></div>
            </td>
            <td><input type="text" name="amt" size="25" /></td>
          </tr>                                       
        </table>
        
        <p align="center">        
          <input type="submit" name="Submit" value="Enter New Payment">
        </p>
      </form>

      </td>
  </tr>
</table>
<? include("footer.php"); ?>

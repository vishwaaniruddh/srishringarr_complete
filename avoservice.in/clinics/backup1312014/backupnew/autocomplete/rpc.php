<?php
	include("../config.php");
	
		if(isset($_POST['queryString'])) {
		$query='';
			$queryString = ($_POST['queryString']);
			 $id=$_POST['id'];
			$suggest=$_POST['suggest'];
			$suggestlist=$_POST['suggestlist'];
			$ref=$_POST['ref'];
			// Is the string length greater than 0?
			
			if(strlen($queryString) >0) {
				// Run the query: We use LIKE '$queryString%'
				// The percentage sign is a wild-card, in my example of countries it works like this...
				// $queryString = 'Uni';
				// Returned data = 'United States, United Kindom';
				
				// YOU NEED TO ALTER THE QUERY TO MATCH YOUR DATABASE.
				// eg: SELECT yourColumnName FROM yourTable WHERE yourColumnName LIKE '$queryString%' LIMIT 10
			//	echo "SELECT doc_id,name FROM doctor WHERE name LIKE '$queryString%' LIMIT 20";
			if($ref=='docref1')
			{
			$query = mysql_query("SELECT doc_id,name FROM doctor WHERE name LIKE '%$queryString%' order by name ASC LIMIT 15");
			}
			elseif($ref=='tosref1')
			{
			$query = mysql_query("SELECT doc_id,name FROM doctor WHERE (`CATEGORY` LIKE '%Orthopaedic Surgeon%' OR `SPECIAL` LIKE '%Orthopaedic Surgeon%') and name LIKE '%$queryString%' order by name ASC LIMIT 15");
			}
			elseif($ref=='paedref1')
			{
			$query = mysql_query("SELECT doc_id,name FROM doctor WHERE (`CATEGORY` LIKE '%Paediatrician%' OR `SPECIAL` LIKE '%Paediatrician%') and name LIKE '%$queryString%' order by name ASC LIMIT 15");
			}
			elseif($ref=='physref1')
			{
			$query = mysql_query("SELECT doc_id,name FROM doctor WHERE (`CATEGORY` LIKE '%Physiotherapist%' OR `SPECIAL` LIKE '%Physiotherapist%') and name LIKE '%$queryString%' order by name ASC LIMIT 15");
			}
			elseif($ref=='neuref1')
			{
			//echo "SELECT doc_id,name FROM doctor WHERE  (SPECIAL LIKE '%Neuro Surgeon%' OR  SPECIAL Like '%Neurologist%' OR CATEGORY ='%Neurologist%') AND name LIKE '%$queryString%' order by name ASC LIMIT 15";
			$query = mysql_query("SELECT doc_id,name FROM doctor WHERE  (SPECIAL='%Neuro Surgeon%' OR  SPECIAL LIKE '%Neurologist%' OR CATEGORY Like '%Neurologist%') AND name LIKE '%$queryString%' order by name ASC LIMIT 15");
			}
			elseif($ref=='swref1')
			{
			$query=mysql_query("select social_id,name from social where  name LIKE '%$queryString%' order by name ASC LIMIT 15");
			}
			elseif($ref=='ngref1')
			{
			//echo "select ngo_id,name from ngo where  name LIKE '%$queryString%' order by name ASC LIMIT 15";
			$query=mysql_query("select ngo_id,name from ngo where  name LIKE '%$queryString%' order by name ASC LIMIT 15");
			}
			
			
			//echo "SELECT doc_id,name FROM doctor WHERE  ".$str." name LIKE '%$queryString%' order by name ASC LIMIT 15";
				//$query = mysql_query("SELECT doc_id,name FROM doctor WHERE  ".$str." name LIKE '%$queryString%' order by name ASC LIMIT 15");
				if($query) {
					// While there are results loop through them - fetching an Object (i like PHP5 btw!).
					while ($result = mysql_fetch_array($query)) {
						// Format the results, im using <li> for the list, you can change it.
						// The onClick function fills the textbox with the result.
						
						// YOU MUST CHANGE: $result->value to $result->your_colum
						?>
                        <li onClick="fill('<?php echo $result[1]."***".$result[0]; ?>','<?php echo $suggest; ?>','<?php echo $id; ?>','<?php echo $ref; ?>')"> <?php echo $result[1]; ?></li>
                        <?php
	         			
	         		}
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
				// Dont do anything.
			} // There is a queryString.
		} else {
			echo 'There should be no direct access to this script!';
		}
	
?>
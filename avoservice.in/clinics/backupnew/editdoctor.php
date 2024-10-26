 <?php
 include('config.php');


$id=$_GET['id'];
$sql="select * from doctor where doc_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
//echo $row[3];
 ?>
 
 <link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
 
 <div class="M_page">
 
 <fieldset class="textbox">
 <form method="post" class="signin" action="update_doc.php" onSubmit="return docvalidate(this)" name="docform">
                <fieldset class="textbox">
                <h1>Edit Doctor</h1>
                <table width="427"><tr><td width="102">
            	<label class="name">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <span>Name:</span></label></td><td width="313">
                <input id="name" name="name" type="text" value="<?php echo $row[1]; ?>"  >
               </td></tr>
               <tr><td>
                
                <label class="add">
                <span>Address:</span></label></td><td>
                <textarea name="add" cols="27" rows="3" style="resize:none;border:1px #ac0404 solid;"><?php echo $row[4]; ?></textarea>
             </td></tr>
              <tr><td>
                
                <label class="city">
                <span>Country:</span></label></td><td>
                <select name="country" id="country" style="width:235px;height:26px;border:1px #ac0404 solid;"> 
<option value="Afghanistan" <?php if($row[2]=="Afghanistan"){ echo "selected";} ?>>Afghanistan</option> 
<option value="Albania" <?php if($row[2]=="Albania"){ echo "selected";} ?>>Albania</option> 
<option value="Algeria" <?php if($row[2]=="Algeria"){ echo "selected";} ?>>Algeria</option> 
<option value="American Samoa" <?php if($row[2]=="American Samoa"){ echo "selected";} ?>>American Samoa</option> 
<option value="Andorra" <?php if($row[2]=="Andorra"){ echo "selected";} ?>>Andorra</option> 
<option value="Angola" <?php if($row[2]=="Angola"){ echo "selected";} ?>>Angola</option> 
<option value="Anguilla" <?php if($row[2]=="Anguilla"){ echo "selected";} ?>>Anguilla</option> 
<option value="Antarctica" <?php if($row[2]=="Antarctica"){ echo "selected";} ?>>Antarctica</option> 
<option value="Antigua and Barbuda" <?php if($row[2]=="Antigua and Barbuda"){ echo "selected";} ?>>Antigua and Barbuda</option> 
<option value="Argentina" <?php if($row[2]=="Argentina"){ echo "selected";} ?>>Argentina</option> 
<option value="Armenia" <?php if($row[2]=="Armenia"){ echo "selected";} ?>>Armenia</option> 
<option value="Aruba" <?php if($row[2]=="Aruba"){ echo "selected";} ?>>Aruba</option> 
<option value="Australia" <?php if($row[2]=="Australia"){ echo "selected";} ?>>Australia</option> 
<option value="Austria" <?php if($row[2]=="Austria"){ echo "selected";} ?>>Austria</option> 
<option value="Azerbaijan" <?php if($row[2]=="Azerbaijan"){ echo "selected";} ?>>Azerbaijan</option> 
<option value="Bahamas" <?php if($row[2]=="Bahamas"){ echo "selected";} ?>>Bahamas</option> 
<option value="Bahrain" <?php if($row[2]=="Bahrain"){ echo "selected";} ?>>Bahrain</option> 
<option value="Bangladesh" <?php if($row[2]=="Bangladesh"){ echo "selected";} ?>>Bangladesh</option> 
<option value="Barbados" <?php if($row[2]=="Barbados"){ echo "selected";} ?>>Barbados</option> 
<option value="Belarus" <?php if($row[2]=="Belarus"){ echo "selected";} ?>>Belarus</option> 
<option value="Belgium" <?php if($row[2]=="Belgium"){ echo "selected";} ?>>Belgium</option> 
<option value="Belize" <?php if($row[2]=="Belize"){ echo "selected";} ?>>Belize</option> 
<option value="Benin" <?php if($row[2]=="Benin"){ echo "selected";} ?>>Benin</option> 
<option value="Bermuda" <?php if($row[2]=="Bermuda"){ echo "selected";} ?>>Bermuda</option> 
<option value="Bhutan" <?php if($row[2]=="Bhutan"){ echo "selected";} ?>>Bhutan</option> 
<option value="Bolivia" <?php if($row[2]=="Bolivia"){ echo "selected";} ?>>Bolivia</option> 
<option value="Bosnia and Herzegovina" <?php if($row[2]=="Bosnia and Herzegovina"){ echo "selected";} ?>>Bosnia and Herzegovina</option> 
<option value="Botswana" <?php if($row[2]=="Botswana"){ echo "selected";} ?>>Botswana</option> 
<option value="Bouvet Island" <?php if($row[2]=="Bouvet Island"){ echo "selected";} ?>>Bouvet Island</option> 
<option value="Brazil" <?php if($row[2]=="Brazil"){ echo "selected";} ?>>Brazil</option> 
<option value="British Indian Ocean Territory" <?php if($row[2]=="British Indian Ocean Territory"){ echo "selected";} ?>>British Indian Ocean Territory</option> 
<option value="Brunei Darussalam" <?php if($row[2]=="Brunei Darussalam"){ echo "selected";} ?>>Brunei Darussalam</option> 
<option value="Bulgaria" <?php if($row[2]=="Bulgaria"){ echo "selected";} ?>>Bulgaria</option> 
<option value="Burkina Faso" <?php if($row[2]=="Burkina Faso"){ echo "selected";} ?>>Burkina Faso</option> 
<option value="Burundi" <?php if($row[2]=="Burundi"){ echo "selected";} ?>>Burundi</option> 
<option value="Cambodia" <?php if($row[2]=="Cambodia"){ echo "selected";} ?>>Cambodia</option> 
<option value="Cameroon" <?php if($row[2]=="Cameroon"){ echo "selected";} ?>>Cameroon</option> 
<option value="Canada" <?php if($row[2]=="Canada"){ echo "selected";} ?>>Canada</option> 
<option value="Cape Verde" <?php if($row[2]=="Cape Verde"){ echo "selected";} ?>>Cape Verde</option> 
<option value="Cayman Islands" <?php if($row[2]=="Cayman Islands"){ echo "selected";} ?>>Cayman Islands</option> 
<option value="Central African Republic" <?php if($row[2]=="Central African Republic"){ echo "selected";} ?>>Central African Republic</option> 
<option value="Chad" <?php if($row[2]=="Chad"){ echo "selected";} ?>>Chad</option> 
<option value="Chile" <?php if($row[2]=="Chile"){ echo "selected";} ?>>Chile</option> 
<option value="China" <?php if($row[2]=="China"){ echo "selected";} ?>>China</option> 
<option value="Christmas Island" <?php if($row[2]=="Christmas Island"){ echo "selected";} ?>>Christmas Island</option> 
<option value="Cocos (Keeling) Islands" <?php if($row[2]=="Cocos (Keeling) Islands"){ echo "selected";} ?>>Cocos (Keeling) Islands</option> 
<option value="Colombia" <?php if($row[2]=="Colombia"){ echo "selected";} ?>>Colombia</option> 
<option value="Comoros" <?php if($row[2]=="Comoros"){ echo "selected";} ?>>Comoros</option> 
<option value="Congo" <?php if($row[2]=="Congo"){ echo "selected";} ?>>Congo</option> 
<option value="Congo, The Democratic Republic of The" <?php if($row[2]=="Congo, The Democratic Republic of The"){ echo "selected";} ?>>Congo, The Democratic Republic of The</option> 
<option value="Cook Islands" <?php if($row[2]=="Cook Islands"){ echo "selected";} ?>>Cook Islands</option> 
<option value="Costa Rica" <?php if($row[2]=="Costa Rica"){ echo "selected";} ?>>Costa Rica</option> 
<option value="Cote Divoire" <?php if($row[2]=="Cote Divoire"){ echo "selected";} ?>>Cote Divoire</option> 
<option value="Croatia" <?php if($row[2]=="Croatia"){ echo "selected";} ?>>Croatia</option> 
<option value="Cuba" <?php if($row[2]=="Cuba"){ echo "selected";} ?>>Cuba</option> 
<option value="Cyprus" <?php if($row[2]=="Cyprus"){ echo "selected";} ?>>Cyprus</option> 
<option value="Czech Republic" <?php if($row[2]=="Czech Republic"){ echo "selected";} ?>>Czech Republic</option> 
<option value="Denmark" <?php if($row[2]=="Denmark"){ echo "selected";} ?>>Denmark</option> 
<option value="Djibouti" <?php if($row[2]=="Djibouti"){ echo "selected";} ?>>Djibouti</option> 
<option value="Dominica" <?php if($row[2]=="Dominica"){ echo "selected";} ?>>Dominica</option> 
<option value="Dominican Republic" <?php if($row[2]=="Dominican Republic"){ echo "selected";} ?>>Dominican Republic</option> 
<option value="Ecuador" <?php if($row[2]=="Ecuador"){ echo "selected";} ?>>Ecuador</option> 
<option value="Egypt" <?php if($row[2]=="Egypt"){ echo "selected";} ?>>Egypt</option> 
<option value="El Salvador" <?php if($row[2]=="El Salvador"){ echo "selected";} ?>>El Salvador</option> 
<option value="Equatorial Guinea" <?php if($row[2]=="Equatorial Guinea"){ echo "selected";} ?>>Equatorial Guinea</option> 
<option value="Eritrea" <?php if($row[2]=="Eritrea"){ echo "selected";} ?>>Eritrea</option> 
<option value="Estonia" <?php if($row[2]=="Estonia"){ echo "selected";} ?>>Estonia</option> 
<option value="Ethiopia"> <?php if($row[2]=="Ethiopia"){ echo "selected";} ?>Ethiopia</option> 
<option value="Falkland Islands (Malvinas)" <?php if($row[2]=="Falkland Islands (Malvinas)"){ echo "selected";} ?>>Falkland Islands (Malvinas)</option> 
<option value="Faroe Islands" <?php if($row[2]=="Faroe Islands"){ echo "selected";} ?>>Faroe Islands</option> 
<option value="Fiji" <?php if($row[2]=="Fiji"){ echo "selected";} ?>>Fiji</option> 
<option value="Finland" <?php if($row[2]=="Finland"){ echo "selected";} ?>>Finland</option> 
<option value="France" <?php if($row[2]=="France"){ echo "selected";} ?>>France</option> 
<option value="French Guiana" <?php if($row[2]=="French Guiana"){ echo "selected";} ?>>French Guiana</option> 
<option value="French Polynesia" <?php if($row[2]=="French Polynesia"){ echo "selected";} ?>>French Polynesia</option> 
<option value="French Southern Territories" <?php if($row[2]=="French Southern Territories"){ echo "selected";} ?>>French Southern Territories</option> 
<option value="Gabon" <?php if($row[2]=="Gabon"){ echo "selected";} ?>>Gabon</option> 
<option value="Gambia" <?php if($row[2]=="Gambia"){ echo "selected";} ?>>Gambia</option> 
<option value="Georgia" <?php if($row[2]=="Georgia"){ echo "selected";} ?>>Georgia</option> 
<option value="Germany" <?php if($row[2]=="Germany"){ echo "selected";} ?>>Germany</option> 
<option value="Ghana" <?php if($row[2]=="Ghana"){ echo "selected";} ?>>Ghana</option> 
<option value="Gibraltar" <?php if($row[2]=="Gibraltar"){ echo "selected";} ?>>Gibraltar</option> 
<option value="Greece" <?php if($row[2]=="Greece"){ echo "selected";} ?>>Greece</option> 
<option value="Greenland" <?php if($row[2]=="Greenland"){ echo "selected";} ?>>Greenland</option> 
<option value="Grenada" <?php if($row[2]=="Grenada"){ echo "selected";} ?>>Grenada</option> 
<option value="Guadeloupe" <?php if($row[2]=="Guadeloupe"){ echo "selected";} ?>>Guadeloupe</option> 
<option value="Guam" <?php if($row[2]=="Guam"){ echo "selected";} ?>>Guam</option> 
<option value="Guatemala" <?php if($row[2]=="Guatemala"){ echo "selected";} ?>>Guatemala</option> 
<option value="Guinea" <?php if($row[2]=="Guinea"){ echo "selected";} ?>>Guinea</option> 
<option value="Guinea-bissau" <?php if($row[2]=="Guinea-bissau"){ echo "selected";} ?>>Guinea-bissau</option> 
<option value="Guyana" <?php if($row[2]=="Guyana"){ echo "selected";} ?>>Guyana</option> 
<option value="Haiti" <?php if($row[2]=="Haiti"){ echo "selected";} ?>>Haiti</option> 
<option value="Heard Island and Mcdonald Islands" <?php if($row[2]=="Heard Island and Mcdonald Islands"){ echo "selected";} ?>>Heard Island and Mcdonald Islands</option> 
<option value="Holy See (Vatican City State)" <?php if($row[2]=="Holy See (Vatican City State)"){ echo "selected";} ?>>Holy See (Vatican City State)</option> 
<option value="Honduras" <?php if($row[2]=="Honduras"){ echo "selected";} ?>>Honduras</option> 
<option value="Hong Kong" <?php if($row[2]=="Hong Kong"){ echo "selected";} ?>>Hong Kong</option> 
<option value="Hungary" <?php if($row[2]=="Hungary"){ echo "selected";} ?>>Hungary</option> 
<option value="Iceland" <?php if($row[2]=="Iceland"){ echo "selected";} ?>>Iceland</option> 
<option value="India" <?php if($row[2]=="India"){ echo "selected";} ?>>India</option> 
<option value="Indonesia" <?php if($row[2]=="Indonesia"){ echo "selected";} ?>>Indonesia</option> 
<option value="Iran, Islamic Republic of" <?php if($row[2]=="Iran, Islamic Republic of"){ echo "selected";} ?>>Iran, Islamic Republic of</option> 
<option value="Iraq" <?php if($row[2]=="Iraq"){ echo "selected";} ?>>Iraq</option> 
<option value="Ireland" <?php if($row[2]=="Ireland"){ echo "selected";} ?>>Ireland</option> 
<option value="Israel" <?php if($row[2]=="Israel"){ echo "selected";} ?>>Israel</option> 
<option value="Italy" <?php if($row[2]=="Italy"){ echo "selected";} ?>>Italy</option> 
<option value="Jamaica" <?php if($row[2]=="Jamaica"){ echo "selected";} ?>>Jamaica</option> 
<option value="Japan" <?php if($row[2]=="Japan"){ echo "selected";} ?>>Japan</option> 
<option value="Jordan" <?php if($row[2]=="Jordan"){ echo "selected";} ?>>Jordan</option> 
<option value="Kazakhstan" <?php if($row[2]=="Kazakhstan"){ echo "selected";} ?>>Kazakhstan</option> 
<option value="Kenya" <?php if($row[2]=="Kenya"){ echo "selected";} ?>>Kenya</option> 
<option value="Kiribati" <?php if($row[2]=="Kiribati"){ echo "selected";} ?>>Kiribati</option> 
<option value="Korea, Democratic People's Republic of" <?php if($row[2]=="Korea, Democratic People's Republic of"){ echo "selected";} ?>>Korea, Democratic People's Republic of</option> 
<option value="Korea, Republic of" <?php if($row[2]=="Korea, Republic of"){ echo "selected";} ?>>Korea, Republic of</option> 
<option value="Kuwait" <?php if($row[2]=="Kuwait"){ echo "selected";} ?>>Kuwait</option> 
<option value="Kyrgyzstan" <?php if($row[2]=="Kyrgyzstan"){ echo "selected";} ?>>Kyrgyzstan</option> 
<option value="Lao People's Democratic Republic" <?php if($row[2]=="Lao People's Democratic Republic"){ echo "selected";} ?>>Lao People's Democratic Republic</option> 
<option value="Latvia" <?php if($row[2]=="Latvia"){ echo "selected";} ?>>Latvia</option> 
<option value="Lebanon" <?php if($row[2]=="Lebanon"){ echo "selected";} ?>>Lebanon</option> 
<option value="Lesotho" <?php if($row[2]=="Lesotho"){ echo "selected";} ?>>Lesotho</option> 
<option value="Liberia" <?php if($row[2]=="Liberia"){ echo "selected";} ?>>Liberia</option> 
<option value="Libyan Arab Jamahiriya" <?php if($row[2]=="Libyan Arab Jamahiriya"){ echo "selected";} ?>>Libyan Arab Jamahiriya</option> 
<option value="Liechtenstein" <?php if($row[2]=="Liechtenstein"){ echo "selected";} ?>>Liechtenstein</option> 
<option value="Lithuania" <?php if($row[2]=="Lithuania"){ echo "selected";} ?>>Lithuania</option> 
<option value="Luxembourg" <?php if($row[2]=="Luxembourg"){ echo "selected";} ?>>Luxembourg</option> 
<option value="Macao" <?php if($row[2]=="Macao"){ echo "selected";} ?>>Macao</option> 
<option value="Macedonia, The Former Yugoslav Republic of" <?php if($row[2]=="Macedonia, The Former Yugoslav Republic of"){ echo "selected";} ?>>Macedonia, The Former Yugoslav Republic of</option> 
<option value="Madagascar" <?php if($row[2]=="Madagascar"){ echo "selected";} ?>>Madagascar</option> 
<option value="Malawi" <?php if($row[2]=="Malawi"){ echo "selected";} ?>>Malawi</option> 
<option value="Malaysia" <?php if($row[2]=="Malaysia"){ echo "selected";} ?>>Malaysia</option> 
<option value="Maldives" <?php if($row[2]=="Maldives"){ echo "selected";} ?>>Maldives</option> 
<option value="Mali" <?php if($row[2]=="Mali"){ echo "selected";} ?>>Mali</option> 
<option value="Malta" <?php if($row[2]=="Malta"){ echo "selected";} ?>>Malta</option> 
<option value="Marshall Islands" <?php if($row[2]=="Marshall Islands"){ echo "selected";} ?>>Marshall Islands</option> 
<option value="Martinique" <?php if($row[2]=="Martinique"){ echo "selected";} ?>>Martinique</option> 
<option value="Mauritania" <?php if($row[2]=="Mauritania"){ echo "selected";} ?>>Mauritania</option> 
<option value="Mauritius" <?php if($row[2]=="Mauritius"){ echo "selected";} ?>>Mauritius</option> 
<option value="Mayotte" <?php if($row[2]=="Mayotte"){ echo "selected";} ?>>Mayotte</option> 
<option value="Mexico" <?php if($row[2]=="Mexico"){ echo "selected";} ?>>Mexico</option> 
<option value="Micronesia, Federated States of" <?php if($row[2]=="Micronesia, Federated States of"){ echo "selected";} ?>>Micronesia, Federated States of</option> 
<option value="Moldova, Republic of" <?php if($row[2]=="Moldova, Republic of"){ echo "selected";} ?>>Moldova, Republic of</option> 
<option value="Monaco" <?php if($row[2]=="Monaco"){ echo "selected";} ?>>Monaco</option> 
<option value="Mongolia" <?php if($row[2]=="Mongolia"){ echo "selected";} ?>>Mongolia</option> 
<option value="Montserrat" <?php if($row[2]=="Montserrat"){ echo "selected";} ?>>Montserrat</option> 
<option value="Morocco" <?php if($row[2]=="Morocco"){ echo "selected";} ?>>Morocco</option> 
<option value="Mozambique" <?php if($row[2]=="Mozambique"){ echo "selected";} ?>>Mozambique</option> 
<option value="Myanmar" <?php if($row[2]=="Myanmar"){ echo "selected";} ?>>Myanmar</option> 
<option value="Namibia" <?php if($row[2]=="Namibia"){ echo "selected";} ?>>Namibia</option> 
<option value="Nauru" <?php if($row[2]=="Nauru"){ echo "selected";} ?>>Nauru</option> 
<option value="Nepal" <?php if($row[2]=="Nepal"){ echo "selected";} ?>>Nepal</option> 
<option value="Netherlands" <?php if($row[2]=="Netherlands"){ echo "selected";} ?>>Netherlands</option> 
<option value="Netherlands Antilles" <?php if($row[2]=="Netherlands Antilles"){ echo "selected";} ?>>Netherlands Antilles</option> 
<option value="New Caledonia" <?php if($row[2]=="New Caledonia"){ echo "selected";} ?>>New Caledonia</option> 
<option value="New Zealand" <?php if($row[2]=="New Zealand"){ echo "selected";} ?>>New Zealand</option> 
<option value="Nicaragua" <?php if($row[2]=="Nicaragua"){ echo "selected";} ?>>Nicaragua</option> 
<option value="Niger" <?php if($row[2]=="Niger"){ echo "selected";} ?>>Niger</option> 
<option value="Nigeria" <?php if($row[2]=="Nigeria"){ echo "selected";} ?>>Nigeria</option> 
<option value="Niue" <?php if($row[2]=="Niue"){ echo "selected";} ?>>Niue</option> 
<option value="Norfolk Island" <?php if($row[2]=="Norfolk Island"){ echo "selected";} ?>>Norfolk Island</option> 
<option value="Northern Mariana Islands" <?php if($row[2]=="Northern Mariana Islands"){ echo "selected";} ?>>Northern Mariana Islands</option> 
<option value="Norway" <?php if($row[2]=="Norway"){ echo "selected";} ?>>Norway</option> 
<option value="Oman" <?php if($row[2]=="Oman"){ echo "selected";} ?>>Oman</option> 
<option value="Pakistan" <?php if($row[2]=="Pakistan"){ echo "selected";} ?>>Pakistan</option> 
<option value="Palau" <?php if($row[2]=="Palau"){ echo "selected";} ?>>Palau</option> 
<option value="Palestinian Territory, Occupied" <?php if($row[2]=="Palestinian Territory, Occupied"){ echo "selected";} ?>>Palestinian Territory, Occupied</option> 
<option value="Panama" <?php if($row[2]=="Panama"){ echo "selected";} ?>>Panama</option> 
<option value="Papua New Guinea" <?php if($row[2]=="Papua New Guinea"){ echo "selected";} ?>>Papua New Guinea</option> 
<option value="Paraguay" <?php if($row[2]=="Paraguay"){ echo "selected";} ?>>Paraguay</option> 
<option value="Peru" <?php if($row[2]=="Peru"){ echo "selected";} ?>>Peru</option> 
<option value="Philippines" <?php if($row[2]=="Philippines"){ echo "selected";} ?>>Philippines</option> 
<option value="Pitcairn" <?php if($row[2]=="Pitcairn"){ echo "selected";} ?>>Pitcairn</option> 
<option value="Poland" <?php if($row[2]=="Poland"){ echo "selected";} ?>>Poland</option> 
<option value="Portugal" <?php if($row[2]=="Portugal"){ echo "selected";} ?>>Portugal</option> 
<option value="Puerto Rico" <?php if($row[2]=="Puerto Rico"){ echo "selected";} ?>>Puerto Rico</option> 
<option value="Qatar" <?php if($row[2]=="Qatar"){ echo "selected";} ?>>Qatar</option> 
<option value="Reunion" <?php if($row[2]=="Reunion"){ echo "selected";} ?>>Reunion</option> 
<option value="Romania" <?php if($row[2]=="Romania"){ echo "selected";} ?>>Romania</option> 
<option value="Russian Federation" <?php if($row[2]=="Russian Federation"){ echo "selected";} ?>>Russian Federation</option> 
<option value="Rwanda" <?php if($row[2]=="Rwanda"){ echo "selected";} ?>>Rwanda</option> 
<option value="Saint Helena" <?php if($row[2]=="Saint Helena"){ echo "selected";} ?>>Saint Helena</option> 
<option value="Saint Kitts and Nevis" <?php if($row[2]=="Saint Kitts and Nevis"){ echo "selected";} ?>>Saint Kitts and Nevis</option> 
<option value="Saint Lucia" <?php if($row[2]=="Saint Lucia"){ echo "selected";} ?>>Saint Lucia</option> 
<option value="Saint Pierre and Miquelon" <?php if($row[2]=="Saint Pierre and Miquelon"){ echo "selected";} ?>>Saint Pierre and Miquelon</option> 
<option value="Saint Vincent and The Grenadines" <?php if($row[2]=="Saint Vincent and The Grenadines"){ echo "selected";} ?>>Saint Vincent and The Grenadines</option> 
<option value="Samoa" <?php if($row[2]=="Samoa"){ echo "selected";} ?>>Samoa</option> 
<option value="San Marino" <?php if($row[2]=="San Marino"){ echo "selected";} ?>>San Marino</option> 
<option value="Sao Tome and Principe" <?php if($row[2]=="Sao Tome and Principe"){ echo "selected";} ?>>Sao Tome and Principe</option> 
<option value="Saudi Arabia" <?php if($row[2]=="Afghanistan"){ echo "selected";} ?>>Saudi Arabia</option> 
<option value="Senegal" <?php if($row[2]=="Senegal"){ echo "selected";} ?>>Senegal</option> 
<option value="Serbia and Montenegro" <?php if($row[2]=="Serbia and Montenegro"){ echo "selected";} ?>>Serbia and Montenegro</option> 
<option value="Seychelles" <?php if($row[2]=="Seychelles"){ echo "selected";} ?>>Seychelles</option> 
<option value="Sierra Leone" <?php if($row[2]=="Sierra Leone"){ echo "selected";} ?>>Sierra Leone</option> 
<option value="Singapore" <?php if($row[2]=="Singapore"){ echo "selected";} ?>>Singapore</option> 
<option value="Slovakia" <?php if($row[2]=="Slovakia"){ echo "selected";} ?>>Slovakia</option> 
<option value="Slovenia" <?php if($row[2]=="Slovenia"){ echo "selected";} ?>>Slovenia</option> 
<option value="Solomon Islands" <?php if($row[2]=="Solomon Islands"){ echo "selected";} ?>>Solomon Islands</option> 
<option value="Somalia" <?php if($row[2]=="Somalia"){ echo "selected";} ?>>Somalia</option> 
<option value="South Africa" <?php if($row[2]=="South Africa"){ echo "selected";} ?>>South Africa</option> 
<option value="South Georgia and The South Sandwich Islands" <?php if($row[2]=="South Georgia and The South Sandwich Islands"){ echo "selected";} ?>>South Georgia and The South Sandwich Islands</option> 
<option value="Spain" <?php if($row[2]=="Spain"){ echo "selected";} ?>>Spain</option> 
<option value="Sri Lanka" <?php if($row[2]=="Sri Lanka"){ echo "selected";} ?>>Sri Lanka</option> 
<option value="Sudan" <?php if($row[2]=="Sudan"){ echo "selected";} ?>>Sudan</option> 
<option value="Suriname" <?php if($row[2]=="Suriname"){ echo "selected";} ?>>Suriname</option> 
<option value="Svalbard and Jan Mayen" <?php if($row[2]=="Svalbard and Jan Mayen"){ echo "selected";} ?>>Svalbard and Jan Mayen</option> 
<option value="Swaziland" <?php if($row[2]=="Swaziland"){ echo "selected";} ?>>Swaziland</option> 
<option value="Sweden" <?php if($row[2]=="Sweden"){ echo "selected";} ?>>Sweden</option> 
<option value="Switzerland" <?php if($row[2]=="Switzerland"){ echo "selected";} ?>>Switzerland</option> 
<option value="Syrian Arab Republic" <?php if($row[2]=="Syrian Arab Republic"){ echo "selected";} ?>>Syrian Arab Republic</option> 
<option value="Taiwan, Province of China" <?php if($row[2]=="Taiwan, Province of China"){ echo "selected";} ?>>Taiwan, Province of China</option> 
<option value="Tajikistan" <?php if($row[2]=="Tajikistan"){ echo "selected";} ?>>Tajikistan</option> 
<option value="Tanzania, United Republic of" <?php if($row[2]=="Afghanistan"){ echo "selected";} ?>>Tanzania, United Republic of</option> 
<option value="Thailand" <?php if($row[2]=="Thailand"){ echo "selected";} ?>>Thailand</option> 
<option value="Timor-leste" <?php if($row[2]=="Timor-leste"){ echo "selected";} ?>>Timor-leste</option> 
<option value="Togo" <?php if($row[2]=="Togo"){ echo "selected";} ?>>Togo</option> 
<option value="Tokelau" <?php if($row[2]=="Tokelau"){ echo "selected";} ?>>Tokelau</option> 
<option value="Tonga" <?php if($row[2]=="Tonga"){ echo "selected";} ?>>Tonga</option> 
<option value="Trinidad and Tobago" <?php if($row[2]=="Trinidad and Tobago"){ echo "selected";} ?>>Trinidad and Tobago</option> 
<option value="Tunisia" <?php if($row[2]=="Tunisia"){ echo "selected";} ?>>Tunisia</option> 
<option value="Turkey" <?php if($row[2]=="Turkey"){ echo "selected";} ?>>Turkey</option> 
<option value="Turkmenistan" <?php if($row[2]=="Turkmenistan"){ echo "selected";} ?>>Turkmenistan</option> 
<option value="Turks and Caicos Islands" <?php if($row[2]=="Turks and Caicos Islands"){ echo "selected";} ?>>Turks and Caicos Islands</option> 
<option value="Tuvalu" <?php if($row[2]=="Tuvalu"){ echo "selected";} ?>>Tuvalu</option> 
<option value="Uganda" <?php if($row[2]=="Uganda"){ echo "selected";} ?>>Uganda</option> 
<option value="Ukraine" <?php if($row[2]=="ukraine"){ echo "selected";} ?>>Ukraine</option> 
<option value="United Arab Emirates" <?php if($row[2]=="Afghanistan"){ echo "selected";} ?>>United Arab Emirates</option> 
<option value="United Kingdom" <?php if($row[2]=="United Kingdom"){ echo "selected";} ?>>United Kingdom</option> 
<option value="United States" <?php if($row[2]=="United States"){ echo "selected";} ?>>United States</option> 
<option value="United States Minor Outlying Islands" <?php if($row[2]=="United States Minor Outlying Islands"){ echo "selected";} ?>>United States Minor Outlying Islands</option> 
<option value="Uruguay" <?php if($row[2]=="Uruguay"){ echo "selected";} ?>>Uruguay</option> 
<option value="Uzbekistan" <?php if($row[2]=="Uzbekistan"){ echo "selected";} ?>>Uzbekistan</option> 
<option value="Vanuatu" <?php if($row[2]=="Vanuatu"){ echo "selected";} ?>>Vanuatu</option> 
<option value="Venezuela" <?php if($row[2]=="venezuela"){ echo "selected";} ?>>Venezuela</option> 
<option value="Viet Nam" <?php if($row[2]=="Viet Nam"){ echo "selected";} ?>>Viet Nam</option> 
<option value="Virgin Islands, British" <?php if($row[2]=="Virgin Islands, British"){ echo "selected";} ?>>Virgin Islands, British</option> 
<option value="Virgin Islands, U.S." <?php if($row[2]=="Virgin Islands, U.S."){ echo "selected";} ?>>Virgin Islands, U.S.</option> 
<option value="Wallis and Futuna" <?php if($row[2]=="Wallis and Futuna"){ echo "selected";} ?>>Wallis and Futuna</option> 
<option value="Western Sahara" <?php if($row[2]=="Western Sahara"){ echo "selected";} ?>>Western Sahara</option> 
<option value="Yemen" <?php if($row[2]=="Yemen"){ echo "selected";} ?>>Yemen</option> 
<option value="Zambia" <?php if($row[2]=="Zambia"){ echo "selected";} ?>>Zambia</option> 
<option value="Zimbabwe" <?php if($row[2]=="Zimbabwe"){ echo "selected";} ?>>Zimbabwe</option>
</select>
                </td></tr>
             <tr><td>
                
                <label class="city">
                <span>City:</span></label></td><td>
                <?php //echo $row[3]; ?>
               <select name="city" id="city" style="width:235px;height:26px;border:1px #ac0404 solid;">
                <?php
				//echo $row[3];
				//echo "select * from city where name<>'' order by name ASC";
				 $city=mysql_query("select * from city where name<>'' order by name ASC");
				
				while($city1=mysql_fetch_array($city)){
				?>
                <option value="<?php echo $city1[0]; ?>"<?php if($row[3]==$city1[0]){ ?> selected<?php } ?>><?php echo $city1[0]; ?></option>
                <?php } ?>
                </select>
                
                </td></tr>
                <tr><td>
                                 
                <label class="cn">
                <span>Telephone No.:</span></label></td><td>
                <input id="cn" name="cn" type="text" value="<?php echo $row[5]; ?>">
              </td></tr>
              <tr><td>
                                 
                <label class="cn">
                <span>Mobile No.:</span></label></td><td>
                <input id="mobile" name="mobile" type="text" value="<?php echo $row[6]; ?>">
              </td></tr>
              <tr><td>
                 
                <label class="gender">
                <span> Gender: </span></label></td>
                <td>
                <font color="#000"> Male: </font><input name="gen" id="gen" type="radio"  <?php if($row[11]=="Male"){ echo "checked='checked'"; } ?> value="Male" style="width:20px;"/>
                <font color="#000"> Female: </font><input name="gen" id="gen" type="radio" <?php if($row[11]=="Female"){ echo "checked='checked'"; } ?> value="Female" style="width:20px;"/>
                
                </td></tr>
                <tr><td>
                
                <label class="Email">
              <span> Email:</span></label></td><td>
                <input id="email" name="email" type="text" value="<?php echo $row[7]; ?>">
               </td></tr>
               <tr><td>           
                                
                <label class="category">
                <span>Category:</span></label></td><td>
                <select name="cat" id="cat" style="width:235px;height:26px;border:1px #ac0404 solid;">
                <?php $ca=mysql_query("select * from category where name<>'' order by name ASC");
                while($ca1=mysql_fetch_row($ca)){ ?>
                            
                <option value="<?php echo $ca1[0]; ?>" <?php if($ca1[0]==$row[8]){ echo "selected"; } ?>><?php echo $ca1[0]; ?></option>
                <?php } ?>
                </select>
             </td></tr>
             <tr><td>
                
                <label class="spl">
                <span>Specialist In:</span></label></td><td>
               
                <select name="spl" id="spl" style="width:235px;height:26px;border:1px #ac0404 solid;" onChange="addThem1()">

                <?php $sp=mysql_query("select UPPER(name) from special where name<>'' order by name ASC");
                while($sp1=mysql_fetch_row($sp)){ ?>
                            
                <option value="<?php echo $sp1[0]; ?>" <?php if($sp1[0]==$row[9]){ echo "selected"; } ?>><?php echo $sp1[0]; ?></option>
                <?php } ?>
                </select>
                </td></tr>
                <tr><td>
                
                <label class="add">
                <span>Remarks:</span></label></td><td>
                <textarea name="rem" cols="27" rows="3" style="resize:none;border:1px #ac0404 solid;"><?php echo $row[10]; ?></textarea>
             </td></tr>
                <tr><td >
                
<input type="hidden" name="tp" value="<?php if(isset($_GET['link'])){ echo $_GET['link']; }else{ echo ""; } ?>">
                <button class="submit formbutton" type="submit">Submit</button>
                      </td><td> 
                <button class="submit formbutton" type="button" onClick="<?php if(isset($_GET['link'])){ ?> window.close() <?php }else { ?>javascript:location.href = 'view_doctor.php';<?php } ?>">Cancel</button>
                       </td></tr></table>
                </fieldset>
          </form>
          </fieldset>
         </div>
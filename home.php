<!DOCTYPE html>
<html lang="en-US">

<!-- ========================================================================= -->

<head>
<!-- Latest compiled and minified CSS -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="js/dist/jquery.validate.js"></script>
<script>
  $.validator.setDefaults({
    submitHandler: function() {
      alert("submitted!");
    }
  });

  $().ready(function() {
    // validate the comment form when it is submitted
    $("#FHCOsignup").validate();
    $("#FHCOsignup").removeAttr("novalidate");

    // validate signup form on keyup and submit
  
  });
  </script>
<script src="js/validation.js"></script>
  <link rel="stylesheet" href="css/screen.css">

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   <link rel="stylesheet" type="text/css" href="css/home.css">

    <meta charset="UTF-8">
    
    <title>FHCO Class/Event Registration</title>
    
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js">
    </script>
    <![endif]-->
    
    <style>
        body {
            font-family:Verdana,sans-serif;font-size:0.8em;
            }
        div#header,div#footer {
            border:1px solid grey;
            margin:5px;margin-bottom:15px;padding:8px;
            background-color:white;
            }
        div#content {
            background-color:#ddd;
            }
        legend {
            font-weight: bold;
            padding-left: 5px;
            padding-right: 5px;
            }
    </style>
    
    <?php
        #Using include to run the code in this page grants access to the database
        include ("dbaccess.php"); 
    ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <script>
window.onload = function() {
  var recaptcha = document.forms["FHCOsignup"]["g-recaptcha-response"];
  recaptcha.required = true;
  recaptcha.oninvalid = function(e) {
    // do something
    alert("Please complete the captcha");
  }
}



</script>


</head>

<!-- ========================================================================= -->

    <body id="body">

    <?php
        #Create a 'find all' command for the specified table layout
        $findCommand =& $fm->newFindAllCommand('RegInput_1_CWP');
        #Execute the command and store the result
        $result = $findCommand->execute();
        #Check for an error
        if (FileMaker::isError($result)) {
            echo "<p>Error: " . $result->getMessage() . "</p>";
            exit;
        }
        
        #Store the matching records
        $records = $result->getRecords();
        #Retrieve and store the record_id of the active record
        $record = $records[0];
        $active_id =  $record->getField('zz_RecordID_c');
        
        #* To get the name of the active record, we perform another find
        # on the specified layout using the $active_id.
        
        #Create a 'find new' command for the specified table layout
        $findCommand =& $fm->newFindCommand('RegInput_1_CWP');
        #Specify the field and value to match against.
        $findCommand->addFindCriterion('zz_RecordID_c', $active_id);
        #Perform the find
        $result = $findCommand->execute();
        #Check for an error
        if (FileMaker::isError($result)) {
            echo "<p>Error: " . $result->getMessage() . "</p>";
            exit;
        }
        
        #Store the matching record
        $records = $result->getRecords();
        $record = $records[0];
        
        #Display the Record ID on the web page
        #echo "<p>FileMaker Internal Record ID: " . $record->getField('zz_RecordID_c') . "</p>"; 
    ?>

        <table>
          <tr>
             <td>&nbsp;&nbsp;</td>
             <td>
             <?php
             //CONTAINER IMAGE
             // Find the record
             #$request = $fm->newFindAllCommand('RegInput_1_CWP');
             #$result = $request->execute();
             #$record = $result->getFirstRecord();
             #Display the internally stored container file.
             #echo 'Internally Stored File<br>Path: ' . $record->getField('ImageLogo') . '<br>';
             echo '<img src="containerBridge.php?path=' . urlencode($record->getField('O_ImageLogo_cu')) . '" />';
             #echo '<p>';
             #echo 'Externally Stored File<br>Path: ' . $fm->getContainerDataURL($record->getField('ImageLogo')) . '<br>';
             #echo '    <img src="containerBridge.php?path=' . $fm->getContainerDataURL(urlencode($record->getField('ImageLogo'))) . '">';
             ?>
             </td>
             <td>&nbsp;</td>
             <td style="text-align: center">
             <h1>FHCO Event Registration</h1>
             <hr />
             <span style="font-style: italic">Please choose an event to register for and fill out the required fields below.</span>
             <br>
             <br>
             </td>
             <td>&nbsp;</td>
          </tr>
        </table>

        <form action="handle_form.php" id="FHCOsignup" name="FHCOsignup" method="post">

            <fieldset>
            <legend>Available Classes/Events:</legend>
            Class/Event Pre-Registration Deadline: 1 day before the Class/Event Occurs.<br><br>
            <?php
                //Get value list from the layout as HTML radio buttons.
                //get the layout
                $layout =& $fm->getLayout('RegInput_1_CWP');
                //get the desired value list (in this case, 'prefixes')
                $values = $layout->getValueList('Classes');
               echo "<select id='ClassSelect' name = 'ClassSelect' required>";
                echo "<option value= ''>" . "select..." . "</option>";
                foreach($values as $value) 
                {
                //display each option from the value list as a radio button
                echo "<option value= '". $value . "''>" . $value . "</option>";
                }
                echo "</select>";
            ?>
            </fieldset>

            <br>

            <fieldset>
            <legend>Required Personal Information:</legend>
            <table>
            
            <tr>

               <td>
               First Name*:</td><td><input required name="NameFirst" id='NameFirst' type="text" size="32" style="padding-left:5px;" />
               Middle Initial:<input required name="NameMiddle" id='NameMiddle' type="text" size="2" style="padding-left:5px;" />
               Last Name*:<input required name="NameLast" id='NameLast' type="text" size="32" style="padding-left:5px;" />
               </td>
            </tr>
            <tr>
               <td>
               Email Address*:</td><td><input required name="Email" id="Email" type="email" size="32" style="padding-left:5px;" />
               Verify Email*:<input required name="EmailVerify" id="EmailVerify"  type="email" size="32" style="padding-left:5px;" oninput="check(this)" />
               </td>
            </tr>
            </table>
            </fieldset>

            <br />

            <fieldset>
            <legend>Additional Personal Information:</legend>
               <label for="Company">Company Name:</label><input name="Company" type="text" size="32" style="padding-left:5px;" />
                <label for="JobTitle">Job Title:</label><input name="JobTitle" type="text" size="32" style="padding-left:5px;" />
               <br> <br>
                <label for="website">Website:</label><input name="website" type="url"  size="50" style="padding-left:5px;" />
               <br>  <br>
                <label for="PhoneHomeAC">Home Phone:</label><input name="PhoneHomeAC" type="text" size=4 maxlength=3 style="padding-left:5px;" />-
               <input name="PhoneHomePrefix" type="text" size=4 maxlength=3 style="padding-left:5px;" />-
               <input name="PhoneHomeSuffix" type="text" size=5 maxlength=4 style="padding-left:5px;" />
                <label for="PhoneWorkAC">Work Phone:</label><input name="PhoneWorkAC" type="text" size=4 maxlength=3 style="padding-left:5px;" />
               <input name="PhoneWorkPrefix" type="text" size=4 maxlength=3 style="padding-left:5px;" />
               <input name="PhoneWorkSuffix" type="text" size=5 maxlength=4 style="padding-left:5px;" />
               <br><br>
               <label for="AddressStreet">Street Address:</label><input name="AddressStreet" type="text" size="32" style="padding-left:5px;" />
               Unit:<input name="AddressUnit" type="text" size="10" style="padding-left:5px;" />
               <br><br>
               <label for="AddressCity">City:</label><input name="AddressCity" type="text" size="32" style="padding-left:5px;" />
               <label for="AddressState">State:</label> 
               
               <select name="AddressState" >
                <option value="">Select...</option>
  <option value="AL">Alabama</option>
  <option value="AK">Alaska</option>
  <option value="AZ">Arizona</option>
  <option value="AR">Arkansas</option>
  <option value="CA">California</option>
  <option value="CO">Colorado</option>
  <option value="CT">Connecticut</option>
  <option value="DE">Delaware</option>
  <option value="DC">District Of Columbia</option>
  <option value="FL">Florida</option>
  <option value="GA">Georgia</option>
  <option value="HI">Hawaii</option>
  <option value="ID">Idaho</option>
  <option value="IL">Illinois</option>
  <option value="IN">Indiana</option>
  <option value="IA">Iowa</option>
  <option value="KS">Kansas</option>
  <option value="KY">Kentucky</option>
  <option value="LA">Louisiana</option>
  <option value="ME">Maine</option>
  <option value="MD">Maryland</option>
  <option value="MA">Massachusetts</option>
  <option value="MI">Michigan</option>
  <option value="MN">Minnesota</option>
  <option value="MS">Mississippi</option>
  <option value="MO">Missouri</option>
  <option value="MT">Montana</option>
  <option value="NE">Nebraska</option>
  <option value="NV">Nevada</option>
  <option value="NH">New Hampshire</option>
  <option value="NJ">New Jersey</option>
  <option value="NM">New Mexico</option>
  <option value="NY">New York</option>
  <option value="NC">North Carolina</option>
  <option value="ND">North Dakota</option>
  <option value="OH">Ohio</option>
  <option value="OK">Oklahoma</option>
  <option value="OR">Oregon</option>
  <option value="PA">Pennsylvania</option>
  <option value="RI">Rhode Island</option>
  <option value="SC">South Carolina</option>
  <option value="SD">South Dakota</option>
  <option value="TN">Tennessee</option>
  <option value="TX">Texas</option>
  <option value="UT">Utah</option>
  <option value="VT">Vermont</option>
  <option value="VA">Virginia</option>
  <option value="WA">Washington</option>
  <option value="WV">West Virginia</option>
  <option value="WI">Wisconsin</option>
  <option value="WY">Wyoming</option>
</select>       
               
              <label for="AddressZip">ZIP Code:</label><input name="AddressZip" type="text" size="10" style="padding-left:5px;" />
               <br><br>
                <label for="AddressCountry">Country:</label>
        <select name="AddressCountry" id="select_catalog">
<option value="">Select...</option>
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Canary Islands">Canary Islands</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Channel Islands">Channel Islands</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Island">Cocos Island</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote DIvoire">Cote D'Ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Ter">French Southern Ter</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Malawi">Malawi</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Midway Islands">Midway Islands</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherland Antilles">Netherland Antilles</option>
<option value="Netherlands">Netherlands (Holland, Europe)</option>
<option value="Nevis">Nevis</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Republic of Montenegro">Republic of Montenegro</option>
<option value="Republic of Serbia">Republic of Serbia</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="St Maarten">St Maarten</option>
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City State">Vatican City State</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
<option value="Wake Island">Wake Island</option>
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
        </select>
            </fieldset>

            <br />


            <br />
<input type="text" id="paid" name="paid" readonly>
 <div class= "paymentdiv">
  <label for="amountpaid"><h4>Payment Amount ($):<h4></label><input type="text" id="amountpaid" name="amountpaid" readonly>
</div> 
<br>
            <div style="text-align:center">

              <div class="g-recaptcha" data-sitekey="6Lf-VhoTAAAAAIi9i9yD7Mwmx_j3zWpzL_DwYvOw"></div>

<br>
            <input  type="hidden" name="active_id" value="<?php echo $_POST['active_id']; ?>" >
            <input class="buttons" type="submit" name="submit" value= "Submit" />
            <input class="buttons" type="reset" value="Reset" />

            </div>

</form>
<script>
$( document ).ready(function() {
      var str = $( "#ClassSelect" ).val(); 
    var n = str.search("\\\$");
    if (n > -1){
   $('#paid').val('paid');
str = str.substring(str.indexOf("$") + 1);
$('#amountpaid').val(str);
    }
else{
     $('#paid').val('unpaid');
      $('#amountpaid').val(0);
}
    ;
 
});

$( "#ClassSelect" ).change(function() {
  
    var str = $( "#ClassSelect" ).val(); 
    var n = str.search("\\\$");
    if (n > -1){
   $('#paid').val('paid');

str = str.substring(str.indexOf("$") + 1);
$('#amountpaid').val(str);
    }
else{
     $('#paid').val('unpaid');
     $('#amountpaid').val(0);
}
    ;
 
});


 function check(input) {
        if (input.value != document.getElementById('Email').value) {
            input.setCustomValidity('Email must be matching.');
        } else {
            // input is valid -- reset the error message
            input.setCustomValidity('');
        }
    }


    $(function() {
  $("input").keyup(function() {
        $(this).val($(this).val().replace(/[&]/g, "and"));
        $(this).val($(this).val().replace(/[%$()]/g, ""));
  });
});

    $(".selector").validate({
  rules: {
    name: "required",
    email: {
      required: true,
      email: true
    }
  },
  messages: {
    name: "Please specify your name",
    email: {
      required: "We need your email address to contact you",
      email: "Your email address must be in the format of name@domain.com"
    }
  }
});

</script>

    </body>

<!-- ========================================================================= -->

</html>

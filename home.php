<!DOCTYPE html>

<html>
<head>
    <script src='https://www.google.com/recaptcha/api.js'></script>
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<!-- Latest compiled and minified CSS -->
<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Bootstrap -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="js/dist/jquery.validate.js"></script>
<script>

  $.validator.setDefaults({
    submitHandler: function() {
     ("#FHCOsignup").submit();
    }
  });

  $().ready(function() {
    // validate the comment form when it is submitted
    $("#FHCOsignup").validate();
    $("#FHCOsignup").removeAttr("novalidate");

    // validate signup form on keyup and submit
  
  });
  </script>

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
    

    
    <?php
        #Using include to run the code in this page grants access to the database
        include ("dbaccess.php"); 
    ?>


    <script>
 window.onload = function() {
   var recaptcha = document.forms["FHCOsignup"]["g-recaptcha-response"];
   recaptcha.required = true;
   recaptcha.oninvalid = function(e) {
     // do something
     alert("Please complete the captcha by checking the box which says 'I am not a robot'.");
   }
 }



</script>


</head>
  <body>
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

             
       <img id = 'logo' src = 'img/FHCO_logo.png'/><br><br><br>
       <hr>
             <h1> FHCO Event Registration</h1>
           
             <hr />
             <div class= "wrap">
             <div class = "content">
               <div class="row">
                <div class="col-md-8 col-lg-offset-2"> 
             <span style="font-style: italic">Please choose an event to register for and fill out the required fields below.</span>
            </div>
             </div>
             <br>
             <br>
     

    <form action="checkout.php" id="FHCOsignup" name="FHCOsignup" method="post">
  <div class="row">
                <div class="col-md-8 col-lg-offset-2"> 
          <fieldset>
            <legend>Available Classes/Events:</legend>

            Class/Event Pre-Registration Deadline: 1 day before the Class/Event Occurs.<br><br>
           
            <?php
                //Get value list from the layout as HTML radio buttons.
                //get the layout
                $layout =& $fm->getLayout('RegInput_1_CWP');
                //get the desired value list (in this case, 'prefixes')
                $values = $layout->getValueList('Classes');
               echo "<select style = 'min-width: 290px !important;' id='ClassSelect' name = 'ClassSelect' required>";
                echo "<option value= ''>" . "select..." . "</option>";
                foreach($values as $value) 
                {
                //display each option from the value list as a radio button
                echo "<option value= '". $value . "''>" . $value . "</option>";
                }
                echo "</select>";
            ?>
            </fieldset>
            </div></div>
               <br>

            <fieldset>
              <div class="row">
                <div class="col-md-8 col-lg-offset-2"> 
            <legend>Required Personal Information:</legend>
      
            </div>
          </div>
           

               <div class="row">

               <div class="col-md-4 col-lg-offset-2"> <label for="NameFirst">First Name*:&nbsp;</label><input required name="NameFirst" id='NameFirst' type="text" size="32" style="padding-left:5px;" />
                </div>
<div class="col-md-4"><label for="NameMiddle">Middle Initial:&nbsp; </label><input name="NameMiddle" id='NameMiddle' type="text" size="2" style="padding-left:5px;" />
          </div>
               </div>
               <div class="row">

              
              <div class="col-md-4 col-lg-offset-2">  <label for="NameLast">Last Name*:&nbsp; </label><input required name="NameLast" id='NameLast' type="text" size="32" style="padding-left:5px;" />
           </div>
           </div>
<div class="row">

              <div class="col-md-4 col-lg-offset-2">  <label for="Email">Email:&nbsp;</label><input required name="Email" id="Email" type="email" size="32" style="padding-left:5px;" />
              </div><div class="col-md-4"> <label for="EmailVerify">Verify Email*:&nbsp; </label><input required name="EmailVerify" id="EmailVerify"  type="email" size="32" style="padding-left:5px;" oninput="check(this)" />
               </div>
               </div>
         
            </fieldset>


            <br />

            <fieldset>
               <div class="row">
                <div class="col-md-8 col-lg-offset-2"> 
            <legend>Additional Personal Information:</legend>
          </div></div>
            <div class="row">

             <div class="col-md-4 col-lg-offset-2">  <label for="Company">Company Name:&nbsp; </label><input name="Company" type="text" size="32" style="padding-left:5px;" />
                </div>
              <div class="col-md-4">  <label for="JobTitle">Job Title:&nbsp; </label><input name="JobTitle" type="text" size="32" style="padding-left:5px;" />
               </div></div>
           <br>
            <div class="row">
                <div class="col-md-4 col-lg-offset-2">
                <label for="website">Website:&nbsp;</label><input name="website" type="url"  size="50" style="padding-left:5px;" />
              </div>
              </div>
               <br>  
                <div class="row">
                  <div class="col-md-4 col-lg-offset-2">
                <label for="PhoneHomeAC">Home Phone:&nbsp;</label><input name="PhoneHomeAC" type="text" size=4 maxlength=3 style="padding-left:5px;" />-
               <input name="PhoneHomePrefix" type="text" size=4 maxlength=3 style="padding-left:5px;" />-
               <input name="PhoneHomeSuffix" type="text" size=5 maxlength=4 style="padding-left:5px;" />
             </div>
              <div class="col-md-4">
                <label for="PhoneWorkAC">Work Phone:&nbsp;</label><input name="PhoneWorkAC" type="text" size=4 maxlength=3 style="padding-left:5px;" />-
               <input name="PhoneWorkPrefix" type="text" size=4 maxlength=3 style="padding-left:5px;" />-
               <input name="PhoneWorkSuffix" type="text" size=5 maxlength=4 style="padding-left:5px;" />
              </div>
               </div>
               <br>
                <div class="row">
                  <div class="col-md-4 col-lg-offset-2">
               <label for="AddressStreet">Street Address:&nbsp;</label><input name="AddressStreet" type="text" size="32" style="padding-left:5px;" />
              </div><div class="col-md-4"><label for="AddressUnit">Unit:&nbsp;</label><input name="AddressUnit" id=="AddressUnit" type="text" size="10" style="padding-left:5px;" />
              </div>
              </div>
               <br>
                <div class="row">
                  <div class="col-md-4 col-lg-offset-2">
               <label for="AddressCity">City:&nbsp;</label><input name="AddressCity" type="text" size="32" style="padding-left:5px;" /></div>
               <div class="col-md-3"><label for="AddressState">State:&nbsp;</label> 
               
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
</select>       </div>
               <div class="col-md-3">
              <label for="AddressZip">ZIP Code:&nbsp;</label><input name="AddressZip" type="text" size="10" style="padding-left:5px;" />
               </div>
               </div>
               <br>
                <div class="row">
                  <div class="col-md-4 col-lg-offset-2">
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
      </div>
      </div>
            </fieldset>

             <br />

            <br />
<input type="text" id="paid" name="paid" readonly>
 <div class= "paymentdiv">
  <h4><label for="amountpaid">Payment Amount ($):</label></h4><br><input type="text" id="amountpaid" name="amountpaid" readonly>
</div> 
<br>
            <div style="text-align:center">

      <div class="g-recaptcha" data-sitekey="6Lf-VhoTAAAAAIi9i9yD7Mwmx_j3zWpzL_DwYvOw"></div>

<br>
            <input  type="hidden" name="active_id" value="<?php echo $_POST['active_id']; ?>" >
            <input class="buttons" type="submit" name="submit" value= "Submit" />

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
  $("input").change(function() {
        $(this).val($(this).val().replace(/[&]/, "and"));
        $(this).val($(this).val().replace(/[%$()]/, ""));
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

$("#EmailVerify").change(function(){
    if ($("#Email").val() == $("#EmailVerify").val()) {
        $("#EmailVerify").css("background-color","white");
    }
      if ($("#Email").val() != $("#EmailVerify").val()) {
        $("#EmailVerify").css("background-color"," #ffcccc");

    }
});

</script>
</div>
</div>
  </body>
</html>

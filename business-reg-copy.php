   <html>
    <?php
    session_start();
    if (isset($_POST['submit_btn'])) {
	
         $category = $_POST['radio1'];
        $description = $_POST["description"];
        $website = $_POST["website"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwords = md5($password);
        $company_name = $_POST["company_name"];
        $country = $_POST["country"];
        $phone = $_POST["phone"];
        $country_code = $_POST["country_code"];
        
        if (empty($description)) {
            $error_description = "Enter description";
        }
        if (empty($website)) {
            $error_website = "Enter website";
        }
        if (empty($email)) {
            $error_email = "Enter email";
        }
        if (empty($password)) {
            $error_passwords = "Enter password";
        }
        if (empty($company_name)) {
            $error_company_name = "Enter company name";
        }
        if (empty($country)) {
            $error_country = "Select country";
        }
        
        if (empty($phone)) {
            $error_phone = "Enter phone number";
        }
       
        if (!empty($description) && !empty($website) && !empty($email) && !empty($password) && !empty($company_name) && !empty($country) && !empty($phone)) {
            require './dbcon.php';
            $fetch_email = "SELECT `email` FROM `business` WHERE email = '$email'";
            $query = mysqli_query($conn, $fetch_email);
            if (mysqli_num_rows($query) > 0) {
                ?>
              <script> alert('Already exist email')</script>
            <?php
            } else {


                $random_number = rand(1000000, 9999999);
                $expireAfter = 2;
                $_SESSION['otp'] = $random_number;
                require_once './dbcon.php';
                $unique = "select(email) from otp_verfication where email ='" . $owner_email . "'";
                $res = mysqli_query($conn, $unique);
                if (mysqli_num_rows($res) == 1) {
                    echo "Already exist";
                } else {
                    $email = $_POST["email"];
                    $subject = "Petbooq verification Business";
                    $message = "<body style='width:100%;background-color:#b5b5b5;margin:0;padding:0;'>
<div style='width: 680px;margin:0 auto;font-family:arial;box-sizing: border-box;'>
<div style='width:100%;background-color:#fff;padding: 15px;box-sizing: border-box;border: 20px solid #b5b5b5;box-sizing: border-box;'>
<div style='display:inline-block;width:100%;box-sizing:border-box;border-bottom:1px solid #ccccce;margin-bottom: 12px;'>
<div style='float:left;'><img src='http://petbooq.com/images/logo.jpg'/></div>
<div style='float:right;'>
<a href='http://www.petbooq.com' style='display:inline-block;margin-top:15px;text-decoration:none;color:#000;font-size:13px;text-transform:uppercase;font-weight:bold;'>//petbooq.com</a>
</div>
</div>
<div style='display:inline-block;width:100%;text-align:center;'>
<div style='float:left;width:100%;'><img src='http://petbooq.com/images/mailer-banner.jpg' style=''/></div>
</div>
<div style='width:100%;display:inline-block;'>
<div style='display:inline-block;padding: 0px;width:100%;background:#fff;margin-bottom:0px;box-sizing: border-box;'>
<div style='display:inline-block;width:100%;box-sizing:border-box;padding: 0 150px'>
<div style='display:inline-block;width:100%;font-size:17px;color:#6e6f73;line-height:34px;font-weight:bold;margin-top:10px;'>
You recently registred for Petbooq.$company_name
</div>
<p style='display:inline-block;width:100%;font-size: 12px;color:#6e6f73;line-height:25px;margin: 0px 0 15px;'>
<div style='color: #6e6f73;'>Thanks</div>
<div style='color: #6e6f73;'>The Petbooq Team.</div>
</p>
<div style='display:inline-block;width:100%;'>
<div style='display:inline-block;width:100%;padding:5px 0;background-color:#6d6e72;color:#fff;text-transform:uppercase;font-size:23px;text-decoration:none;text-align:center;font-weight:bold;'>".$_SESSION['otp']."</div>
</div>
</div>
</div>
</div>
<div style='display:inline-block;width:100%;border-top:1px solid #ccc;padding-top:15px;margin-top:15px;'>
<div style='float:left;'>
<a href='http://www.petbooq.com' style='display:inline-block;font-size:12px;text-decoration:none;color:#000;'>petbooq.com</a>
<span style='display:inline-block;margin: 0 5px;font-size:12px;color:#000;'>|</span>
<a href='mailto:pets@petbooq.com' style='display:inline-block;font-size:12px;text-decoration:none;color:#000;'>pets@petbooq.com  </a>
</div>
<div style='float:right;'>
<ul style='display:inline-block;padding: 0px;width:100%;margin:0;'>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://www.facebook.com/petbooq'><img src='http://petbooq.com/images/social-icon1.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://www.instagram.com/petbooq/'><img src='http://petbooq.com/images/social-icon2.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://twitter.com/petbooq'><img src='http://petbooq.com/images/social-icon3.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://in.pinterest.com/petbooq/'><img src='http://petbooq.com/images/social-icon4.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://plus.google.com/u/1/113913416342083840664'><img src='http://petbooq.com/images/social-icon5.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://www.tumblr.com/blog/petbooq1'><img src='http://petbooq.com/images/social-icon6.png' style=''/></a></li>
</ul>
</div>
</div>
</div>
</div>
</body>
";
                    $header = "<h2>PetbooQ Account Verification</h2>";
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: Petbooq<Petbooq@gmail.com>' . "\r\n";
                    mail($email, $subject, $message, $headers);
                    require_once './dbcon.php';
                    $otp_verification = "Insert into otp_verfication(otp,email,createdOn) value (" . $_SESSION['otp'] . ",'$email',NOW())";
                    mysqli_query($conn, $otp_verification);
                    echo "New record insert sucessfully";
                    echo 'Message has been sent';
                    
                   
                    $_SESSION['description'] = $description;
                    $_SESSION['website'] = $website;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $passwords;
                    $_SESSION['company_name'] = $company_name;
                    $_SESSION['country'] = $country;
                    $_SESSION['phone_number'] = $phone;
                    $_SESSION['country_code'] = $country_code;
                    $_SESSION['category'] = $category;
                    
                   
                    header("Location:otp_verification_business.php");
//                    }
                }
            }
        }
    }
    ?>
    <?php require_once 'inc/head-content-bus.php'; ?>
    <body class='reg-class'>
    <?php require_once 'inc/header_11.php'; ?>
        <div class="main-content reg-business-page">
            <div class="main-content-inn">
                <form action="" method="post">  
                    
                    <div class="reg-right-sec">
                        <div class="acc-sec-top">
                            <p>Goods or Sevices</p>
                            <h1>Create a new account</h1>
                            <p>It's free and always will be.</p>
                        </div>
                        <div class="reg-form-sec">
			  <div class="pt-dt">
                            <h2 class="heading">Company Details</h2>
                                <div class="reg-f-row form-row">		
                                    <label>Company name</label> 
                                    <input type="text" placeholder="Company name" name="company_name"/>
                                    <?php
                                    if (empty($_POST["company_name"])) {
                                        echo "<p style='color:red'>" . $error_company_name . "</p>";
                                    }
                                    ?>
                                </div>
                                	
                                <div class="reg-f-row form-row">
                                    <label>Category</label> 
                                    <select name="radio1" id="radio1">
                                        <option value="Pet Food">Pet Food</option>
                                        <option value="Accessories">Accessories</option>
                                        <option value="Veteran">Veteran</option>
                                        <option value="Fashion">Fashion</option>
                                        <option value="Pet Paathology Lab">Pet Paathology Lab</option>
                                        <option value="Pet Traders">Pet Traders</option>
                                        <option value="Breeders">Breeders</option>
                                        <option value="Ambulance">Ambulance</option>
                                        <option value="Other">Other</option>
                                    </select>	
                                </div>	
                                
                                <div class="reg-f-row form-row" id="hide_div" style='display:none;'>
                                    <label>Other type</label>    
                                  <input type="text" name="other_value" id="other-value">  
				</div>
 <script>
       $(document).ready(function() {
       $('#other-value').mouseout(function() {
       var val=$(this).val();
       $('#radio1').append($("<option id='other-val'></option>").attr("value", val).text(val));
       $('#other-val').prop('selected','true');
           //$('#radio1 option[value="other"]').prop('selected','true');
       
       
       });
       
       
       });
       </script>
                                <div class="reg-f-row form-row">
                                    <label>Description</label> 
                                    <textarea placeholder="Description (150 charecter only)" name="description" maxlength='150'/></textarea>
                                    <?php
                                    if (empty($_POST["description"])) {
                                        echo "<p style='color:red'>" . $error_description . "</p>";
                                    }
                                    ?>
                                </div>
                                <div class="reg-f-row form-row">
                                    <label>Website</label> 
                                    <input type="text" placeholder="Website" name="website"/>
                                        <?php
                                        if (empty($_POST["website"])) {
                                            echo "<p style='color:red'>" . $error_website . "</p>";
                                        }
                                        ?>
                                </div>
                                
                                
				<div class="usr-dt">
		            <h2 class="heading">Your Details</h2>
                                <?php
                                if (empty($error_email)) {
                                    echo $error_email;
                                }
                                ?>	
                                <div class="reg-f-row form-row">
                                    <label>Email</label> 
                                    <input type="text" placeholder="Email" name="email"/>
                                        <?php
                                        if (empty($_POST["email"])) {
                                            echo "<p style='color:red'>" . $error_email . "</p>";
                                        }
                                        ?>
                                        <small>Please Enter Your Correct Email, This will be used for login</small>
                                </div>
                                
                                <div class="reg-f-row form-row">
                                    <label>Password</label> 
                                    <input type="password" placeholder="Password" name="password"/>
                                    <?php
                                    if (empty($_POST["password"])) {
                                        echo "<p style='color:red'>" . $error_passwords . "</p>";
                                    }
                                    ?>
                                </div>	
                                </div>	
				<div class="reg-f-row form-row">
                                    <label>Country</label> 
                                    <select name="country">
                                        <option value="">Select country</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antartica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
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
                                        <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Congo">Congo, the Democratic Republic of the</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                                        <option value="Croatia">Croatia (Hrvatska)</option>
                                        <option value="Cuba">Cuba</option>
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
                                        <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="France Metropolitan">France, Metropolitan</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                                        <option value="Holy See">Holy See (Vatican City State)</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran">Iran (Islamic Republic of)</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                                        <option value="Korea">Korea, Republic of</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao">Lao People's Democratic Republic</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macau">Macau</option>
                                        <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia">Micronesia, Federated States of</option>
                                        <option value="Moldova">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
                                        <option value="Saint LUCIA">Saint LUCIA</option>
                                        <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia (Slovak Republic)</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                                        <option value="Span">Spain</option>
                                        <option value="SriLanka">Sri Lanka</option>
                                        <option value="St. Helena">St. Helena</option>
                                        <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syrian Arab Republic</option>
                                        <option value="Taiwan">Taiwan, Province of China</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania, United Republic of</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Viet Nam</option>
                                        <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                        <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                                        <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Yugoslavia">Yugoslavia</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                    <?php
                                    if (empty($_POST["country"])) {
                                        echo "<p style='color:red'>" . $error_country . "</p>";
                                    }
                                    ?>
                                </div>

                            </div>
                            <div class="reg-f-row form-row left-btm-sec">
                                <!-- <label>Phone number</label> -->
								<div class="left">
                                <select name="country_code" id="country"  class="sml">
		                <option data-countryCode="IN" value="91" Selected>+91</option>
				<option data-countryCode="GB" value="44">+44</option>                           
				<option data-countryCode="US" value="1">+1</option>		
				<option data-countryCode="DZ" value="213">+213</option>
				<option data-countryCode="AD" value="376">+376</option>
				<option data-countryCode="AO" value="244">+244</option>
				<option data-countryCode="AI" value="1264">+1264</option>
				<option data-countryCode="AG" value="1268">+1268</option>
				<option data-countryCode="AR" value="54">+54</option>
				<option data-countryCode="AM" value="374">+374</option>
				<option data-countryCode="AW" value="297">+297</option>
				<option data-countryCode="AU" value="61">+61</option>
				<option data-countryCode="AT" value="43">+43</option>
				<option data-countryCode="AZ" value="994">+994</option>
				<option data-countryCode="BS" value="1242">+1242</option>
				<option data-countryCode="BH" value="973">+973</option>
				<option data-countryCode="BD" value="880">+880</option>
				<option data-countryCode="BB" value="1246">+1246</option>
				<option data-countryCode="BY" value="375">+375</option>
				<option data-countryCode="BE" value="32">+32</option>
				<option data-countryCode="BZ" value="501">+501</option>
				<option data-countryCode="BJ" value="229">+229</option>
				<option data-countryCode="BM" value="1441">+1441</option>
				<option data-countryCode="BT" value="975">+975</option>
				<option data-countryCode="BO" value="591">+591</option>
				<option data-countryCode="BA" value="387">+387</option>
				<option data-countryCode="BW" value="267">+267</option>
				<option data-countryCode="BR" value="55">+55</option>
				<option data-countryCode="BN" value="673">+673</option>
				<option data-countryCode="BG" value="359">+359</option>
				<option data-countryCode="BF" value="226">+226</option>
				<option data-countryCode="BI" value="257">+257</option>
				<option data-countryCode="KH" value="855">+855</option>
				<option data-countryCode="CM" value="237">+237</option>
				<option data-countryCode="CA" value="1">+1</option>
				<option data-countryCode="CV" value="238">+238</option>
				<option data-countryCode="KY" value="1345">+1345</option>
				<option data-countryCode="CF" value="236">+236</option>
				<option data-countryCode="CL" value="56">+56</option>
				<option data-countryCode="CN" value="86">+86</option>
				<option data-countryCode="CO" value="57">+57</option>
				<option data-countryCode="KM" value="269">+269</option>
				<option data-countryCode="CG" value="242">+242</option>
				<option data-countryCode="CK" value="682">+682</option>
				<option data-countryCode="CR" value="506">+506</option>
				<option data-countryCode="HR" value="385">+385</option>
				<option data-countryCode="CU" value="53">+53</option>
				<option data-countryCode="CY" value="90392">+90392</option>
				<option data-countryCode="CY" value="357">+357</option>
				<option data-countryCode="CZ" value="42">+42</option>
				<option data-countryCode="DK" value="45">+45</option>
				<option data-countryCode="DJ" value="253">+253</option>
				<option data-countryCode="DM" value="1809">+1809</option>
				<option data-countryCode="DO" value="1809">+1809</option>
				<option data-countryCode="EC" value="593">+593</option>
				<option data-countryCode="EG" value="20">+20</option>
				<option data-countryCode="SV" value="503">+503</option>
				<option data-countryCode="GQ" value="240">+240</option>
				<option data-countryCode="ER" value="291">+291</option>
				<option data-countryCode="EE" value="372">+372</option>
				<option data-countryCode="ET" value="251">+251</option>
				<option data-countryCode="FK" value="500">+500</option>
				<option data-countryCode="FO" value="298">+298</option>
				<option data-countryCode="FJ" value="679">+679</option>
				<option data-countryCode="FI" value="358">+358</option>
				<option data-countryCode="FR" value="33">+33</option>
				<option data-countryCode="GF" value="594">+594</option>
				<option data-countryCode="PF" value="689">+689</option>
				<option data-countryCode="GA" value="241">+241</option>
				<option data-countryCode="GM" value="220">+220</option>
				<option data-countryCode="GE" value="7880">+7880</option>
				<option data-countryCode="DE" value="49">+49</option>
				<option data-countryCode="GH" value="233">+233</option>
				<option data-countryCode="GI" value="350">+350</option>
				<option data-countryCode="GR" value="30">+30</option>
				<option data-countryCode="GL" value="299">+299</option>
				<option data-countryCode="GD" value="1473">+1473</option>
				<option data-countryCode="GP" value="590">+590</option>
				<option data-countryCode="GU" value="671">+671</option>
				<option data-countryCode="GT" value="502">+502</option>
				<option data-countryCode="GN" value="224">+224</option>
				<option data-countryCode="GW" value="245">+245</option>
				<option data-countryCode="GY" value="592">+592</option>
				<option data-countryCode="HT" value="509">+509</option>
				<option data-countryCode="HN" value="504">+504</option>
				<option data-countryCode="HK" value="852">+852</option>
				<option data-countryCode="HU" value="36">+36</option>
				<option data-countryCode="IS" value="354">+354</option>		
				<option data-countryCode="ID" value="62">+62</option>
				<option data-countryCode="IR" value="98">+98</option>
				<option data-countryCode="IQ" value="964">+964</option>
				<option data-countryCode="IE" value="353">+353</option>
				<option data-countryCode="IL" value="972">+972</option>
				<option data-countryCode="IT" value="39">+39</option>
				<option data-countryCode="JM" value="1876">+1876</option>
				<option data-countryCode="JP" value="81">+81</option>
				<option data-countryCode="JO" value="962">+962</option>
				<option data-countryCode="KZ" value="7">+7</option>
				<option data-countryCode="KE" value="254">+254</option>
				<option data-countryCode="KI" value="686">+686</option>
				<option data-countryCode="KP" value="850">+850</option>
				<option data-countryCode="KR" value="82">+82</option>
				<option data-countryCode="KW" value="965">+965</option>
				<option data-countryCode="KG" value="996">+996</option>
				<option data-countryCode="LA" value="856">+856</option>
				<option data-countryCode="LV" value="371">+371</option>
				<option data-countryCode="LB" value="961">+961</option>
				<option data-countryCode="LS" value="266">+266</option>
				<option data-countryCode="LR" value="231">+231</option>
				<option data-countryCode="LY" value="218">+218</option>
				<option data-countryCode="LI" value="417">+417</option>
				<option data-countryCode="LT" value="370">+370</option>
				<option data-countryCode="LU" value="352">+352</option>
				<option data-countryCode="MO" value="853">+853</option>
				<option data-countryCode="MK" value="389">+389</option>
				<option data-countryCode="MG" value="261">+261</option>
				<option data-countryCode="MW" value="265">+265</option>
				<option data-countryCode="MY" value="60">+60</option>
				<option data-countryCode="MV" value="960">+960</option>
				<option data-countryCode="ML" value="223">+223</option>
				<option data-countryCode="MT" value="356">+356</option>
				<option data-countryCode="MH" value="692">+692</option>
				<option data-countryCode="MQ" value="596">+596</option>
				<option data-countryCode="MR" value="222">+222</option>
				<option data-countryCode="YT" value="269">+269</option>
				<option data-countryCode="MX" value="52">+52</option>
				<option data-countryCode="FM" value="691">+691</option>
				<option data-countryCode="MD" value="373">+373</option>
				<option data-countryCode="MC" value="377">+377</option>
				<option data-countryCode="MN" value="976">+976</option>
				<option data-countryCode="MS" value="1664">+1664</option>
				<option data-countryCode="MA" value="212">+212</option>
				<option data-countryCode="MZ" value="258">+258</option>
				<option data-countryCode="MN" value="95">+95</option>
				<option data-countryCode="NA" value="264">+264</option>
				<option data-countryCode="NR" value="674">+674</option>
				<option data-countryCode="NP" value="977">+977</option>
				<option data-countryCode="NL" value="31">+31</option>
				<option data-countryCode="NC" value="687">+687</option>
				<option data-countryCode="NZ" value="64">+64</option>
				<option data-countryCode="NI" value="505">+505</option>
				<option data-countryCode="NE" value="227">+227</option>
				<option data-countryCode="NG" value="234">+234</option>
				<option data-countryCode="NU" value="683">+683</option>
				<option data-countryCode="NF" value="672">+672</option>
				<option data-countryCode="NP" value="670">+670</option>
				<option data-countryCode="NO" value="47">+47</option>
				<option data-countryCode="OM" value="968">+968</option>
				<option data-countryCode="PW" value="680">+680</option>
				<option data-countryCode="PA" value="507">+507</option>
				<option data-countryCode="PG" value="675">+675</option>
				<option data-countryCode="PY" value="595">+595</option>
				<option data-countryCode="PE" value="51">+51</option>
				<option data-countryCode="PH" value="63">+63</option>
				<option data-countryCode="PL" value="48">+48</option>
				<option data-countryCode="PT" value="351">+351</option>
				<option data-countryCode="PR" value="1787">+1787</option>
				<option data-countryCode="QA" value="974">+974</option>
				<option data-countryCode="RE" value="262">+262</option>
				<option data-countryCode="RO" value="40">+40</option>
				<option data-countryCode="RU" value="7">+7</option>
				<option data-countryCode="RW" value="250">+250</option>
				<option data-countryCode="SM" value="378">+378</option>
				<option data-countryCode="ST" value="239">+239</option>
				<option data-countryCode="SA" value="966">+966</option>
				<option data-countryCode="SN" value="221">+221</option>
				<option data-countryCode="CS" value="381">+381</option>
				<option data-countryCode="SC" value="248">+248</option>
				<option data-countryCode="SL" value="232">+232</option>
				<option data-countryCode="SG" value="65">+65</option>
				<option data-countryCode="SK" value="421">+421</option>
				<option data-countryCode="SI" value="386">+386</option>
				<option data-countryCode="SB" value="677">+677</option>
				<option data-countryCode="SO" value="252">+252</option>
				<option data-countryCode="ZA" value="27">+27</option>
				<option data-countryCode="ES" value="34">+34</option>
				<option data-countryCode="LK" value="94">+94</option>
				<option data-countryCode="SH" value="290">+290</option>
				<option data-countryCode="KN" value="1869">+1869</option>
				<option data-countryCode="SC" value="1758">+1758</option>
				<option data-countryCode="SD" value="249">+249</option>
				<option data-countryCode="SR" value="597">+597</option>
				<option data-countryCode="SZ" value="268">+268</option>
				<option data-countryCode="SE" value="46">+46</option>
				<option data-countryCode="CH" value="41">+41</option>
				<option data-countryCode="SI" value="963">+963</option>
				<option data-countryCode="TW" value="886">+886</option>
				<option data-countryCode="TJ" value="7">+7</option>
				<option data-countryCode="TH" value="66">+66</option>
				<option data-countryCode="TG" value="228">+228</option>
				<option data-countryCode="TO" value="676">+676</option>
				<option data-countryCode="TT" value="1868">+1868</option>
				<option data-countryCode="TN" value="216">+216</option>
				<option data-countryCode="TR" value="90">+90</option>
				<option data-countryCode="TM" value="7">+7</option>
				<option data-countryCode="TM" value="993">+993</option>
				<option data-countryCode="TC" value="1649">+1649</option>
				<option data-countryCode="TV" value="688">+688</option>
				<option data-countryCode="UG" value="256">+256</option>
				<!-- <option data-countryCode="GB" value="44">UK +44</option> -->
				<option data-countryCode="UA" value="380">+380</option>
				<option data-countryCode="AE" value="971">+971</option>
				<option data-countryCode="UY" value="598">+598</option>
				<!-- <option data-countryCode="US" value="1">USA +1</option> -->
				<option data-countryCode="UZ" value="7">+7</option>
				<option data-countryCode="VU" value="678">+678</option>
				<option data-countryCode="VA" value="379">+379</option>
				<option data-countryCode="VE" value="58">+58</option>
				<option data-countryCode="VN" value="84">+84</option>
				<option data-countryCode="VG" value="84">+1284</option>
				<option data-countryCode="VI" value="84">+1340</option>
				<option data-countryCode="WF" value="681">+681</option>
				<option data-countryCode="YE" value="969">+969</option>
				<option data-countryCode="YE" value="967">+967</option>
				<option data-countryCode="ZM" value="260">+260</option>
				<option data-countryCode="ZW" value="263">+263</option> 
				</select></div>
				<div class="right">
                                <input type="number" placeholder="Phone number" name="phone"/>
                            <?php
                            if (empty($_POST["phone"])) {
                                echo "<p style='color:red'>" . $error_phone . "</p>";
                            }
                            ?></div><small>OTP will be sent to the registered mobile number </small>
							
                            <div class="dic-inf">
                                <p>By clicking Create Account, you agree to our Terms and confirm 
                                    that you have read our Data Policy, 
                                    including our Cookie Use Policy. You may receive SMS message 
                                    notifications.
                                </p>
                            </div>
                            <div class="sub-btn"><input type="submit" name="submit_btn" value="Create Account" /></div>
                        </div>
                    </div>

            </div>
			<div class="reg-left-sec">
                        <div class="reg-left-top">
                            <h2>Trending Images</h2>
                            <div class="tr-img">
                                <div class="tr-img-col">
                                        <?php
                                        require './dbcon.php';
                                        $image = "select * from uploadimages ORDER BY RAND() LIMIT 3";
                                        $res = mysqli_query($conn, $image);
                                        while ($row = mysqli_fetch_array($res)) {
                                            $dir = $row["uniqueid"] . "/Photos/" . $row["image_name"];
                                            ?>
                                        <div class="image"><div class="tr-img-col"> <img src="<?php echo $dir; ?>" width="50" height="50"></div></div>
                                        <?php
                                    }
                                    ?>
                                  </div>
                            </div>

                            <div class="tr-video">
                                <h2>Trending Video</h2>
                                <div class="tr-vd-col">
                                    <div class="vdo">
                                    <?php
                                    require './dbcon.php';
                                    $image = "select * from videoupload ORDER BY RAND() LIMIT 1";
                                    $res = mysqli_query($conn, $image);
                                    while ($row = mysqli_fetch_array($res)) {
                                        //    $dir = $row["uniqueid"] . "/photo/" . $row["image_name"];
                                        $vid = $row["uniqueid"] . "/Videos/" . $row["video_name"];

                                        //    print_r($vid);
                                        ?>
                                            <link href="css/video-js.css"  rel="stylesheet">
                                            <script src="js/videojs-ie8.min.js"></script>
                                            <video id="my-video" class="video-js" controls preload="auto" width="600" height="330px" data-setup="{}">
                                                <source src="<?php echo $vid; ?>" type='<?php echo $row["video_type"]; ?>'>
                                            </video>
                                            <script src="http://vjs.zencdn.net/6.2.7/video.js"></script>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <h2 style='text-align:left'>Sponsored Ads</h2>
                                <div class="ads ads-arc">
					
                                    <?php
                                    $ip_addr=$_SERVER['REMOTE_ADDR'];
				    $qry=file_get_contents('http://freegeoip.net/json/'.$ip_addr);
				    $res=json_decode($qry);
				    $country = $res->country_name;
			
	                            require './dbcon.php';
	                            $display_banner = "select * from ads where country = '$country' ORDER BY RAND() LIMIT 3";
	                            $results = mysqli_query($conn, $display_banner);
	                            while ($row = mysqli_fetch_array($results)) {
	                            $description = $row["description"];
	                            $link = $row["link"];
                                    ?>
       <div class="one-col-post-ads">
       <a href='<?php echo $row["link"]?>' target='_blank'>
        <div class="one-col-inn">                 
            <div class="post-in-c">
                <div class="post-content">

<div class="post-img"><img src="<?php echo $row["banner_image"] ?>" alt=""></div>
<h2><p class="pst-text"><?php echo $row["heading"] ?></p></h2>
<p class="pst-text"><?php echo substr($description, 0, 100)?></p>
</div>
</div>
</div>
</a>
</div>
                         <?php
                       } ?>
					   </div>
                            </div>
                        </div>
                    </div>
                     <script>
                                     function loadlink(){
                                     $('.ads-arc').load(document.URL + ' .ads-arc');
                                     }
                                     loadlink(); 
                                     setInterval(function(){
                                     loadlink() 
                                     }, 120000);
                                     </script>
			
        </form>
       <script>
      $(document).ready(function(){
      $('#radio1').on('change', function() {
      if ( this.value == "Other")
      {
        $("#hide_div").show();
      }
      else
      {
        $("#hide_div").hide();
      }
    });
});
       </script>
      
    </div>
</div>
</div>


<?php require_once 'inc/footer.php'; ?>
</body>
</html>

<?php
require_once "inc/functions.php";
ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 
session_start();
echo checkLoggedInStatus();
require_once "uploadAccount.php";
echo makePageStart("Manage Account");
echo createPageBody();
echo createNav();

?>


<div class="main-content">

        <header>
            <div class="search-wrapper">
                <span class="ti-search"></span>
                <input type="search" placeholder="Search">
            </div>

            <div class="social-icons">
                <span class="ti-bell"></span>
                <span class="ti-comment"></span>
                <div></div>
            </div>
        </header>

        <main>
            <h2 class="dash-title">Account management</h2>
            <p class="errorMsg" id="errorMsg"></p>



        <?php
$details = getDetails();


$form = <<<SETTINGS

            <div class="settings_outer">
                <div class="settings_inner">

                <form class="details_form" action="./updatePersonalDetails.php" method="post" id="detailsForm" onsubmit="return checkEnquiry(this)"> 

                <div class="settingsInputOuter">
                <div class="inputsSettings">
                    <Label for="first">First Name</Label>
                    <input type="text" name="first" id="first" placeholder="$details[staff_first_name]" />
                </div>
                <div class="inputsSettings">
                    <Label for="last">Last Name</Label>
                    <input type="text" name="last" id="last" placeholder="$details[staff_last_name]" />
                </div>
                <div class="inputsSettings">
                    <Label for="email">Email address</Label>
                    <input type="text" name="email" id="email" placeholder="$details[staff_email]" />
                </div>
                <div class="inputsSettings">
                    <Label for="address">Address line 1</Label>
                    <input type="text" name="address" id="address" placeholder="$details[staff_address]" />
                </div>
                <div class="inputsSettings">
                    <Label for="postcode">Postcode</Label>
                    <input type="text" name="postcode" id="postcode" placeholder="$details[staff_postcode]" />
                </div>
                <div class="inputsSettings">
                    <Label for="rate">Hourly Rate</Label>
                    <input type="text" name="rate" id="rate" placeholder="£$details[hourly_rate]" readonly/>
                </div>
                <div class="inputsSettings">
                    <Label for="reg">Vehicle reg</Label>
                    <input type="text" name="reg" id="reg" placeholder="$details[vehicle_reg]" readonly/>
                </div>

                <div class="inputsSettings">
                <input type="submit" name="submit" class="submitBtn" value="Update Details" />
                                </div>


                </div>
                </form>
                </div>

                <span id="margin"></span>


                <div class="settings_inner">
                <form class="password_form" action="./updatePassword.php" method="post" id="passwordForm" onsubmit="return checkEnquiry(this)">
                    
                <p class="errorMsg" id="errorMsg2"></p>
                <div class="inputsOuter">
                    <div class="inputsInner">

                    <Label for="password">Password</Label>
                    <input type="password" name="password" id="password"  />
                    <meter max="4" id="password-strength-meter"></meter>
                    <p id="password-strength-text"></p>
                </div>
                <div class="inputsInner">
                    <Label for="passwordRepeat">Password Repeat</Label>
                    <input type="password" name="passwordRepeat" id="passwordRepeat"  />
                </div>

                <div class="inputsInner">
                <input type="submit" name="submit" class="submitBtn" value="Change Password" />
                </div>



                    </div>
                    </form>
                </div>

            </div>

SETTINGS;
$form .= "\n";
echo $form;

?>




        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
    <script src="checkManageAccount.js"></script>
<?php

echo createPageClose();
?>
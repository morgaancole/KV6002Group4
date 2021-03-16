<?php
require_once "inc/functions.php";
require_once "uploadAccount.php";
echo makePageStart("Timesheet");
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


        <?php
$details = getDetails();


echo($_COOKIE["test"]);


// $detailsLength = count($details);
//    var_dump($details);

// echo "
// <br/><br/>
// <p>Firstname: $details[staff_first_name]</p>
// <p>Lastname: $details[staff_last_name]</p>
// <p>Email: $details[staff_email]</p>
// <p>password: $details[staff_password]</p>
// <p>address: $details[staff_address]</p>
// <p>postcode: $details[staff_postcode]</p>
// <p>Hourly rate: $details[hourly_rate]</p>
// <p>Assigned vehicle: $details[vehicle_reg]</p>
// ";

$form = <<<SETTINGS

            <div class="settings_outer">
                <div class="settings_inner">
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
                    <Label for="address">Adress line 1</Label>
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
                <button class="changeBtn" type="submit">Change Details</button>
                </div>


                </div>
                </div>

                <span id="margin"></span>


                <div class="settings_inner">
                <form class="password_form" action="./updatePassword.php" method="post">
                    <div class="inputsOuter">
                    <div class="inputsInner">
                    <Label for="password">Password</Label>
                    <input type="password" name="password" id="password"  />
                </div>
                <div class="inputsInner">
                    <Label for="passwordRepeat">Password Repeat</Label>
                    <input type="password" name="passwordRepeat" id="passwordRepeat"  />
                </div>

                <div class="inputsInner">
                <input type="submit" name="submit" class="submitBtn" />
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


<?php

echo createPageClose();
?>
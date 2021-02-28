<?php
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();
?>

<body style="background-image: url(styles/images/services.jpg);">
    <h3 class="title">Our Services
        <a href="contactForm.php">Contact Us for a quote</a> 
    </h3>
    
    <div class="wrap">  
        <div class="item">
            <h2>Impact Damage Repair</h2>
            <p>We have vast experience dealing with impact damage situations, providing a rapid response to stabilise properties, followed by full reinstatement. Safety and security are paramount in these circumstances and Henderson Building Contractors have the resources to ensure the impacted property is made safe and repaired to its pre-impact condition.</p>
            <p>Impact Damage repair involves a range of services from start to finish such as:</p>
            <ul>
                <li>Emergency Propping Up</li>
                <li>Emergency Boarding Up</li>
                <li>Structural Survey</li>
                <li>Structural Repair</li>
                <li>Bricklaying</li>
            </ul>
        </div>
    </div>

</body>
<?php

echo makeFooter();
echo endMain();
echo makePageEnd();

?>
<?php
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();
?>

<head>
<script src="js/reviews.js"></script>
</head>
<body>
    
<div class="content-wrapper">    
    
<div class="home-item-wrapper">
                <div class="home-img-background" style="background-image:url(images/people.jpeg)">

                </div>
                    
</div>      
      
    
    <div class="info-item-wrapper">
     
    
            
        <div class="info-text-wrapper">
            <h1 class="title">Welcome to Henderson Building Contractors</h1>
                <br>
                
                <div class="info-subtitle">
                   <h2> Our business is a well established building contracting service based in Cramlington, Northumberland, operating throughout the North East of England. A family run business, trading since 1984, offering a high quality professional and friendly service to all our customers.</h2>
                        <br>
                        <br>
                   <h3>We specialise in flood, fire, impact and storm damage re-instatement, subsidence, wet and dry rot, and escape of water/oil. As an approved contractor to the insurance and loss adjusting industry, we work closely with insurance companies, loss adjusters, building surveyors and structural engineers.</h3>
                        <br>
                        <br>
                   <h3>With our workforce of skilled tradesman, we offer all aspects of new build, extensions, alterations/refurbishment and maintenance works for larger contracts in the public and business sectors, through to smaller private works. As a member of ‘Federation of Master Builders’ and ‘Safe Contractor’, all work is carried out to strict safety regulations and guidelines.</h3>
                </div>
                        <br>

                <form method="get" action="about.php" id="contact">
                    <button type="submit" class="contact">Read more</button>
                </form>
                
                
        </div>
    
    </div>
    

    <div class="portfolio-items-wrapper">
        
        <div class="portfolio-item-wrapper">
                <div class="portfolio-img-background" style="background-image:url(styles/images/blueprint.jpeg)"></div>
            
            <div class="img-text-wrapper">
                
                <div class="logo-wrapper">
                   <img src="styles/images/IMG_0150W.PNG">
                </div>
                
                <div class="subtitle">
                   <a href="services.php" class="subtitle">Impact Damage Repair</a> 
                </div>
                
            </div>
            
        </div>
        
        <div class="portfolio-item-wrapper">
                <div class="portfolio-img-background" style="background-image:url(styles/images/builder.jpeg)"></div>
            
            <div class="img-text-wrapper">
                
                <div class="logo-wrapper">
                    <img src="styles/images/IMG_0148W.PNG">
                </div>
                
                <div class="subtitle">
                    <a href="services.php" class="subtitle">Structure Damage</a>
                </div>
                
            </div>
            
        </div>
        
        <div class="portfolio-item-wrapper">
                <div class="portfolio-img-background" style="background-image:url(styles/images/extension.jpeg)"></div>
            
            <div class="img-text-wrapper">
                
                <div class="logo-wrapper">
                    <img src="styles/images/IMG_0145W.PNG">
                </div>
                
                <div class="subtitle">
                    <a href="services.php" class="subtitle"> Water/Oil Escape</a>
                </div>
                
            </div>
            
        </div>
        
        <div class="portfolio-item-wrapper">
                <div class="portfolio-img-background" style="background-image:url(styles/images/paper.jpeg)"></div>
            
            <div class="img-text-wrapper">
                
                <div class="logo-wrapper">
                    <img src="styles/images/IMG_0147W.PNG">
                </div>

                <div class="subtitle">
                    <a href="services.php" class="subtitle"> Fire Damage</a>
                </div>
                
            </div>
            
        </div>
        
        <div class="portfolio-item-wrapper">
                <div class="portfolio-img-background" style="background-image:url(styles/images/people.jpeg)"></div>
            
            <div class="img-text-wrapper">
                
                <div class="logo-wrapper">
                    <img src="styles/images/IMG_0149W.PNG">
                </div>
 
                <div class="subtitle">
                    <a href="services.php" class="subtitle">Refurbishment</a>
                </div>
                
            </div>
            
        </div>
        
        <div class="portfolio-item-wrapper">
                <div class="portfolio-img-background" style="background-image:url(styles/images/saw.jpg)"></div>
            
            <div class="img-text-wrapper">
                
                <div class="logo-wrapper">
                    <img src="styles/images/IMG_0144W.PNG">
                </div>

                <div class="subtitle">
                    <a href="services.php" class="subtitle"> Flood Damage</a>
                </div>
                
            </div>
            
        </div>
        
    </div>
    
    <div class="review-item-wrapper">
            
         <div class="review-text-wrapper">
             
                
             <div class="title">
                    <h3>Customer Reviews</h3>
                    <br>
             </div>      
             
         <div class="review-form" id="review">
            <button type="submit" id="show">Leave Review</button>
            <div id ="rev-form">
            <form id="new-review" action="newReview.php" method="post">
                <input 
                    name="name" type="text" required id="name" 
                    placeholder="Name" pattern="[a-zA-Z0-9\s]+" title="Only alphaneumerics are allowed" 
                    autocomplete="first-name" size="20" maxlength="40"
                ><br>

                <textarea type="text" name="review" id="review" placeholder="Leave review here" minlength="1" required title="review"></textarea><br>
        
                <button name="btn_create_review" type="submit" id="create-review">Post</button>
            </form>
            </div>
        </div>

             <div class="job-page">  
                    <?php echo getReviews();?>
             </div>
        </div>
    
    </div>
    
</div>  

</body>

<script>
    const portfolioItems = document.querySelectorAll('.portfolio-item-wrapper')
    
    portfolioItems.forEach(portfolioItem => {     
        portfolioItem.addEventListener('mouseover', () => {
            portfolioItem.childNodes[1].classList.add('img-darken');
        })
        
        portfolioItem.addEventListener('mouseout', () => {
            portfolioItem.childNodes[1].classList.remove('img-darken');
        })
    })
            
                            
</script>

<?php
echo makeFooter();
echo endMain();
echo makePageEnd();
?>

 <?php
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();
?>


<body>
    
<div class="content-wrapper">    
    
<div class="home-item-wrapper">
                <div class="home-img-background" style="background-image:url(images/people.jpeg)">
    
    
                 
            
                    <h1>Family Run</h1> <br> <h1> Industry Specialists</h1>
                </div>
                    
</div>    
    
 <div class="info-item-wrapper">
            
            <div class="info-text-wrapper">
                
                <div class="info-subtitle">
                    Our business is a well established building contracting service based in Cramlington, Northumberland, operating throughout the North East of England. A family run business, trading since 1984, offering a high quality professional and friendly service to all our customers.
<br><br>
We specialise in flood, fire, impact and storm damage re-instatement, subsidence, wet and dry rot, and escape of water/oil. As an approved contractor to the insurance and loss adjusting industry, we work closely with insurance companies, loss adjusters, building surveyors and structural engineers.
<br><br>
With our workforce of skilled tradesman, we offer all aspects of new build, extensions, alterations/refurbishment and maintenance works for larger contracts in the public and business sectors, through to smaller private works. As a member of ‘Federation of Master Builders’ and ‘Safe Contractor’, all work is carried out to strict safety regulations and guidelines.
                </div>
                
</div>
    
</div>
    

    <div class="portfolio-items-wrapper">
        
        <div class="portfolio-item-wrapper">
                <div class="portfolio-img-background" style="background-image:url(images/blueprint.jpeg)"></div>
            
            <div class="img-text-wrapper">
                
                <div class="logo-wrapper">
                    <img src="images/IMG_0150.PNG">
                </div>
                
                <div class="subtitle">
                    Impact Damage Repair
                </div>
                
            </div>
            
        </div>
        
        <div class="portfolio-item-wrapper">
                <div class="portfolio-img-background" style="background-image:url(images/builder.jpeg)"></div>
            
            <div class="img-text-wrapper">
                
                <div class="logo-wrapper">
                    <img src="images/IMG_0148.PNG">
                </div>
                
                <div class="subtitle">
                    Structure Damage
                </div>
                
            </div>
            
        </div>
        
        <div class="portfolio-item-wrapper">
                <div class="portfolio-img-background" style="background-image:url(images/extension.jpeg)"></div>
            
            <div class="img-text-wrapper">
                
                <div class="logo-wrapper">
                    <img src="images/IMG_0145.PNG">
                </div>
                
                <div class="subtitle">
                    Water/Oil Escape
                </div>
                
            </div>
            
        </div>
        
        <div class="portfolio-item-wrapper">
                <div class="portfolio-img-background" style="background-image:url(images/paper.jpeg)"></div>
            
            <div class="img-text-wrapper">
                
                <div class="logo-wrapper">
                    <img src="images/IMG_0147.PNG">
                </div>

                <div class="subtitle">
                    Fire Damage
                </div>
                
            </div>
            
        </div>
        
        <div class="portfolio-item-wrapper">
                <div class="portfolio-img-background" style="background-image:url(images/people.jpeg)"></div>
            
            <div class="img-text-wrapper">
                
                <div class="logo-wrapper">
                    <img src="images/IMG_0149.PNG">
                </div>
 
                <div class="subtitle">
                    Refurbishment
                </div>
                
            </div>
            
        </div>
        
        <div class="portfolio-item-wrapper">
                <div class="portfolio-img-background" style="background-image:url(images/saw.jpg)"></div>
            
            <div class="img-text-wrapper">
                
                <div class="logo-wrapper">
                    <img src="images/IMG_0144.PNG">
                </div>

                <div class="subtitle">
                    Flood Damage
                </div>
                
            </div>
            
        </div>
        
    </div>
 
    

    

 <div class="review-item-wrapper">
            
            <div class="review-text-wrapper">
                
                <div class="review-subtitle">
                    Reviews
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

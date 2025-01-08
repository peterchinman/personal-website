<?php

include __DIR__ . '/head.php';

?>

<body class="<?= $source ?>">
   <header>
   <inner-column>
      <div class="top-part">
         <div class="title">
               <div class="page-name"><a href="<?= BASE_URL ?>">Peter Chinman</a></div>
         </div>
         <div class="disambiguation">
            <div class="is-a-blank">
               <p>makes</p><div class="fake-selection-input" tabindex="0">software</div>
            </div>
            <ul class="selection-options">
               <li><a href="https://www.theparkpoet.com/" target="_blank">poems</a></li>
               <li><a href="https://holymold.com/" target="_blank">sculpture</a></li>
               <li><a href="<?= CODE_URL ?>">software</a></li>
            </ul>
         </div>
      </div>
      <script>
         const fakeSelectionInput = document.querySelector('.fake-selection-input');
         const options = document.querySelector('.selection-options');
         document.addEventListener('click', (event) => {
            if (event.target === fakeSelectionInput) {
               options.classList.toggle('selected');
            }
            else {
               options.classList.remove('selected');
            }
            
         })
         options.addEventListener('mouseover', (event) => {
            const text = event.target.innerText;
            if(fakeSelectionInput.innerText !== text){
               fakeSelectionInput.innerText = text;
            }
         })
         options.addEventListener('mouseleave', (event) => {
            fakeSelectionInput.innerHTML = "software";
         })
      </script>

      <nav>
         <?php 
         // if (isset($source) && ($source === "code" || (($request_uri['query']['key'] ?? null) === "code"))): ?>
         <ul class="site-nav">
            <li><a href="<?= BASE_URL ?>work">Work</a></li>
            <li><a href="<?= BASE_URL ?>blog?source=<?= $source ?? '' ?>">Blog</a></li>
            <li><a href="<?= BASE_URL ?>bio">Bio</a></li>
         </ul>
         <?php //endif; ?>
      </nav>

      <svg style="visibility: hidden; position: absolute;" width="0" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1">
         <defs>
            <filter id="goo"><feGaussianBlur in="SourceGraphic" stdDeviation="8" result="blur" />    
                  <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
                  <feComposite in="SourceGraphic" in2="goo" operator="atop"/>
            </filter>
         </defs>
      </svg>
   </header>


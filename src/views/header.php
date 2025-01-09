<?php

include __DIR__ . '/head.php';

?>

<body class="<?= $source ?? '' ?>">
   <header>

      <div class="name-section">
      <inner-column>
         <div class="title">
               <div class="page-name"><a href="<?= BASE_URL ?>">Peter Chinman</a></div>
         </div>
         <!-- <div class="disambiguation">
            <div class="is-a-blank">
               <p>makes</p><div class="fake-selection-input" tabindex="0">software</div>
            </div>
            <ul class="selection-options">
               <li><a href="https://www.theparkpoet.com/" target="_blank">poems</a></li>
               <li><a href="https://holymold.com/" target="_blank">sculpture</a></li>
               <li><a href="<?= CODE_URL ?>">software</a></li>
            </ul>
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
         </div> -->
      </inner-column>
      </div>

      <nav>
      <inner-column>
         <?php 
         // if (isset($source) && ($source === "code" || (($request_uri['query']['key'] ?? null) === "code"))): ?>
         <ul class="site-nav">
            <li><a href="<?= BASE_URL ?>work">Work</a></li>
            <li><a href="<?= BASE_URL ?>blog?source=<?= $source ?? '' ?>">Blog</a></li>
            <li><a href="<?= BASE_URL ?>bio">Bio</a></li>
         </ul>
         <?php //endif; ?>
      </inner-column>
      </nav>
   
      
      

      
   </header>


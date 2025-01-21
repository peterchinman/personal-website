<?php

include __DIR__ . '/head.php';

?>

<body class="<?= $source ?? '' ?>" hx-boost="true">
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

      <div class="social">
      <inner-column>
         <ul class="social-links-list">
            <!-- Mail -->
            <li>
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            </li>
            <!-- GitHub -->
            <li>
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-github"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg>
            </li>
            <!-- Codepen -->
            <li>
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-codepen"><polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"/><line x1="12" x2="12" y1="22" y2="15.5"/><polyline points="22 8.5 12 15.5 2 8.5"/><polyline points="2 15.5 12 8.5 22 15.5"/><line x1="12" x2="12" y1="2" y2="8.5"/></svg>
            </li>
            <!-- Instagram -->
            <li>
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
            </li>
         </ul>

      </inner-column>
      </div>

      <nav>
      <inner-column>
         <?php 
         // if (isset($source) && ($source === "code" || (($request_uri['query']['key'] ?? null) === "code"))): ?>
         <ul class="site-nav">
            <li><a href="<?= BASE_URL ?>work">Work</a></li>
            <li><a href="<?= BASE_URL ?>blog">Blog</a></li>
            <li><a href="<?= BASE_URL ?>bio">Bio</a></li>
         </ul>
         <?php //endif; ?>
      </inner-column>
      </nav>
   
      
      

      
   </header>


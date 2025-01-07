<main>
   <inner-column>
      <div class="fake-menu">
         <div class="fill-in-the">
            <p>is a</p><div class="blank"><span class="hold-open">p</span></div>
         </div>
         <ul class="selection-options">
            <li><a href="https://www.theparkpoet.com/">poet</a></li>
            <li><a href="https://holymold.com/">sculptor</a></li>
            <li><a href="<?= CODE_URL ?>">coder</a></li>
         </ul>
      </div>
   </inner-column>
   <script>
      const blank = document.querySelector('.blank');
      const options = document.querySelector('.selection-options');
      options.addEventListener('mouseover', (event) => {
         const text = event.target.innerText;
         if(blank.innerText !== text){
            blank.innerText = text;
         }
      })
      options.addEventListener('mouseleave', (event) => {
         blank.innerHTML = '<span class="hold-open">p</span>';
      })
   </script>
</main>

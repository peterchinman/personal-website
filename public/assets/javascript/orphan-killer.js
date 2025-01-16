// ORPHAN KILLER
function insertNonBreakingSpace() {
   // Select all <p> and <li> elements inside the <article>
   const article = document.querySelector('article');
   const paragraphsAndListItems = document.querySelectorAll('p, li, blog-card .title a');
 
   paragraphsAndListItems.forEach(el => {
     let html = el.innerHTML.trim();
  
     // What a hideous Regex!! But it seems to work well
     // (?<!<[^>]*) is a negative lookbehind making sure that we're not matching something inside of an an html element tag
     // \s initial space so that we're positioned at the start of a word
     // ((?:<[^>]*>)?[^<\s]{1,10}(?:<[^>]*>)?) we are then matching for two of these capture groups separated by a space
     // the capture groups match a sequence of non-space character between 1 and 10 characters (10 could be fine-tuned, we're trying to avoid destructive de-orphaning that leaves the penultimate line ragged), possibly prefixed and/or post-fixed with any number of html tags (with a final optional period in the second group, to capture "<a>link</a>.").
     const regex = /(?<!<[^>]*)\s((?:<[^>]*>)*[^<\s]{1,9}(?:<[^>]*>)*)\s+((?:<[^>]*>)*[^<\s]{1,9}(?:<[^>]*>)*\.?)$/;
     // 30 character requirement to stop it from orphan killing short lines
     if (regex.test(html) && html.length > 30) {
       // Replace the last space between the last two words with a non-breaking space
       html = html.replace(regex, (match, word1, word2) => {
         // we're matching an inital leading space, so we need to return that as well
         return ` ${word1}\u00A0${word2}`;
       });
 
       // Set the modified HTML back into the element
       el.innerHTML = html;
     }
   });
 }
 
 insertNonBreakingSpace();
 document.addEventListener('htmx:afterSwap', insertNonBreakingSpace)

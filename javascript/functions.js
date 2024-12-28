function insertNonBreakingSpace() {
   // Select all <p> and <li> elements inside the <article>
   const article = document.querySelector('article');
   const paragraphsAndListItems = article.querySelectorAll('p, li');
 
   paragraphsAndListItems.forEach(el => {
     // Work with the element's HTML content, not just textContent
     let html = el.innerHTML.trim();
 
     // Use a regular expression to match the last two words (excluding HTML tags)
     const regex = /(\S+)\s+(\S+)$/;
     if (regex.test(html)) {
       // Replace the last space between the last two words with a non-breaking space
       html = html.replace(regex, (match, word1, word2) => {
         return `${word1}\u00A0${word2}`;
       });
 
       // Set the modified HTML back into the element
       el.innerHTML = html;
     }
   });
 }
 
 // Call the function
 insertNonBreakingSpace();

 
 

//  function insertNonBreakingSpace() {
//    const article = document.querySelector('article');
//    const paragraphsAndListItems = article.querySelectorAll('p, li');
 
//    paragraphsAndListItems.forEach(el => {
//      // Temporarily store the HTML content of the element
//      const originalHTML = el.innerHTML.trim();
     
//      // Parse the HTML content into a temporary DOM structure
//      const tempDiv = document.createElement('div');
//      tempDiv.innerHTML = originalHTML;
 
//      // Get all text nodes within the element, excluding inline elements like <sup>, <a>, etc.
//      const textNodes = getTextNodes(tempDiv);
 
//      // If there's more than one text node, we will try to modify the last two words
//      if (textNodes.length > 0) {
//        const lastTextNode = textNodes[textNodes.length - 1];
//        const textContent = lastTextNode.textContent.trim();
 
//        // Only proceed if there's more than one word
//        if (textContent.split(/\s+/).length > 1) {
//          // Modify the last text node's content to insert a non-breaking space between the last two words
//          const words = textContent.split(/\s+/);
//          words[words.length - 2] += '\u00A0' + words[words.length - 1];
//          words.pop();  // Remove the last word after combining
 
//          // Replace the text content of the last node with the updated words
//          lastTextNode.textContent = words.join(' ');
//        }
//      }
 
//      // Set the modified HTML back into the element
//      el.innerHTML = tempDiv.innerHTML;
//    });
//  }
 
// //  // Helper function to get all text nodes from a given element, excluding inline tags
// //  function getTextNodes(element) {
// //    const textNodes = [];
// //    const walk = document.createTreeWalker(element, NodeFilter.SHOW_TEXT, null, false);
 
// //    let node;
// //    while ((node = walk.nextNode())) {
// //      // Only consider text nodes that are not inside <sup>, <a>, or similar inline elements
// //      if (!node.parentNode.closest('sup, a')) {
// //        textNodes.push(node);
// //      }
// //    }
// //    return textNodes;
// //  }
 
// //  // Call the function
// //  insertNonBreakingSpace();
 
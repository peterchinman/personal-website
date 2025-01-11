
// ORPHAN KILLER
function insertNonBreakingSpace() {
  // Select all <p> and <li> elements inside the <article>
  const article = document.querySelector('article');
  const paragraphsAndListItems = article.querySelectorAll('p, li');

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


// move Table of Contents
function moveTableOfContents() {
  const article = document.querySelector('article');
  const TOC = article.querySelector('.table-of-contents');
  TOC.remove();
  article.appendChild(TOC);
}

moveTableOfContents();

// how far apart do sidenotes need to be to be considered not overlapping, in pixels
const overlapGap = 24;

function checkOverlap(el1, el2) {
    const rect1 = el1.getBoundingClientRect();
    const rect2 = el2.getBoundingClientRect();
    if(rect1.top === 0 && rect2.top === 0 ){
      return false;
    }
    return !(
      rect1.bottom + overlapGap <= rect2.top ||
      rect1.top >= rect2.bottom + overlapGap
    );
}

function resolveOverlap(el1, el2) {
  while (checkOverlap(el1, el2)) {
    const currentTop = parseInt(window.getComputedStyle(el2).top);
    el2.style.top = `${currentTop + 1}px`; // Move the second element down by 10px
  }
}


function updateFootnotePositions(footnotes){
  const footnoteRefs = document.querySelectorAll('.footnote-ref');
  Array.from(footnotes).forEach((element, index) => {
    // get matching footnote reference
    const id = element.id.slice(3);
    // we have to use this convoluted filter in order to support footnotes within footnotes
    const matchingRef = Array.from(footnoteRefs).filter((ref) => ref.textContent == id)[0];

    // Put footnote under parent-paragaph (TODO we only need to run this once, should be grouped with unlistify())
    // but only if we haven't already
    if (!element.closest('.footnote-container')){
      // first check if we're inside another footnote-container
      let parentParagraph = matchingRef.closest('.footnote-container');
      // if not we can match our normal paragraph-ish elements
      if (!parentParagraph) {
        parentParagraph = matchingRef.closest('p, li, pre')
      }
      element.remove();
      const footnoteContainer = document.createElement('div');
      footnoteContainer.classList.add('footnote-container');
      footnoteContainer.appendChild(element);
      parentParagraph.insertAdjacentElement("afterend", footnoteContainer);
    }

    // Note this break point is referenced in the CSS as well, so if you change it here, change it there as well.
    const mediaQuery = window.matchMedia('(min-width: 1300px)');
    // if wide enough we want it in the margin, at the correct height
    if (mediaQuery.matches) {
      const refTop = matchingRef.getBoundingClientRect().top;
      const innerColumn = element.closest('inner-column');
      const innerColumnTop = innerColumn.getBoundingClientRect().top;
      element.style.top = (refTop  - innerColumnTop) + 'px';

      // check against previous footnotes to see if we overlap
      if (index > 0){
        for (let j = 0; j < index; ++j){
            const overlap = checkOverlap(footnotes[j], element)
            if (overlap) {
              resolveOverlap(footnotes[j], element)
            }
        }

        // if footnotes are guaranteed to be in order, i.e. no footnotes within footnotes, we can use this, otherwise we need to compare each against each like above, which maybe would get slow if there were a ton of footnotes??
        // const overlap = checkOverlap(footnotes[index - 1], footnotes[index]);
        // if (overlap) {
        //   resolveOverlap(footnotes[index - 1], footnotes[index])
        // }
      }
    }
    
  })
}

// Moves footnotes from the list that League\CommonMark puts them in, into separate <div>s. So if/when we move them beneath paragraphs, they semantically make sense.
function unlistifyFootnotes(footnotes){
  const footnotesContainer = document.querySelector('.footnotes');
  footnotes.forEach(element => {
    const newElement = document.createElement('div');
    for (const attribute of element.attributes) {
      newElement.setAttribute(attribute.name, attribute.value);
    }
    
    // Copy the content from the old element to the new one
    newElement.innerHTML = element.innerHTML;
    
    footnotesContainer.appendChild(newElement);
    element.remove();
  })
  footnotesContainer.querySelector('ol').remove();
  return document.querySelectorAll('.footnote');
}


// Give each footnotes a data-index value with their id
function updateFootnoteNumbers(footnotes){
  footnotes.forEach((element) => {
    element.dataset.index = element.id.slice(3);
  })
}
               

window.onload = () => {
  const footnotes = document.querySelectorAll('.footnote');
  console.log(footnotes);
  if (footnotes) {
    const divFootnotes = unlistifyFootnotes(footnotes);
    console.log(divFootnotes);
    updateFootnoteNumbers(divFootnotes);
    updateFootnotePositions(divFootnotes);

    window.addEventListener('resize', function(event) {
      const footnotes = document.querySelectorAll('.footnote');
      updateFootnotePositions(footnotes);
    });

    document.addEventListener("click", (event) => {
      if (event.target.matches('.footnote-ref')){
        // event.preventDefault();
        event.target.classList.toggle('selected');
        const index = event.target.textContent - 1;
        const footnotes = document.querySelectorAll('.footnote');
        footnotes[index].classList.toggle('selected');
      }
    })
  }
  
};




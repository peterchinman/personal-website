// move Table of Contents
function moveTableOfContents() {
  setTimeout(() => {
    const article = document.querySelector('article');
    const TOC = document.querySelector('.table-of-contents');
    if (TOC) {
      TOC.remove();
      if (article) {
        article.appendChild(TOC);
      }
    }
  }, 50);
}

moveTableOfContents();
document.addEventListener('htmx:afterSettle', moveTableOfContents)



function checkOverlap(el1, el2) {
  // how far apart do sidenotes need to be to be considered not overlapping, in pixels
  const OVERLAP_GAP = 24;
  const rect1 = el1.getBoundingClientRect();
  const rect2 = el2.getBoundingClientRect();
  if(rect1.top === 0 && rect2.top === 0 ){
    return false;
  }
  return !(
    rect1.bottom + OVERLAP_GAP <= rect2.top ||
    rect1.top >= rect2.bottom + OVERLAP_GAP
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

    element.style.top = '';
    // Put footnote under parent-paragaph (TODO we only need to run this once, should be grouped with unlistify())
    // but only if we haven't already
    if (!element.closest('.footnote-container')){
      // first check if we're inside another footnote-container
      let parentParagraph = matchingRef.closest('.footnote-container');
      // if not we can match our normal paragraph-ish elements
      if (!parentParagraph) {
        parentParagraph = matchingRef.closest('p, ul, ol, pre')
      }
      element.remove();
      const footnoteContainer = document.createElement('div');
      footnoteContainer.classList.add('footnote-container');
      footnoteContainer.appendChild(element);

      // if parent paragraph has a .footnote-containers after it, we want to place after those
      let afterMe = parentParagraph;
      while(afterMe.nextElementSibling?.classList.contains("footnote-container") ) {
        afterMe = afterMe.nextSibling;
      } 
      afterMe.insertAdjacentElement("afterend", footnoteContainer);
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
  if (footnotesContainer) {
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
  
}


// Give each footnotes a data-index value with their id
function updateFootnoteNumbers(footnotes){
  footnotes.forEach((element) => {
    element.dataset.index = element.id.slice(3);
  })
}

// Wait for images to load before positioning footnotes
function waitForImages() {
  const images = document.querySelectorAll('img');
  const promises = Array.from(images).map(img => {
    if (img.complete) return Promise.resolve();
    return new Promise(resolve => {
      img.onload = resolve;
      img.onerror = resolve; // Handle broken images too
    });
  });
  return Promise.all(promises);
}
               
const runFootnoteCode = async (event) => {
  const footnotes = document.querySelectorAll('.footnote');
  if (footnotes.length === 0) return;

  const divFootnotes = unlistifyFootnotes(footnotes);
  updateFootnoteNumbers(divFootnotes);
  
  // Wait for images first
  await waitForImages();
  
  // Add a small delay to let the browser finish layout calculations
  setTimeout(() => {
    updateFootnotePositions(divFootnotes);
  }, 50);
}

// Debounced resize handler
const debouncedUpdatePositions = debounce(() => {
  const footnotes = document.querySelectorAll('.footnote');
  updateFootnotePositions(footnotes);
}, 150);

// Single click handler at document level
const handleFootnoteClick = (event) => {
  if (!event.target.matches('.footnote-ref')) return;
  
  event.preventDefault();
  event.target.classList.toggle('selected');
  const index = event.target.textContent;
  
  const footnotes = Array.from(document.querySelectorAll('.footnote'));
  footnotes.filter(element => element.id.slice(3) === index)
          .forEach(element => element.classList.toggle('selected'));
};

// Simple debounce function
function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// Remove old listeners before adding new ones
function setupEventListeners() {
  window.removeEventListener('resize', debouncedUpdatePositions);
  document.removeEventListener('click', handleFootnoteClick);
  
  window.addEventListener('resize', debouncedUpdatePositions);
  document.addEventListener('click', handleFootnoteClick);
}

// Setup on HTMX loads and initial page load
document.addEventListener('htmx:afterSettle', () => {
  setupEventListeners();
  runFootnoteCode();
  
  // Add a backup position update after a longer delay
  setTimeout(() => {
    const footnotes = document.querySelectorAll('.footnote');
    if (footnotes.length > 0) {
      updateFootnotePositions(footnotes);
    }
  }, 500);
});
window.addEventListener('load', () => {
  setupEventListeners();
  runFootnoteCode();
});



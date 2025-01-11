---
title: lighght
slug: lighght
subtitle: A silent letter detector.
site: https://peterchinman.github.io/lighght
code: https://github.com/peterchinman/lighght
tags:
  - project
  - featured
  - language
coolness: 7
published: 2024-12-30
---
# A Silent Letter Detector

At [Recurse](https://www.recurse.com/), there's a weekly Creative Coding group. We meet up, a theme is announced, and everyone spends two hours working on a small creative coding project related to the theme.

This week's theme was: "light". Which made me thing of Aram Saroyan's [single-word poem](https://www.poetryfoundation.org/poems/1595962/lighght), which I will include the entirety of here:

<poem>lighght<poem>

Which I love. The weightlessness of the silent letters made material thru duplication, which feels like a rhyme against the weightless materiality of light itself.

Which got me thinking about silent letters. I'd been working on a C++ library for working with the CMU Pronouncing Dictionary, to use with my Rhyme & Meter Checker. And I realized that I could use that to make a Silent Letter Detector.

I tried to implement it in the two hour period of Creative Coding, which failed—but the idea stuck, so I decided to build out a working version.

# Finding Silent Letters

The basic process:

1. Make a list of all valid ways of spelling each consonant sound[^1] .
2. Get the pronunciation of the word you're checking.
3. Iterate thru the pronunciation of the word, checking the possible spellings of each consonant sound against the spelling of the word, skipping over vowels. If we come across any consonants in the spelling of the word that don't correspond with the pronunciation, these can be marked as Silent Letters.

[^1]: I decided I was only concerned with silent consonants. There are certainly silent vowels—just look at the word 'queue'—but this: 1) added a level of complexity I wasn't interested in addressing, and 2) vowels are already massless floating things. It's consonants that actually have weight, and thus, whose silence is actually meaningful.

For example:

- Get the pronunciation of `'light'` from our dictionary: `/laɪt/`
- Spellings of the consonant sounds in `/laɪt/` :  `/l/ : {"l", "ll"}, /t/: {"t", "tt", "d"}`
- Iterate thru the pronunciation: 
	- `/l/` matches `'l'`, leaving   `/aɪt/` → `'ight'` 
	- Skip the vowels, leaving `/t/` → `'ght'`
	- `/t/` matches `'t'`, which leaves the `'gh'`, which we can mark as a silent letter

I coded the Silent Letter Detection in C++. I had recently started using test-driven development, which worked well here: I threw a bunch of examples of words with silent letters into my tests and kept futzing into they all passed.

Generating the list of valid spellings of each consonant sound was the hardest part, in the sense that there was no way of abstractly reasoning my way thru it. English is a messy language, cobbled together out of a variety of sources, and full of edge cases. I had to keep adjusting the list as I discovered new failures.

I compiled the C++ to WebAssembly using Emscripten. Emscripten allows you to bind functions and classes from C++ you can then call directly from Javascript. I found the hardest part of using Emscripten was figuring out what exactly to include in my `CMakeLists.txt` to get it to compile. But once you get it to work you end up with three files that plop into your web project.

# Front End

The biggest challenge for the front-end was figuring out how to implement a text-input interface, where I could directly mark-up the text, in order to highlight the Silent Letters. Sort of like a spell-checker marking <span class="misspelled">mispelled</span> words.

You can't use `<textarea>` because it can't contain spans. Instead I decided to try using the `contenteditable='true'` attribute, which was new to me.

The first problem I ran into is that, because I'm reading the text from my `textfield`, processing it, and then replacing the `textfield` with the marked-up text, I need to handle the text caret cursor placement myself. This is done using the `Selection` and `Range` interfaces. You need to get the cursor placement from the `textfield`, process the text, and then set the cursor placement to put it back where it should be. I do this by counting the number of characters before the cursor, with the complication being that these characters could potentially be inside of nested `<span>`s inside of the `textfield`. I handle this by recursively walking back thru each of these nested levels, and counting up the number of characters in each. Then, when I'm placing the cursor, I do that in reverse.

There are also lots of weirdnesses and edge-cases that pop up using `contenteditable`.[^2]

[^2]: E.g. (and this is pretty deep in the weeds) if you're using `contenteditable='true'` in a `<div>`, pressing `return` creates a new line, but doesn't move the cursor to the new line… *unless* the element is set to `display: inline-block`. *But*, if you are positioning the element with `flex` that over-rides the `display` setting, so you're stuck. Except!!—and I can't make any sense of this—if you use a `<span>` instead of a `<div>`, it works as expected, even with `flex`.

# Cancer Mode

Saroyan's poem duplicates the silent letters in `light`, but what if the silence didn't stop there? If it kept replicating? A rhyme between spelling and genetics—self-replicating sequences of silent letters as a cancer.

I had a vision of the silent letters on a site randomly replicating, until the page starts to fill up with silence. So I made it.

There's a function that recursively searches thru the DOM hierarchy, to get all the textnodes






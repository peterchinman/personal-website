---
title: Random Word Generator
slug: random-word-generator
date: 2024-12-30
subtitle: Find fate in the stochastic. Expand your vocabulary.
site: https://peterchinman.com/projects/random-word-generator
code: https://github.com/peterchinman/random-word-generator-site
tags:
  - project
  - featured
  - language
coolness: 9
---

I’ve long loved Random Word Generators. I’ve used them sporadically as part of my writing practice. I’d generate a list of random words and any time I felt the line start to slacken, I’d reach for one of them, to incorporate. To break me free of myself, which is the hardest part of writing. To surprise oneself. A source of surprise. 

Unfortunately all of the Random Word Generators online are ugly. [This is the one](https://wordcounter.net/random-word-generator) I like the look of best, and it is ugly. So I wanted to make my own.

I liked the way this one let you save words to a list.

I also wanted **built-in definitions.** To make this a tool for word-discovery. A random word generator is about being in love with language, and wanting to press yourself flat against, to touch as much of it at once as you can.

Growing up in the living room, we had a giant dictionary on a stand of its own. It was, in our deeply messy and middle-class house, a touch of yearning towards some higher status. An almost religious object. I remember standing at dictionary, which laid always open, and perusing, at near random. The dictionary was enormous, and suggested a breadth of vocabulary that seemed unthinkable.

Whereas now, in my day to day life, I rarely come across an unfamiliar word. Unless I’m reading a certain sort of author, those who seem to have worshipped at their own dictionary.

I catch myself sometimes holding my own vocabulary back. That, I reach at first for a word that, upon holding it in my mind’s hand, I suspect my interlocutor might be unfamiliar with, and so I exchange for another word or turn of phrase, because usually my goal is to be understood. I don’t think this is a noble impulse, but an act of cowardice. I don’t want people to feel uncomfortable and so I contract myself. And there’s a corresponding sense of relaxation when I’m talking to someone who I don’t feel this sense of needing to hold back from. And when I’m writing along—I can even use words that don’t exist. 

Also, I wasn’t sure about this, but I suspected that the available Random Word Generators were using a fairly limited dictionary. They rarely generate words I’m unfamiliar with.



To compare I sampled 40 random words from:

https://randomwordgenerator.com/
unfamiliar words: 0/40

https://wordcounter.net/random-word-generator
unfamiliar words: 1/40
- swot—informal ,British, *verb*, study assiduously

https://www.thewordfinder.com/random-word-generator/
unfamiliar words: none

MINE
unfamiliar words: 10/40
- themionic—adjective, of or relating to or characteristic of thermions (1. an ion or electron [emitted](https://www.google.com/search?sca_esv=a42936f75cf76306&sxsrf=ADLYWILmASk3KsfIpWBboCO1nnpiL1mC0g:1735275926829&q=emitted&si=ACC90nwUEXg6u2vxy-araGkF9MAx2rsH8Pk3f8k9KHdrCRwMclQr0pbs0kvOv4CnJnmCuRwMbEXwhEdMqnktkZkUZFEYUMss4Y_PlEB_BCD-Emyms9xwSj8%3D&expnd=1&sa=X&ved=2ahUKEwj0zdLJlseKAxUyFVkFHZX7BYgQyecJegQIFhAN) by a substance at high temperature.)
- cytotoxin—1. noun, any substance that has a toxic effect on cells
- hyalin— noun, a glassy translucent substance that occurs in hyaline cartilage or in certain skin conditions
- Manx—adjective, of or relating to the Isle of Man or its inhabitants or their language
- achenial—adjective, pertaining to dry one-seeded indehiscent fruit
- nohow—adverb, in no manner
- analphabet—noun, an illiterate person who does not know the alphabet
- escritoire—noun, a desk used for writing
- pteridological—1. adjective, of or relating to the study of ferns

To be honest, 25% unfamiliarity might make this worse for certain purposes.

Things I’d like to accomplish in the future.

Expand the dictionary.
Find other lists of words that I can cross-reference against my dictionary, to generate differing levels of rareness.
Alternatively, I’m imagining that you could attach a rare-ness score to each word, and then instead of sampling randomly, we could sample, weighted by rareness.

I’d like to be able to set certain restrictions like:
- number of syllables
- contains certain phonemes
- rhymes with
- 



# Making Of

The first task was to find a dictionary. You can download Wiktionary, but it’s huge, and I read that it’s difficult to work with. My research instead lead me to [Wordset](https://github.com/wordset/wordset-dictionary) which is an open source dictionary built on top of [WordNet](https://wordnet.princeton.edu/) which is an interesting project from Princeton that’s sort of like a super-powered thesaurus. Wordset as a project is defunct, but its available for download, its open source, and its arranged as a human-readable JSON. 

WordSet ~177,000 entries us OED 273,000 head-words (~600,000 definitions) vs English Wikitionary ~786k head-words (~1.5M defintions).

Once I’d settled on the dictionary, I converted it from a JSON to a SQLite database. Which was much more involved than that sentence suggests, because, at the time, the only programming language I knew was C++ and so I had to learn:
- How to read JSON with C++. Answer: the beautiful [nlohmann/json](https://github.com/nlohmann/json) library
- How to use SQLite with C++. I’d done some simple querying with SQLite when I did CS50 online, which I did not realize at the time, but abstracted away all of complications of actually interacting with SQLite.
- I got it all working, and then my computer chewed for a couple hours, constructing a SQL database from the JSON file.

Now I had a working database.

Next up, I designed it all in Figma. This 

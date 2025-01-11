---
title: Random Word Generator
slug: random-word-generator
subtitle: Find fate in the stochastic. Expand your vocabulary.
site: https://randomwordgenerator.info
code: https://github.com/peterchinman/random-word-generator-site
tags:
  - project
  - featured
  - language
coolness: 9
published: 2024-01-10
updated:
---

For years I've loved Random Word Generators. I've used them as part of my writing practice: when I sit down to write—long-hand, in my journal—I'd generate a list of random words and any time I felt the line start to slacken, I'd reach for one of the words to incorporate, to break me free of myself. I judged how well my writing was going by how related the words seemed.

Unfortunately all of the Random Word Generators online are ugly. [So I made my own](https://randomwordgenerator.info/).

Features I wanted:
- Beautiful
- Able to save words to a list
- Built-in definitions

I wanted this to be a tool not only for stochastic jiggling of ones thoughts, but also for word-discovery, hence the need for built-in definitions. To me, a random word generator is about being in love with language, about wanting to press yourself flat against it, to touch as much of a language as you can at once.

Growing up, in the corner of our living room, we had a giant dictionary on a stand of its own. It was, in our the midst of the mess of our house, an indication of yearning, an almost religious object, in the corner of a room in which often the floor was difficult to see for how strewn it was objects. I remember standing at the dictionary. It's pages were impossibly thin. I'd flip an inch or two of them over and see what word I'd landed on. It seemed enormous, both the dictionary, and the breadth of language it suggested one might possess.

Whereas now, in my day to day life, I rarely come across an unfamiliar word. I even catch myself sometimes stifling my own vocabulary. Discarding the first word that presents itself to me, and trading it for a more common synonym that I am more sure my interlocutor will understand. 'Orthogonal' traded for 'right angle'. It is, I think, a cowardly impulse. Or maybe it's just kind. I'm not sure. But it seems as if the span of my vocabularic horizons is shrinking—or at least stagnating—and I'd like to fight against that.

# Picking a Dictionary

The first task was to find a dictionary.

You can download Wiktionary, but it's huge, and I'd read that it's difficult to work with. My research instead lead me to [Wordset](https://github.com/wordset/wordset-dictionary) which is an open source dictionary built on top of [WordNet](https://wordnet.princeton.edu/), an interesting project from Princeton that's sort of like a super-powered thesaurus. Wordset as a project is defunct, but it's available for download, it's open source, and it's arranged as a easy-to-process JSON. It's also fairly large with ~177,000 entries.[^1]

Once I'd settled on the dictionary, I converted it from a JSON to a SQLite database. Which was much more involved than that sentence suggests, because, at the time, the only programming language I knew was C++ and so I had to learn:
- How to read JSON with C++. Answer: the lovely [nlohmann/json](https://github.com/nlohmann/json) library
- How to use SQLite with C++. I'd done some simple querying with SQLite when I did Harvard's CS50 course online, which, I did not realize at the time, had abstracted away all of complications of actually interacting with SQLite directly.

 I got it all working, and then my computer chewed for a couple hours, constructing a SQLite database from the JSON file. I tested it with a few queries, and it seemed to be working.

# Making it Beautiful

Next, I mocked it all up in Figma. This was one of my first big Figma projects—and the first time I'd actually used components to arrange everything, and set variables for all of the colors. Figma is such a beautiful piece of software to me—so perfectly suited for mocking things up for the web.

I designed first in grey-scale. And just kept, iterating. It works. No matter where you start, as long as you can keep making it better, you eventually end up with something nice. Which isn't true of, for example, poetry. Editing is very important, but, at least in my experience, if there's not something special in the poem from the start, there's only so much editing can do. Whereas, for me, with design, even my most crude stick-figure starting-point can eventually become beautiful.

I then sat on the grey-scale designs for a while, and coded up the whole website.

# Coding it

I converted my Figma designs to HTML & CSS.

One interesting thing I learned:


# Splash of Color

I'd coded the whole site in grey scale. I'm a little scared of color. But I wanted to put it out into the world, so I got my girlfriend, [a talented graphic designer](https://abigailrappaport.studio/about), to sit with me, and we each hacked on Figma for a couple hours, coming up with color palettes. I picked the four I liked best and set up some sliders so that you could change color schemes.

At first I thought it would be a simple matter of just setting different CSS variables for each of the colors, like this:

	body.cute.dark{
	    --bg-1: #506CE1;
	    --bg-2: #E0E1F7;
	    --subdued-ink: #637BE4;
	    --ink: #2C4FDB;
	    --accent: #F9D383;
	}

but, not all of the same elements mapped to the same colors between color schemes, so I actually had to define variables for almost every element individually, and write out all the re-mappings by hand.



# Results

Also, I wasn't sure about this, but I suspected that the available Random Word Generators were using a fairly limited dictionary. They rarely generate words I'm unfamiliar with.

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

Things I'd like to accomplish in the future.

Expand the dictionary.
Find other lists of words that I can cross-reference against my dictionary, to generate differing levels of rareness.
Alternatively, I'm imagining that you could attach a rare-ness score to each word, and then instead of sampling randomly, we could sample, weighted by rareness.

I'd like to be able to set certain restrictions like:
- number of syllables
- contains certain phonemes
- rhymes with
- 



# 

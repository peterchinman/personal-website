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

For years I've loved Random Word Generators. I’ve used them as a sporadic part of my writing practice: when I'd sit down to write, long-hand in my journal, I’d generate a list of random words and any time I felt the line start to slacken, I’d reach for one of the words to incorporate, to break me free of myself. And I could tell when the writing was going really well, because the random words would start to feel more and more related, perfectly chosen, fated.

Unfortunately all of the Random Word Generators online are ugly. [So I made my own](https://randomwordgenerator.info/).

# Features I Wanted
 
- Beautiful
- Built-in definitions
- Able to save words to a list

I wanted this to be a tool not only for the stochastic jiggling of one's thoughts, but also for word-discovery, hence wanting built-in definitions. I wanted this to be a tool one could use to love language—to pressing oneself flat against the surface of language, touching as much of it at once as one could. 

Growing up, in the corner of our living room, we had a giant dictionary on a stand of its own. In the midst of the mess of our house, in a living room otherwise dedicated to worshipping at the television screen—it was an object of yearning, of almost religious reaching. I remember standing there at the book. It must have been a foot thick. It's pages were so thin. The text in three columns on either side, with the deep cleft between.

I'd flip an inch or two of pages over and see what word I'd landed on. I could, in a matter of seconds, find the page containing the words: "sex", "sex appeal", "sex chromosome", "sex drive", "sex kitten". It seemed enormous, the way churches make god seem enormous.

Whereas now, in my day to day life, I rarely come across an unfamiliar word. I even catch myself sometimes stifling my own vocabulary. Trading the word that presents itself to me for a more common synonym that I am more sure my interlocutor will understand. 'Orthogonal' traded out for 'perpendicular'. It is, I think, a cowardly impulse.

# Picking a Dictionary

The first task was to find a dictionary to use.

There is of course [Wiktionary](https://en.wiktionary.org/wiki/Wiktionary:Main_Page), but it’s unwieldy, several gigabytes large, and I'd read that it’s difficult to work with. Further research led me to [Wordset](https://github.com/wordset/wordset-dictionary), an open-source collaborative dictionary that was active from 2015-2017. It's now defunct as a project, but you can still download it, and it's fairly large (~177k words), and the data is well-structured.

Once I’d settled on Wordset, I converted it from separate JSON files into one large relational database that I could query. Which was much more involved than that sentence suggests, because, at the time, the only programming language I really knew was C++, and I was so new to it that I had not yet worked with any external libraries.

I had to learn:

- How to parse JSON with C++ using the [nlohmann/json](https://github.com/nlohmann/json) library. 
- How to use the SQLite library. 

SQLite especially was a lot to get a grip on. I had used SQLite in the Harvard CS50 class I did when I started learning to code—but I hadn't realized how abstracted the interface they had provided was. There are seven SQLite functions that you have to use, in the correct order:

```C++
sqlite3_open()         // Open or create the database
sqlite3_prepare_v2()   // Prepare a SQL statement
sqlite3_bind_text()    // Bind data to sql parameters
sqlite3_step()         // Execute a statement and move to next row of the results
sqlite3_finalize()     // Clean up a statement after you are done with it
sqlite3_exec()         // To commit or rollback the transaction.
sqlite3_close()        // to close the database after you are done using it
```

And each of these have a number of arcane arguments that one needs to get right.

But I did get it working, tested it on a small dataset, and then let it chew thru the entire dictionary. I tested it with an inaugural query:

```
SELECT * FROM word ORDER BY RANDOM() LIMIT 20;
```

Success.

# Making it Beautiful

Next, I mocked up a design in Figma. This was my first big Figma project—the first time I used components to arrange everything, and used auto-layout, and set variables for all of the colors. Figma is such a beautiful piece of software, perfectly suited for mocking things up for the web.

I started with the phone-width design and designed exclusively in grey-scale. Both of which I highly recommend as starting points for any web design project. And then, I just... kept iterating. It works. As long as every time you touch it you make it better, if you just keep touching it, you end up with something nice.

# Coding It

The site is pretty simple. A form where you can set various filter options, a button which sends a request to the server, which queries the database and sends back a list of words. You can click on any of the words to open up a definition panel, where there's a bookmark icon that puts the word into a separate "Saved Words" list and also puts it in the browser's `localStorage` so that it persists across visits. 

# Splash of Color

I'd coded the whole site in grey scale. I am to be honest a little intimidated by color. Abigail, my parter and [a talented graphic designer](https://abigailrappaport.studio/about), *thinks* in color. I do not think in color. But I got her to sit beside me for a couple hours, and we both were on our computers in the same Figma file, which has nice multi-player mode, and we worked on color schemes. We came up with a few that I liked, and I set up some switches on the site to move between them.

At first I thought it would be a simple matter of just resetting a small selection of CSS variables for each of the color schemes, like this:

```CSS
body.cute.dark{
	--bg-1: #506CE1;
	--bg-2: #E0E1F7;
	--subdued-ink: #637BE4;
	--ink: #2C4FDB;
	--accent: #F9D383;
}
```

But: not all of the same elements were mapped to the same colors when you switched between color schemes. So I had to write out all the re-mappings by hand.

# How Random

I wasn’t sure about this, but had I suspected that the available Random Word Generators online were using a fairly limited dictionary. They rarely generated words I was unfamiliar with. Whereas, using the Wordset dictionary, but Random Word Generator seemed particularly, *random*.

To compare I sampled 40 random words each of the following dictionaries and record the words I didn't recognize:

https://randomwordgenerator.com/

Unfamiliar words: 0/40.

https://wordcounter.net/random-word-generator

Unfamiliar words: 1/40.

- swot—informal, British, *verb*, study assiduously

https://www.thewordfinder.com/random-word-generator/

Unfamiliar words: none.

[My Random Word Generator](https://randomwordgenerator.info/)

Unfamiliar words: 10/40.

- themionic—adjective, of or relating to or characteristic of thermions
- cytotoxin—noun, any substance that has a toxic effect on cells
- hyalin—noun, a glassy translucent substance that occurs in hyaline cartilage or in certain skin conditions
- Manx—adjective, of or relating to the Isle of Man or its inhabitants or their language
- achenial—adjective, pertaining to dry one-seeded indehiscent fruit
- nohow—adverb, in no manner
- analphabet—noun, an illiterate person who does not know the alphabet
- escritoire—noun, a desk used for writing
- pteridological—1. adjective, of or relating to the study of ferns

A big difference! To be honest, 25% unfamiliarity might be undesirable for certain purposes. 

# Features to Add

One feature I want to add is to have users be able to select from various levels of word prevalence. I'm sure there's a "10,000 most common English words" list out there somewhere. Or alternatively I could look up each word on Google Ngrams and get a score. 

I'd also like to cross-reference each word in my database against the CMU Pronouncing Dictionary, so that you can search by phonological characteristics: "number of syllables", "rhymes with", etc.

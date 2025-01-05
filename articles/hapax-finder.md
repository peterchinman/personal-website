---
title: Hapax Legomenon Finder
slug: hapax-finder
date: 2024-04-25
subtitle: Find hapaxes from the safety of your home.
site: https://peterchinman.com/hapax-finder
code: https://github.com/peterchinman/hapax_site
tags:
  - project
  - featured
  - language
coolness: 7
---

A _hapax legomenon_ (abbreviated to _hapax_, pl. _hapax legomena_) is a word that’s used only once in a body of text. The term comes from the study of ancient texts. Hapax legomena are the prickly outliers of translation—words that come to us with only a single context from which we can try to infer their meanings.

I’m interested in these prickly points. The silhouette of vocabulary. That which makes a body of text unique.

I’d been studying C++ for a few weeks, and a hapax finder seemed like a project I could achieve. The steps were fairly simple:

1. Open the text.
2. Read thru it word-by-word, recording each word you come across and the number of times you’ve come across it.
3. Once you’re read it all, spit out all the words that you’ve come across only once.

The trickiest part was dealing with punctuation. The algorithm would read in each word until it encountered whitespace, including whatever punctuation clung to the word. So I needed to strip away the punctuation, but I also want to include compound words, with an internal dash—e.g. “half-unhinged”. And—one last wrinkle—if the algorithm read in, e.g. “wrinkle—if”, it needed to know that those were two words that it should record separately.

Ok, easy enough—I crafted a Regular Expression to match all the sorts of words I wanted, and then iterated across the matches to catch each separate word, and then added them to a hand-crafted hash-table I made, for quick look-up, not realizing that C++ already comes with “unordered_map”—it’s own implementation of a hash-table.

Then the exciting part—finding texts to feed thru. [Project Gutenberg](https://www.gutenberg.org/) has an archive of public domain books. I picked out Moby Dick—a book I loved, and one I suspected would be full of good hapaxes. Beep beep boop boop. A list of 8,622 hapaxes. Very good algorithm.

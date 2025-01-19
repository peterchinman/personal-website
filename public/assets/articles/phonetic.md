---
title: Phonetic
slug: phonetic
subtitle: A C++ library for working with the CMU Pronouncing Dictionary.
code: https://github.com/peterchinman/phonetic
tags:
  - project
  - language
coolness: 5
published: 2024-04-25
---

The [CMU Pronouncing Dictionary](http://www.speech.cs.cmu.edu/cgi-bin/cmudict#about) (CMUdict) describes itself as:

> an open-source machine-readable pronunciation dictionary for North American English that contains over 134,000 words and their pronunciations.

It's the go-to dataset for pronunciations in English. There's various tooling that uses it, e.g. [this Python library](https://github.com/aparrish/pronouncingpy). But I was working in C++, building WebAssembly projects, and by the third time I was copy-pasting this code into a new project I decided it was time to make this into a small, self-complete library.

It's a simple library, that can easily be used in other project in which you need access to the pronunciations of English words.

I use it in:
- [Strictly](https://peterchinman.com/blog/strictly)
- [Lighght](https://peterchinman.com/blog/lighght)

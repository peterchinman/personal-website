<div class="blog-title">Strictly</div>
<p class="blog-subtitle">Compose poems with strict rhyme & meter</p>

I wanted to make a tool that would help someone compose poems in strict forms, but in a way that trusted the author when they wanted to deviate from the form. Guiding but not ruling. To do that I needed to work in a lot of fuzziness.
# Rhyme

When people talk about rhyme they usually mean "perfect rhyme"—

- "boss" / "toss"
- "pulley" / "bully"

Perfect rhyme is boring. And evil. It pushes soulless pedants to say things like "nothing rhymes with orange". Rhyme is one of our fundamental tools of linguistic expression, and perfect rhyme flattens it into a pompous child's play-thing.

So, for the Rhyme Checker I didn't want to ask "do these words rhyme?" I wanted, instead, a measure of distance between pronunciations. Zero distance: yes, perfect rhyme—but widen the rhyme-aperture and you get to behold the rhyme between "orange" and "door hinge" in all of its glory.

## Step One: Vowels

The first step was to find a measure of distance between vowels.

Vowels can be mapped into a 2-D space, where the axes are the first and second formant frequencies.

This might lead one to the natural thought of using Euclidean Distance to measure vowel distance. I think this could work. But there are complications that made me want to avoid it.[^1]

[^1]: My primary concern is that—while vowel space is continuous—perceptually, vowels are discrete. What matters is not the *distance* between vowels, but the *difference* between vowels. 

	For example, consider the words "bat", "bet", and "bot".

	Using the "reasonable average frequencies of F1 and F2… for a male voice"[^2] we would get get a Euclidean distances of: 
	```
	bat -> bet: 191.64
	bat -> bot: 787.48
	```
	But the vowels in "bet" and "bot" are each—in, I think, a meaningful sense—"adjacent" to the vowel in "bat": one can move thru vowel space from one to the other without encountering another vowel.
	
	One reason for the discrepancy in the distances is that they are moving along different axes from “bat”—"bet" along the F1 axis, and "bot" along the F2 axis. We could try to correct for that by scaling the axes. But it’s not obvious that this would be a fool-proof solution either, given that we have different perceptual responses to different frequencies of sound.



[^2]: Source 1: https://linc2018.wordpress.com/wp-content/uploads/2018/06/a-practical-lntroduction-to-phonetics.pdf p. 154. 

I wanted a system for measuring distance that was based in adjacency. Thus was born the Vowel Hex Graph.

### Vowel Hex Graph

The vowels used in the CMU Pronouncing Dictionary can be arranged into a hexagonal grid, as if that was how they were always meant to be arranged.[^3] It is a perfect abstraction, whose beauty seems to be evidence of its truth. Distance could be measure by counting how many hexagonal tiles you would have to move to get from one vowel to another. Life would be lovely and everything would make perfect sense. Until, that is, one remembered the diphthong problem.

[^3]: The idea appeared to me in a dream.

<pre><code class="small-code code">
     ..         .          .         ..           
  .::  .=.   .=.  ::.  .::  .=.   .=.  ::.        
.:.       .=.       .::.       .=.       .:       
..   IY    =    IH   .    UH    =    UW   .       
..         =         .          =         .       
..        .=.        ..        .=.        .       
   =.  .-.   ::   .=    +.   -:   .-.  .=         
     .-         -.        .-         -.           
      :   EH    :    AH    :    AO   -            
      :         :          :         -            
      -.       .-.        .-.        -            
       ..=   +..  .-.  .-.  ..=   =..             
          .=.        ..         =                 
           =    AE   .   AA     =                 
           =         .          =                 
           =:.      .::.      ..=                 
             .:: .-.    .=. ::.             
</code></pre>

### The Diphthong Problem

![[CleanShot 2024-12-14 at 23.02.23@2x.png]]

Some vowels are not just points in vowel space. What we call "diphthongs" are a movement between two points in vowel space. For example, the vowel in "boy"—if you slow down your pronunciation you can hear the sound moving from a vowel near "oh" to a vowel near "ee".

This raises the thorny problem of what exactly we mean by “the distance between” a single-point vowel (called a monophthong) and a diphthong. Do we measure from the starting point of the diphthong? The ending point? From the closest point to the vowel we're measuring it against? 

Or should we not treat a diphthong as *a* vowel at all, but as in fact two separate vowels? This seems attractively rigorous, but I’m not sure it tracks with how we typically conceive of vowels in English? Maybe I’ll try this method out at some point and compare the results. 

What I did instead is that I sat down, pronouncing the vowel sounds to myself, building on top of the beautiful abstract edifice of the Vowel Hex Graph, an arbitrary / idiosyncratic maze of adjacencies.

### Vowel Distance

Once we have a full graph of vowel adjacencies, we do a [Breadth-First Search](https://en.wikipedia.org/wiki/Breadth-first_search) to find the shortest distance between them.

This was my first graph algorithm, very cool.

## Step Two: Consonants

The next step is to find the distance between consonants. But I haven’t actually implemented this yet because consonants are significantly more complex than vowels.

## Step Three: Distance

For now, let’s pretend that we have a system for measuring vowel-to-vowel distance *and* consonant-to-consonant distance. Now we want to find the distance between two entire words. First we convert them each to [IPA](https://en.wikipedia.org/wiki/International_Phonetic_Alphabet#:~:text=The%20International%20Phonetic%20Alphabet%20(IPA,for%20the%20sounds%20of%20speech.), using the CMU Pronouncing Dictionary. Now we have two strings of phonemes, that we want to find the distance between.

My first thought was to use [Levenshtein distance](https://en.wikipedia.org/wiki/Levenshtein_distance) which is “the minimum number of single-character edits (insertions, deletions or substitutions) required to change one word into the other”. But I wanted to be able to match up vowels-to-vowels and consonants-to-consonants, and, at first glance, Levenshtein distance didn’t seem to offer a means to do this.

So I went searching. Who has spent a lot of time thinking about ways of calculating distance between “strings” of data? Answer: biologists.

### Bioinformatics

Biologists want to be able to ask: given two sequences of amino acids or nucleotides, what is the way of aligning them the




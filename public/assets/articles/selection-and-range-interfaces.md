---
title: Using <code>Selection</code> and <code>Range</code> Interfaces in Javascript for Text Caret Placement
slug: selection-and-range-interfaces
subtitle: 
tags:
  - blog
  - coding
  - javascript
published: 2025-01-19
---

I was making a [Silent Letter Detector](https://peterchinman.com/blog/lighght) that had a text field where users could write text that would be checked, live, for silent letters, which would be marked with `<span>`s. Similar to a spell-checker squiggly-underlining mispelled words.

You can't use `<textarea>` in this case because `<textarea>` can't contain spans. Instead I used the `contenteditable='true'` attribute, which was new to me.

The first problem I ran into is that, because I'm reading the text from my `textfield`, processing it, and then replacing the `textfield` with the marked-up text, I need to handle the text caret placement myself, or else it gets reset to the beginning of the `textfield`. This is done using the `Selection` and `Range` interfaces. You need to 1) get the caret position from the `textfield`, process the text, and then 2) set the caret position to put it back where it should be.

# Get the Caret Position

[According to MDN docs](https://developer.mozilla.org/en-US/docs/Web/API/Selection), the `Selection` object "represents a range of text selected by the user or the current position of the caret".

So we want first get the current `Selection` object from the `window`. This gives us the current caret position.

Next we want to get a `Range` object from this `Selection`. These objects are similar, but the important distinction here is that you can definte multiple `Range` objects, which we'll be doing here, while you can only have one `Selection` object per window. We then clone that `Range`, and expand the clone to include the entire `textfield`. We can then set the end of the clone to the position of our original `Range`, which was pointing to the current caret position. Now we have a `Range` that contains the all of the `textfield` up to the current caret position.

If we then convert that to a string, and count up the characters, we have our current caret index.

```Javascript
function getCaretPosition() {
	const selection = window.getSelection(); // caret position or selection
	if (!selection.rangeCount) return null; // exit if no selection

	const range = selection.getRangeAt(0); // get the forward edge as a Range
	const preCaretRange = range.cloneRange(); // clone it
	preCaretRange.selectNodeContents(textfield); // expand the clone
	preCaretRange.setEnd(range.endContainer, range.endOffset); // set clone end

	return preCaretRange.toString().length; // the caret's character index
}
```


# Set the Caret Position

To set the caret position we need to count our way up to the correct position, but there might be various `nodes` in the way, because we've marked up the text with `<span>`s. So we need to recursively traverse all of these Text nodes, counting up how many characters we've seen, so that we can place a `Range` object at the correct position. We we can then set the `Selection` to this `Range`.

```Javascript
function setCaretPosition(position) {
	const selection = window.getSelection();  // selection object
	const range = document.createRange();  // range object
	let charCount = 0;

	function traverseNodes(node) {. // recursive traversal function
		if (node.nodeType === Node.TEXT_NODE) { 
			const nextCharCount = charCount + node.textContent.length;
			// If desired position is inside this node, set it
			if (position <= nextCharCount) {
			range.setStart(node, position - charCount);
			range.collapse(true);
			return true;
			}

			// Otherwise reset charCount and keep going
			charCount = nextCharCount;
		}
		// If we're not at a Text node, recurse!
		else {
			for (let i = 0; i < node.childNodes.length; i++) {
			if (traverseNodes(node.childNodes[i])) return true;
			}
		}
		return false;
	}

	traverseNodes(textfield);
	selection.removeAllRanges();
	selection.addRange(range);
}
```



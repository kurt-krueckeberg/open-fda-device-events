# Search Syntax

## Basic Search

In the **openFDA** search syntax

```XQuery
search=field:"term"
```

the search term follows the field to search, separated by a colon.

**TODO:** You can do `search=field="term"`, too--right?

 If the term is only one word, the quotes are not needed; otherwise, they are.
In the query below the **drug/event** endpoint is search for a record where one of the reported patient reactions was fatigue:

```Text
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"&limit=1
```

`patient.reaction.reactionmeddrapt` is the patient reaction to a prescribed medication.

## Spaces and Phrase Matches

Queries use the plus sign `+` in place of the space character. Wherever you would use a space character, use a plus sign instead.

For phrase matches, use double quotation marks " " around the words and use a `+` in place of the space between the words:

| Search parameter   |  Phrase Searched for |
:------------------- | :-------------------------
`"multiple+myeloma"` | "multiple myeloma"
`"dry+eye+syndrome"` | "dry eye syndrome"
`"periperhal+neuropathy"` | "peripheral neuropathy"

:::{note}
Add an example and its result or make it iteractive.
:::

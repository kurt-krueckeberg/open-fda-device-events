# Search Syntax

## Basic Search

In the **openFDA** syntax to search a field

```XQuery
search=field:"term"
```

the search term immediately follows the field to search, separated by a colon. The query below searches
the **drug/event** endpoint for a record where one of the reported patient reactions was fatigue:

```Text
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"&limit=1
```

`patient.reaction.reactionmeddrapt` is the patient reaction to a prescribed medication. It is searched for **fatigue**:

:::{note}
Add example's result or make it iteractive.
:::

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

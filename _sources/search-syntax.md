# Search Syntax

## Search Terms

Searches have a special syntax

`search=field:"term"`

where the search term immediately follows the field being search, separated by a colon. For example, this query looks in the **drug/event** endpoint for a
record where one of the reported patient reactions was fatigue:

`https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"&limit=1`

Here `patient.reaction.reactionmeddrapt` is the patient reaction to a prescribed medication. It is searched for **fatigue**.

:::{note}
Add example's result or make it iteractive.
:::

## Spaces

Queries use the plus sign `+` in place of the space character. Wherever you would use a space character, use a plus sign instead.

:::{note}
Add an example and its result or make it iteractive.
:::

## Phrase matches

For phrase matches, use double quotation marks " " around the words. For example,

- `"multiple+myeloma"`.
- `"dry+eye+syndrome"`
- `"periperhal+neuropathy"`

:::{note}
Add an example and its result or make it iteractive.
:::

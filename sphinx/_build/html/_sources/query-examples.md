# Query Examples

## Matching all search terms

Search terms can be combined with **AND** to match both search terms or with **+** to match either of two terms. The query below looks in the
**drug/event** endpoint for a record where **both** fatigue was a reported patient reaction **and** the country in which the event happened
was Canada:

`https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+AND+occurcountry:"ca"&limit=1`

## Matching any search terms

This query looks in the **drug/event** endpoint for a record where **either** fatigue was a reported patient reaction **or** the country in which the event happened was Canada:

`https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+occurcountry:"ca"&limit=1`

## Sort ten results in descending order

This query looks in the **drug/event** endpoint for ten records and sorts them in descending order by received date:

`https://api.fda.gov/drug/event.json?sort=receivedate:desc&limit=10`

:::{hint}
Instead of looking at individual records, you can use the count parameter to count how often certain terms (like drug names or patient reactions) appear in the matching set of records.
:::

## Count number of unique matching records

| `count` syntax                      | Explanation                                                                                                                      |
|:------------------------------------|:----------------------------------------------------------------------------------------------------------------|
| `search=field1:term&count=field2`   | Search for matching records and, then, within that set of records, count the number of times that the unique values of a `field2` appear.|

This query looks in the **drug/event** endpoint for all records. It then returns a count of the top patient reactions. For each reaction, the number of records
that matched is summed, providing a useful summary.

Search for all records

We `count` the number of records matching the terms in `patient.reaction.reactionmeddrapt.exact`. The `.exact` suffix here tells the API to count whole
phrases (e.g. injection site reaction) instead of individual words (e.g. injection, site, and reaction separately):

`https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact`

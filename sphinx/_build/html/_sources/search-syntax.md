# Search Syntax

## Basic Search Syntax

In the **openFDA** search syntax

```XQuery
search=field:term
```
the search term follows the field to search, separated by a colon.

:::{note} 
Parentheses are needed when searching for pharses. See ????
:::

## Boolean OR Searches

To search for records that match either of two search terms or two search two or more fields for combined results, use the `+` for logical OR:

Below we search for two terms in the `device.device_report_product_code` field:

<https://api.fda.gov/device/event.json?search=device.device_report_product_code="HQF"+device.device_report_product_code="LZS">

You can also search two different fields and return the union of the results of each, i.e.,  a logical OR. Below we query the
**drug/event** endpoint for a record where either fatigue was a reported patient reaction or the country in which the event happened was Canada.

<https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+occurcountry:"ca"&limit=1>

## Boolean AND Searches

search=field:term+AND+field:term: Search for records that match both terms.

## Using Grouping

To group several terms together, use parentheses `( )`. For example, this boolean OR search 
`search=patient.drug.medicinalproduct:cetirizine+patient.drug.medicinalproduct:loratadine+patient.drug.medicinalproduct:diphenhydramine`
is equivalent to `search=patient.drug.medicinalproduct:(cetirizine+OR+loratadine+OR+diphenhydramine)`.

## Searches with `:` vs `=`

**TODO:** You can do `search=field="term"`, too--right?

## Searching for Phrases

For phrase matches, use double quotation marks " " around the words and use a `+` in place of the space between the words:

| Search parameter   |  Phrase Searched for |
:------------------- | :-------------------------
`"multiple+myeloma"` | "multiple myeloma"
`"dry+eye+syndrome"` | "dry eye syndrome"
`"periperhal+neuropathy"` | "peripheral neuropathy"

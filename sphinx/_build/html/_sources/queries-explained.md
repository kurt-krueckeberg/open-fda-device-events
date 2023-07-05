# Queries

## JSON Results Object
 
The JSON results object has two sections:

1. `results` &mdash; An arrray of matches (for non-counting querires).

2. `meta` &mdash; metadata:

   | Meta Field           | Details                                                                                                                                                                                                         |
   |:---------------------|:----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
   | `meta.disclaimer`    | Important details notes about openFDA data and limitations of the dataset.                                                                                                                                      |
   | `meta.license`       | Link to a web page with license terms that govern data within openFDA.                                                                                                                                          |
   | `meta.last_updated`  | The last date when this openFDA endpoint was updated. Note that this does not correspond to the most recent record for the endpoint or dataset. Rather, it is the last time the openFDA API was itself updated. |
   | `meta.results.skip`  | The skip is the **page offset** of the results.
   | `meta.results.limit` | **Number of records** returned, as defined by the *limit* query parameter. If there is no limit parameter, the API returns one result. |
   | `meta.results.total` | **Total number of records** matching the search criteria. |
                                                                                                                                           
## Query Parameters

The API supports five query parameters:

| Parameter type | How it is used                                                                                                                      |        
|:---------|:---------------------------------------------------------------------------------------------------------------------------------|
|`search`| What to search for, in which fields. If you don’t specify a field to search, the API will search in every field.|
|`sort`| Sort the results of the search by the specified field in ascending or descending order by using the `:asc` or `:desc` modifier.|
|`count`| Count the **number of unique values** of a certain field, for all the records that matched the search parameter. By default, the 1000 most frequent values are returned.|
|`limit`| Return up to this number of records that match the search parameter. Currently, the largest allowed limit is 1000.|
|`skip`| Skip this number of records that match the search parameter, then return the matching records that follow. Use `skip` in combination with `limit` to paginate results. Currently, the largest allowed value for the skip parameter is 25000. |

## Search Syntax

Searches have a special syntax

`search=field:term`

where the search term immediately follows the field being search, separated by a colon. For example, this query looks in the **drug/event** endpoint for a
record where one of the reported patient reactions was fatigue:

`https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"&limit=1`

Here `patient.reaction.reactionmeddrapt` is the patient reaction to a prescribed medication. It is searched for **fatigue**.

### Examples

#### Matching all search terms

Search terms can be combined with **AND** to match both search terms or with **+** to match either of two terms. The query below looks in the
 **drug/event** endpoint for a record where **both** fatigue was a reported patient reaction **and** the country in which the event happened
was Canada:

`https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+AND+occurcountry:"ca"&limit=1`

#### Matching any search terms

This query looks in the **drug/event** endpoint for a record where **either** fatigue was a reported patient reaction **or** the country in which the event happened was Canada:

`https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+occurcountry:"ca"&limit=1`

### Sort ten results in descending order 

This query looks in the **drug/event** endpoint for ten records and sorts them in descending order by received date:

`https://api.fda.gov/drug/event.json?sort=receivedate:desc&limit=10`

:::{hint}
Instead of looking at individual records, you can use the count parameter to count how often certain terms (like drug names or patient reactions) appear in the matching set of records.
:::

### Count number of unique matching records

| `count` syntax                      | Explanation                                                                                                                      |
|:------------------------------------|:----------------------------------------------------------------------------------------------------------------|
| `search=field1:term&count=field2`   | Search for matching records and, then, within that set of records, count the number of times that the unique values of a `field2` appear.|

This query looks in the **drug/event** endpoint for all records. It then returns a count of the top patient reactions. For each reaction, the number of records
that matched is summed, providing a useful summary.

Search for all records

We `count` the number of records matching the terms in `patient.reaction.reactionmeddrapt.exact`. The `.exact` suffix here tells the API to count whole
phrases (e.g. injection site reaction) instead of individual words (e.g. injection, site, and reaction separately):

`https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact`

## Queries

### JSON Results
 
There are two sections:

1. `results` &mdash; An arrray of matches (for non-counting querires).

2. `meta` &mdash; metadata:

   | Meta Field           | Details                                                                                                                                                                                                         |
   |:---------------------|:----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
   | `meta.disclaimer`    | Important details notes about openFDA data and limitations of the dataset.                                                                                                                                      |
   | `meta.license`       | Link to a web page with license terms that govern data within openFDA.                                                                                                                                          |
   | `meta.last_updated`  | The last date when this openFDA endpoint was updated. Note that this does not correspond to the most recent record for the endpoint or dataset. Rather, it is the last time the openFDA API was itself updated. |
   | `meta.results.skip`  | **Offset (page) of results,** defined by the *skip* query parameter.                                                                                                                                            |
   | `meta.results.limit` | **Number of records** in this return, defined by the *limit* query parameter. If there is no limit parameter, the API returns one result.                                                                       |
   | `meta.results.total` | **Total number of records** matching the search criteria. |
                                                                                                                                           
### Query Parameters

The API supports five query parameters:

| Parameter type | How it is used                                                                                                                      |        
|:---------|:---------------------------------------------------------------------------------------------------------------------------------|
|`search`| What to search for, in which fields. If you don’t specify a field to search, the API will search in every field.|
|`sort`| Sort the results of the search by the specified field in ascending or descending order by using the `:asc` or `:desc` modifier.|
|`count`| Count the number of unique values of a certain field, for all the records that matched the search parameter. By default, the API returns the 1000 most frequent values.|
|`limit`| Return up to this number of records that match the search parameter. Currently, the largest allowed value for the limit parameter is 1000.|
|`skip`| Skip this number of records that match the search parameter, then return the matching records that follow. Use in combination with limit to paginate results. Currently, the largest allowed value for the skip parameter is 25000. See Paging if you require paging through larger result sets.|

### Search Syntax

Searches have a special syntax: `search=field:term`. This query, for example, looks in the **drug/event** endpoint for a record where one of the reported patient reactions was fatigue. Search for records where the
field `patient.reaction.reactionmeddrapt` (patient reaction) contains **fatigue**:

```html
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"&limit=1
```

Search terms can be combined with **AND** to match both search terms or with **+** to match either of two terms.

#### Examples

##### Matching all search terms

This query looks in the  **drug/event** endpoint for a record where **both** fatigue was a reported patient reaction **and** the country in which the event happened was Canada:

```html
 https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+AND+occurcountry:"ca"&limit=1
```

##### Matching any search terms

This query looks in the **drug/event** endpoint for a record where **either** fatigue was a reported patient reaction **or** the country in which the event happened was Canada:

```html
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+occurcountry:"ca"&limit=1
```

#### Sort ten results in descending order 

This query looks in the **drug/event** endpoint for ten records and sorts them in descending order by received date.

```html
https://api.fda.gov/drug/event.json?sort=receivedate:desc&limit=10
```

#### Count number of unique records???

**TODO:** Better explain and illustrate `count`.

 `search=field1:term&count=field2`     Search for matching records. Then within that set                                                        
                                       of records, count the number of times that the unique values of a `field2` appear. Instead of looking at
                                       individual records, you can use the count parameter to count how often certain terms (like drug names or
                                       patient reactions) appear in the matching set of records.
 ------------------------------------- ------------------------------------------------------------------------------------------------------------

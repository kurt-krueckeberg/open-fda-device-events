# Query Parameters

The **openFDA** API supports these five query parameters:

| Parameter type | How it is used                                                                                                              |
|:---------|:---------------------------------------------------------------------------------------------------------------------------------|
|`search`| What to search for and in which fields. If you don’t specify a field to search, the API will search in every field.|
|`sort`| Sort the results of the search by the specified field in ascending or descending order by using the `:asc` or `:desc` modifier.|
|`count`| Count the **number of unique values** of a certain field, for all the records that matched the search parameter. By default, the 1000 most frequent values are returned.|
|`limit`| Return up to this number of records that match the search parameter. Currently, the largest allowed limit is 1000.|
|`skip`| Skip this number of records that match the search parameter, then return the matching records that follow. Use `skip` in combination with `limit` to paginate results. Currently, the largest allowed value for the skip parameter is 25000. |

:::{note}
`count` returns unique records. The `meta.results.total` field returned in every query returns the total number of records.
:::

The query parameters above are separated by `&`. In the query below, for example, the `search` parameter is spearated from the `limit` parameter
by `&`:

- Query in the drug/event endpoint for ten records and sorts them in descending order by received date:
  <https://api.fda.gov/drug/event.json?sort=receivedate:desc&limit=10>

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

todo: complete text here.

## `:` vs `=`


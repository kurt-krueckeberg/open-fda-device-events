# Query Parameters

The **openFDA** API supports these five query parameters:

| Parameter type | How it is used                                                                                                              |
|:---------|:---------------------------------------------------------------------------------------------------------------------------------|
|`search`| What to search for and in which fields. If you don’t specify a field to search, the API will search in every field.|
|`sort`| Sort the results of the search by the specified field in ascending or descending order by using the `:asc` or `:desc` modifier. |
|`count`| Count the **number of unique values** of a certain field, for all the records that matched the search parameter. By default, the 1000 most frequent values are returned. |
|`limit`| Return up to this number of records that match the search parameter. Currently, the largest allowed limit is 1000. |
|`skip`| Skip this number of records that match the search parameter, then return the matching records that follow. Use `skip` in combination with `limit` to paginate results. Currently, the largest allowed value for the skip parameter is 25000. |

:::{important}
Remember: query parameters must be separated by `&`
:::
Query paramters must be separated by `&`; for example, if the `limit` parameter is used along with the `sort` parameter to return the first ten adverse drug even records (sorted in descending order by received date)

<https://api.fda.gov/drug/event.json?sort=receivedate:desc&limit=10>

then the `limit` parameter must be separated from the `sort` parameter (and its sort criteria) by an `&`.

## `search`

A search of the form `search:field:term` searches for the occurance of the term in the field.

<https://api.fda.gov/drug/ndc.json?search=brand_name:Advil&limit=1000>

searches the `brand_name` field for any occurance of "Advil". Thus, brand names like

- "JUNIOR STRENGTH ADVIL"
- "ADVIL PM- diphenhydramin…buprofen tablet, coated"
- "Advil Sinus Congestion and Pain"

will all be found. `search:field:term` searches for the occurance of the term in the field. If the term is a phrase, then any occurance of the phrase is search. For example, the query 
below

<https://api.fda.gov/drug/ndc.json?search=brand_name:%22Congestion+and+Pain%22&limit=6>

searches `brand_name` for the phrase `Congestion and Pain`. Thus it will find brand names like these

- "Maximum Strength Mucinex Sinus-Max Severe Congestion and Pain and Mucinex Nightshift Sinus"
- "Maximum Strength Mucinex Sinus-Max Severe Congestion and Pain and Mucinex Nightshift Sinus"
- "Mucinex-Sinus Max Severe Congestion and Pain Clear and Cool and Mucinex Nightshift Sinus Clear and Cool"

To use another example, this query

<https://api.fda.gov/drug/ndc.json?search=pharm_class:Decreased&limit=10>

search the `pharm_class` any occurance of "Decrease". Thus "Decreased Respiratory Secretion Viscosity [PE]",  "Decreased Prostaglandin Production [PE]", and 
"Decreased Platelet Aggregation [PE]" will all be found.

### `search` on `.exact` fiels

Question: What is the default behavoir of

 "pharm_class": [
        "Anti-Inflammatory Agents",
        "Non-Steroidal [CS]",
        "Cyclooxygenase Inhibitors [MoA]",
        "Nonsteroidal Anti-inflammatory Drug [EPC]"
      ]

<https://api.fda.gov/drug/ndc.json?search=pharm_class:Decreased&limit=10>


### `search` Questions

Question: What does `search=field=true` do or mean?  For example,

<https://api.fda.gov/drug/ndc.json?search=pharm_class=true>

Question: What does `_exist_` do. For example,

<https://api.fda.gov/drug/ndc.json?search=_exists_:openfda.pharm_class_cs&count=pharm_class.exact>

### `search` and `.exact` fields

## the `count` parameter

`count` counts **unique values** of a certain fields; for example, in the query

`https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact`

the number of unique phrases found in `patient.reaction.reactionmeddrapt.exact` is counted. The `.exact` suffix tells the API
to count whole phrases (e.g. "DRUG INEFFECTIVE") instead of individual words (e.g. "DRUG" and "INEFFECTIVE" separately).

`count` is also often used along with `search`. Below the **drug/ncd** endpoint is searched for brand names that contain "Advil". The unique number of `pharm_class.exact` is returned.

<https://api.fda.gov/drug/ndc.json?search=brand_name:Advil&count=pharm_class.exact>

Question: Can only `.exact` fields be searched? For example, <https://api.fda.gov/drug/ndc.json?count=pharm_class.exact> return results, but without the `.exact` suffix no results are returned

<https://api.fda.gov/drug/ndc.json?count=pharm_class>

##  `.exact` fields

This information is taken from <https://opendata.stackexchange.com/questions/20112/the-difference-between-exact-with-suffix-and-without-suffix>

Fields that permit an `.exact` suffix have been indexed in two forms in the openFDA ElasticSearch database. A field without the `.exact` suffix has been tokenized to
allow flexible partial searches. For example, consider the following query: <https://api.fda.gov/drug/ndc.json?search=brand_name:Advil&limit=1000>. This will return all
drugs that contain "Advil" within their brand name, such as "CHILDRENS ADVIL", "ADVIL MIGRAINE", and so on.

Now try adding the suffix

<https://api.fda.gov/drug/ndc.json?search=brand_name.exact:Advil&limit=1000>

You will see fewer results, and each result will have its `brand_name`` exactly that: Advil. Exact value match is now required.


### `__exists__` searches

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

## Searches with `:` vs `=`


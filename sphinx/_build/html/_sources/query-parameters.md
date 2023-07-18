# Query Parameters

The **openFDA** API supports these five query parameters:

| Parameter type | How it is used                                                                                                              |
|:---------|:---------------------------------------------------------------------------------------------------------------------------------|
|`search`| What to search for and in which fields. If you don’t specify a field to search, the API will search in every field.|
|`sort`| Sort the results of the search by the specified field in ascending or descending order by using the `:asc` or `:desc` modifier. |
|`count`| Count the **number of unique values** of a certain field, for all the records that matched the search parameter. By default, the 1000 most frequent values are returned. |
|`limit`| Return up to this number of records that match the search parameter. Currently, the largest allowed limit is 1000. |
|`skip`| Skip this number of records that match the search parameter, then return the matching records that follow. Use `skip` in combination with `limit` to paginate results. Currently, the largest allowed value for the skip parameter is 25000. |

Query paramters must be separated by `&`; for example, `limit` used along with `sort`:

<https://api.fda.gov/drug/event.json?sort=receivedate:desc&limit=10>

:::{important}
Use `&` to separate query parameters.
:::

## Searches

`search=field:term` searches for any occurance of "term" in the `field`. It does do `field=term` exact matching.

The query `search=brand_name:Advil` searches for any occurance of **Advil** in `brand_name`:

<https://api.fda.gov/drug/ndc.json?search=brand_name:Advil&limit=1000>

It returns `brand_name`'s like

- "JUNIOR STRENGTH **ADVIL**"
- "**ADVIL** PM- diphenhydramin…buprofen tablet, coated"
- "**Advil** Sinus Congestion and Pain"

and so on. If the search term is a phrase like "Congestion and Pain", the entire phrase must occur in `brand_name`. 
The query

<https://api.fda.gov/drug/ndc.json?search=brand_name:"Congestion+and+Pain"&limit=6>

will find differing brand names that contain the phrase "Congestion and Pain":

- "Maximum Strength Mucinex Sinus-Max Severe **Congestion and Pain** and Mucinex Nightshift Sinus"
- "Maximum Strength Mucinex Sinus-Max Severe **Congestion and Pain** and Mucinex Nightshift Sinus"
- "Mucinex-Sinus Max Severe **Congestion and Pain** Clear and Cool and Mucinex Nightshift Sinus Clear and Cool"

and so on.

In this example, `pharm_class` is searched for "Decrease":

<https://api.fda.gov/drug/ndc.json?search=pharm_class:Decreased&limit=10> 

Results include hits like:

- "**Decreased** Respiratory Secretion Viscosity [PE]"
- "**Decreased** Prostaglandin Production [PE]", and "Decreased Platelet Aggregation [PE]".

### What the `.exact` suffix means

:::{seealso}
The information that follows was taken from <https://opendata.stackexchange.com/questions/20112/the-difference-between-exact-with-suffix-and-without-suffix>
:::

Some fields also have a second, `.exact` version which can also be searched. As we have seen, a field (without the `.exact` suffix) can be search for partial searches.
It has been tokenized to allow flexible partial searches, so a query like <https://api.fda.gov/drug/ndc.json?search=brand_name:Advil&limit=1000>
will return all drugs that contain "Advil" within their brand name, such as "CHILDRENS ADVIL", "ADVIL MIGRAINE", and so on.

`brand_name` also has a `.exact`-suffix version. It too can be search for "Advil":

<https://api.fda.gov/drug/ndc.json?search=brand_name.exact:Advil&limit=1000>

You will now see fewer results. Each result will have (exactly--right?) "Advil" as its `brand_name` (nothing more and nothing less--right?). Exact match must
match exactly. **todo:** double check.

### `__exists__` searches

todo: Perform the searches mention above to better understand what is mean.

### Search Questions

Question: What does `search=field=true` do or mean?  For example,

<https://api.fda.gov/drug/ndc.json?search=pharm_class=true>

Question: What does `_exist_` do. For example,

<https://api.fda.gov/drug/ndc.json?search=_exists_:openfda.pharm_class_cs&count=pharm_class.exact>

## Counting with `count` 

`count:` Count the number of unique values of a certain field, for all the records that matched the
 search parameter. By default, the API returns the 1000 most frequent values.

<https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact>

The number of unique phrases found in `patient.reaction.reactionmeddrapt.exact` is counted. todo: Is the prior statement
correct?  The `.exact` suffix tells the API to count whole phrases (e.g. "DRUG INEFFECTIVE") instead of individual words
(e.g. "DRUG" and "INEFFECTIVE" separately).

`count` is also often used along with `search`. Below the **drug/ncd** endpoint is searched for brand names that contain "Advil". The unique number of `pharm_class.exact` is returned.

<https://api.fda.gov/drug/ndc.json?search=brand_name:Advil&count=pharm_class.exact>

Question: Can only `.exact` fields be searched? For example, <https://api.fda.gov/drug/ndc.json?count=pharm_class.exact> return results, but without the `.exact` suffix no results are returned

<https://api.fda.gov/drug/ndc.json?count=pharm_class>


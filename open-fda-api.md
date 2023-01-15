# Open FDA API

## Introduction

To enable flexible searches of public FDA data about drugs, devices, and foods, the **FDA** created [openFDA](https://open.fda.gov/apis), a public RESTful API which uses the open source search platform [Elasticsearch](https://www.elastic.co/enterprise-search). 
 
[AdverseVerterinaryEvents.com](https://adversevetevents.com/) is an example of a site that uses the **openFDA** API.
 
## openFDA API  Overview
 
The API returns e JSON object with two sections:

1. `meta` &mdash; metadata about the query, including a disclaimer, link to data license, last-updated date, and total matching records, if applicable.

 ----------------------------------------------------------------------------------------------------------------------------------------------------------
 Meta Field          Details
 ------------------- --------------------------------------------------------------------------------------------------------------------------------------
 `meta.disclaimer`    Important details notes about openFDA data and limitations of the dataset.
                     
 `meta.license`       Link to a web page with license terms that govern data within openFDA.
                     
 `meta.last_updated`  The last date when this openFDA endpoint was updated. Note that this does not correspond to the most recent record for
                      the endpoint or dataset. Rather, it is the last time the openFDA API was itself updated.
                     
 `meta.results.skip`  **Offset (page) of results,** defined by the *skip* query parameter.
                     
 `meta.results.limit` **Number of records** in this return, defined by the *limit* query parameter. If there is no limit parameter, the API returns one result.
                     
 `meta.results.total` **Total number of records** matching the search criteria.
 ------------------- --------------------------------------------------------------------------------------------------------------------------------------

2. `results` in an array (for non-count-returning queries) of matching records.

## Authorization Key

Request limits:

- With no API key: 240 requests per minute, per IP address. 1,000 requests per day, per IP address.

- With API key: 240 requests per minute, per key. **120,000** requests per day, per key.

Using your API key:

Authentication with your personal API key can be done by either:

- passing your API key as the value of the `api_key`parameter. `https://api.fda.gov/drug/event.json?api_key=yourAPIKeyHere&search=...`

- passing it in the HTTP header using the **basic auth** authentication scheme.``Authorization: Basic eW91ckFQSUtleUhlcmU6`

## The Five API Query Parameters

The API supports the five query parameters lsited below. The `search` paramter is the the most importnat and useful one: 

- `search`: used to specify Which fields to search for what. 

- `sort`: sort the results of the search by the specified field in ascending or descending order using the `:asc` or `:desc`.

- `count`: counts unique values of a certain field, for all the records that matched the search parameter. By default, the 1000 most frequent values are returned.

- `limit`: return up to this number of records that match the search parameter. The largest allowed value for the limit parameter is 1000.

- `skip`:  used it in combination with `limit` to paginate results. It skip this number of records that match the search parameter. The largest allowed value for
   the skip parameter is 25000.

### Search Options

Searches are of the form `search=field:term` and support these patterns: 

 -------------------------------------------------------------------------------------------------------------------------------------------------- 
 Search term                           Meaning
 ------------------------------------- ------------------------------------------------------------------------------------------------------------ 
 `search=field:term`                   Search within a specific `field` for a `term` 

 `search=field:term+AND+field:term`    Search for records that match **both** terms.

 `search=field:term+field:term`        Search for records that match **either** of two terms. 

 `sort=report_date:desc`               Sort records by a specific `field` in descending order.

 `search=field1:term&count=field2`     Search for matching records. Then within that set                                                        
                                       of records, count the number of times that the unique values of a `field2` appear. Instead of looking at
                                       individual records, you can use the count parameter to count how often certain terms (like drug names or
                                       patient reactions) appear in the matching set of records.
 ------------------------------------- ------------------------------------------------------------------------------------------------------------ 

### Examples of the Search Options 

#### Example Query to match a single search term
 
This example API call queries the `drug/event` endpoint for records where one of the reported patient reactions was **fatigue**. `patient.reaction.reactionmeddrapt` (patient reaction) is searched for **fatigue**:

```html
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"&limit=1
```

#### Example Query to match several terms using AND

Search the  `drug/event` endpoint for **fatigue** as a reported patient reaction and **Canada** as the country in which the reported event occurred. **AND** is used
to join two search terms. The country code for Canada is **ca**.

```html
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+AND+occurcountry:"ca"&limit=1
```

#### Matching any search terms (OR search terms)

Search the `drug/event` endpoint where either **fatigue** was a reported patient reaction *or* the country in which the event happened was **Canada**.

```html
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+occurcountry:"ca"&limit=1
```

#### Sort Results

Search the `drug/event` endpoint for: 

- ten records

- sorted in descending order by `receivedate`

```html
https://api.fda.gov/drug/event.json?sort=receivedate:desc&limit=10
```

#### Counting records where certain terms occur

Search the `drug/event` endpoint for all records and count the top patient reactions. For each reaction, the number of records that matched is summed, providing a useful summary.

- search all records

- Count the number of records matching the terms in `patient.reaction.reactionmeddrapt.exact`. The **`.exact`** suffix here tells the API to
  count whole phrases ("**injection site reaction**") instead of individual words (**injection**, **site**, and **reaction** separately)

```html
https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact
```

## API Syntax Rules

Unless otherwise specified, the API will return only one matching record for a search. You can specify the number of records to be returned by using the `limit` parameter. The maximum limit
allowed is 1000 for any single API call. If no limit is set, the API will return one matching record.

RESUME [HERE](https://open.fda.gov/apis/advanced-syntax/)

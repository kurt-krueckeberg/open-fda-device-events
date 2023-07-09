# Queries Overview

## JSON Results Object
 
Query results are returned in a JSON object which has two properties:

1. `meta` &mdash; metadata:

   | Meta Field           | Details                                                                                                                                                                                                         |
   |:---------------------|:----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
   | `meta.disclaimer`    | Important details notes about openFDA data and limitations of the dataset.                                                                                                                                      |
   | `meta.license`       | Link to a web page with license terms that govern data within openFDA.                                                                                                                                          |
   | `meta.last_updated`  | The last date when this openFDA endpoint was updated. Note that this does not correspond to the most recent record for the endpoint or dataset. Rather, it is the last time the openFDA API was itself updated. |
   | `meta.results.skip`  | The skip is the **offset** of the results.
   | `meta.results.limit` | **Number of records returned**, as defined by the *limit* query parameter. If the `limit` parameter was omitted, the API returns one result. |
   | `meta.results.total` | **Total number of records** matching the search criteria. |


2. `results` &mdash; an arrray of matches (for non-counting querires).

As an example, this query searches in the `drug/event` endpoint for a single record:

`shttps://api.fda.gov/drug/event.json?limit=1`


The `results` properties in the single record returned contains all kinds of information about the adverse event report,
including the drugs that the patient was taking, the reactions that the patient experienced, and a good deal of other context:

```json
{
  "meta": {
    "disclaimer": "Do not rely on openFDA to make decisions regarding medical care. While we make every effort to ensure that data is accurate, you should assume all results are unvalidated. We may limit or otherwise restrict your access to the API in line with our Terms of Service.",
    "terms": "https://open.fda.gov/terms/",
    "license": "https://open.fda.gov/license/",
    "last_updated": "2023-04-27",
    "results": {
      "skip": 0,
      "limit": 1,
      "total": 16364554
    }
  },
  "results": [
    {
      "safetyreportid": "5801206-7",
      "transmissiondateformat": "102",
      "transmissiondate": "20090109",
      "serious": "1",
      "seriousnessdeath": "1",
      "receivedateformat": "102",
      "receivedate": "20080707",
      "receiptdateformat": "102",
      "receiptdate": "20080625",
      "fulfillexpeditecriteria": "1",
      "companynumb": "JACAN16471",
      "primarysource": {
        "reportercountry": "CANADA",
        "qualification": "3"
      },
      "sender": {
        "senderorganization": "FDA-Public Use"
      },
      "receiver": null,
      "patient": {
        "patientonsetage": "26",
        "patientonsetageunit": "801",
        "patientsex": "1",
        "patientdeath": {
          "patientdeathdateformat": null,
          "patientdeathdate": null
        },
        "reaction": [
          {
            "reactionmeddrapt": "DRUG ADMINISTRATION ERROR"
          },
          {
            "reactionmeddrapt": "OVERDOSE"
          }
        ],
        "drug": [
          {
            "drugcharacterization": "1",
            "medicinalproduct": "DURAGESIC-100",
            "drugauthorizationnumb": "019813",
            "drugadministrationroute": "041",
            "drugindication": "DRUG ABUSE"
          }
        ]
      }
    }
  ]
}
```

## Query Parameters

The API supports five query parameters:

| Parameter type | How it is used                                                                                                              |
|:---------|:---------------------------------------------------------------------------------------------------------------------------------|
|`search`| What to search for, in which fields. If you don’t specify a field to search, the API will search in every field.|
|`sort`| Sort the results of the search by the specified field in ascending or descending order by using the `:asc` or `:desc` modifier.|
|`count`| Count the **number of unique values** of a certain field, for all the records that matched the search parameter. By default, the 1000 most frequent values are returned.|
|`limit`| Return up to this number of records that match the search parameter. Currently, the largest allowed limit is 1000.|
|`skip`| Skip this number of records that match the search parameter, then return the matching records that follow. Use `skip` in combination with `limit` to paginate results. Currently, the largest allowed value for the skip parameter is 25000. |

:::{note}
`count` returns unique records. The `total` meta field returned in every query returns the total number of records.
:::

## Search Syntax

### Search Terms

Searches have a special syntax

`search=field:"term"`

where the search term immediately follows the field being search, separated by a colon. For example, this query looks in the **drug/event** endpoint for a
record where one of the reported patient reactions was fatigue:

`https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"&limit=1`

Here `patient.reaction.reactionmeddrapt` is the patient reaction to a prescribed medication. It is searched for **fatigue**.

### Spaces

Queries use the plus sign `+` in place of the space character. Wherever you would use a space character, use a plus sign instead.

### Phrase matches

For phrase matches, use double quotation marks " " around the words. For example,

- `"multiple+myeloma"`.
- `"dry+eye+syndrome"`
- `"periperhal+neuropathy"`
